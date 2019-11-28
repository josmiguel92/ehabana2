<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

/**
 * Translatable Entity Trait
 */
trait TranslatableTrait
{
    private $currentLocale;

    private $translations;

    private $allowed_locales = ['es', 'en', 'fr'];

    public function setCurrentLocale(string $locale){
        $this->currentLocale = $locale;
    }

    public function getTranslations(string $locale = null) :array
    {
        //if locale is present, overwrite the CurrentLocale property
        if($locale) {
          $this->setCurrentLocale($locale);
        }

        //if translations are loaded and locale is unchanged since last time translations were accesed
        if(is_array($this->translations) and !$locale
                OR $locale === $this->translations['locale']) {
          return $this->translations;
        }

        //if isnt loaded or locale chaged
        $properties = get_object_vars($this);
        //iterate over every property, and add to Translation collection,
        // the array ones that contains the current languages key
        foreach ($properties as $property => $value)
        {
            if(is_array($value) and isset($value[$this->currentLocale])) {
              $this->translations[$property] = $value[$this->currentLocale];
            }
        }
        //save the locale used to get translations
        $this->translations['locale'] = $this->currentLocale;
        return $this->translations;

    }

    public function __set($name, $value)
    {
      $probableLocale = strtolower(substr($name, -2, 2));
      if(in_array($probableLocale, $this->allowed_locales, true))
      {
        $property = substr($name, 0, -2);
        if(property_exists($this, $property))
        {
          $this->$property[$probableLocale] = $value;
        }
      }
    }

    public function __isset($name){
       if(!property_exists($this, $name))
       {
         $probableLocale = strtolower(substr($name, -2, 2));
         if(in_array($probableLocale, $this->allowed_locales, true)){
            $property = substr($name, 0, -2);
              if(property_exists($this, $property))
              {
                return true;
              }
         }
         return false;
       }
      return true;
    }

  public function __get($name)
  {
    if(property_exists($this, $name))
    {
      return $this->$name;
    }
    $probableLocale = strtolower(substr($name, -2, 2));
    if(in_array($probableLocale, $this->allowed_locales, true)){
      $property = substr($name, 0, -2);

              if(property_exists($this, $property))
              {
                if(isset($this->$property[$probableLocale]))
                  return $this->$property[$probableLocale];
                else return $this->$property;
              }

    }
  }


}

<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

/**
 * Translatable Entity Trait
 */
trait TranslatableTrait
{
    private $currentLocale;

    private $translations;

    public function setCurrentLocale(string $locale){
        $this->currentLocale = $locale;
    }

    public function getTranslations(string $locale = 'en')// :array
    {
        //if locale is present, overwrite the CurrentLocale property
        if($locale)
            $this->setCurrentLocale($locale);

        //if translations are loaded and locale is unchanged since last time translations were accesed
        if(is_array($this->translations) and !$locale
                OR $locale == $this->translations['locale'])
            return $this->translations;

        //if isnt loaded or locale chaged
        $properties = get_object_vars($this);
        //iterate over every property, and add to Translation collection,
        // the array ones that contains the current languages key
        foreach ($properties as $property => $value)
        {
          if(is_string($value) && $value = json_decode($value, true))
            if(is_array($value) and isset($value[$this->currentLocale]))
                $this->translations[$property] = $value[$this->currentLocale];
        }
        //save the locale used to get translations
        $this->translations['locale'] = $this->currentLocale;
        return $this->translations;

    }



}

<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataMapper\RadioListMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $date = new \DateTime(Booking::DATE_TO_START_BOOKINGS);
        $endbookingdate = new \DateTime('today + 45 days');
        $endbookingdate = $endbookingdate->format('Y-m-d');
        $builder
            ->add('clientName')
            ->add('clientEmail',EmailType::class)
            ->add('telephone')
            
            ->add('bookingDate', DateType::class, [
                 'widget'=>'single_text',
                'attr'=>[
                    'min'=>$date->format('Y-m-d'),//today + 12 hours
                    'max'=> $endbookingdate
                ]
            ])
            ->add('bookingTime', TimeType::class, [
                'widget'=>'single_text',
                'attr' => [
                    'min' => '12:00',
                    'max' => '23:00'
                ]
            ])
            
            ->add('peopleCount')
        
            
            ->add('clientMessage')

            ->add('bookingLang', HiddenType::class)
            ->add('campaign',HiddenType::class)
            ->addEventListener(
                FormEvents::SUBMIT,
                [$this, 'onSubmit']
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }

    public function onSubmit(FormEvent $event)
    {
        $booking = $event->getData();

        if (!$booking) {
            return;
        }

        $newDatetime = new \DateTime($booking->getBookingDate()->format('Y-m-d'). " " . $booking->getBookingTime()->format("H:i:s"));
        $booking->setBookingDateTime($newDatetime);
        $event->setData($booking);
    }
}

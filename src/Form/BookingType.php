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
        $builder
            ->add('peopleCount', null, ['attr'=>['min'=>1, 'max'=>40, 'placeholder'=>1, 'value'=>1], 'label'=>'field.number_passengers'])
            ->add('pickupDate', DateType::class, [
                 'widget'=>'single_text',
                'attr'=>[
                    'min'=>$date->format('Y-m-d')
                ],
                'label'=>'label.pickup_date'])
            //->add('pickupTime', TimeType::class, ['widget'=>'single_text'])
            ->add('pickupTime', ChoiceType::class,[
                'choices'=>[
                    '07:00h'=>'07:00',
                    '07:30h'=>'07:30',
                    '08:00h'=>'08:00',
                    '08:30h'=>'08:30',
                    '09:00h'=>'09:00'
                ],'expanded'=>false,'label'=>'field.pickup_time'
            ])

            ->add('pickupPlace', ChoiceType::class,[
                'choices'=>[
                    'label.pickup_place.option_1'=>'Airport',
                    'label.pickup_place.option_2'=>'Cruise',
                    'label.pickup_place.option_3'=>'Hotel-House'
                ],'expanded'=>true, 'label'=>'label.pickup_place'
            ])
            ->add('pickupDetails',null, ['label'=>'field.pickup_place'])


            ->add('clientName', null, ['label'=>'field.name'])
            ->add('clientEmail',EmailType::class, ['label'=>'field.email'])
            ->add('telephone', null, ['label'=>'field.telephone'])
            ->add('clientMessage', TextareaType::class, [
                'required' => false, 'label'=>'field.client_message'
            ])

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

        $newDatetime = new \DateTime($booking->getPickupDate()->format('Y-m-d'). " " . $booking->getPickupTime()->format("H:i:s"));
        $booking->setPickupDate($newDatetime);

        $event->setData($booking);
    }
}

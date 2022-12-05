<?php

namespace App\Form;

use App\Entity\Toilet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminToiletFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', TextType::class,[
                'label'=>'Cím:'
            ])
            ->add('type', ChoiceType::class, [
                'label'=>"Típus",
                'choices'  => [
                    'Nyílvános' => 'Nyílvános',
                    'Magán'=>'Magán'
                ],
            ])
            ->add('price', IntegerType::class,[
                'label'=>'Ár:'
            ])
            ->add('openingtimes', TextType::class,[
                'label'=>'Nyitvatartás:'
            ])
            ->add("gpscoordinates", CollectionType::class,[
                'label'=>'GPS koordináták:'
            ])
            ->add('isaccessible', ChoiceType::class,[
                'label'=>'Mozgáskorlátozottaknak is?:',
                'choices'  => [
                    'Igen' => true,
                    'Nem'=> false],
            ])
            ->add('comments', TextType::class,[
                'label'=>'Megjegyzés:'
            ])
            ->add("isaccepted", ChoiceType::class,[
                'label'=>'Elfogadva:',
                'choices'  => ['Igen' => true,
                    'Nem'=> false],
            ])
            ->add('save', SubmitType::class,[
                'label'=>'Elküld'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Toilet::class,
        ]);
    }
}

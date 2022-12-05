<?php

namespace App\Form;

use App\Entity\Toilet;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ToiletFormType extends AbstractType
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
            ->add('isaccessible', ChoiceType::class,[
                'label'=>'Mozgáskorlátozottaknak is?:',
                                'choices'  => [
                                    'Igen' => true,
                                    'Nem'=> false],
            ])
            ->add('comments', TextType::class,[
                'label'=>'Megjegyzés:'
            ])
            ->add('save', SubmitType::class,[
                'label'=>'Hozzáadás'
            ])->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'registration'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Toilet::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Ordonnance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
;

class OrdonnanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nompatient')
            ->add('Diseases')
            ->add('Medications')
            ->add('autre')
            ->add('captchaCode', CaptchaType::class, array(
        'captchaConfig' => 'ExampleCaptchaUserRegistration',
        'constraints' => [
            new ValidCaptcha([
                'message' => 'Invalid captcha, please try again',
            ]),
        ],
    ))
            ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordonnance::class,
        ]);
    }
}

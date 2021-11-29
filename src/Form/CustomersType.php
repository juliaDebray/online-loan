<?php

namespace App\Form;

use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class,
                ['label'=>'Email'])
            ->add('password', RepeatedType::class,
                [
                'type'=>PasswordType::class,
                'invalid_message' => 'les mots de passe ne sont pas identiques',
                'options' => ['attr' => ['class' => 'password-field']],
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répétez le mot de passe']
                ])
            ->add('firstname', TextType::class,
                ['label'=>'Prénom'])
            ->add('lastname', TextType::class,
                ['label'=> 'Nom de famille'])
            ->add('birthdate', BirthdayType::class,
                [
                'label'=>'Date de naissance',
                'format'=>'dd/MM/yyyy', 'years'=> range(date('Y')-110, date('Y')),
                ])
            ->add('address', TextType::class,
                ['label'=>'Addresse'])
            ->add('zipcode', TextType::class,
                ['label'=>'Code postal'])
            ->add('city', TextType::class,
                ['label'=>'Ville'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customers::class,
        ]);
    }
}

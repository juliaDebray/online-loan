<?php

namespace App\Controller\Admin;

use App\Entity\Customers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class CustomersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customers::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('email'),
            Field::new('password')->onlyOnForms()
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Répétez le mot de passe'],
                ]),
            TextField::new('firstname')->setFormTypeOptions(['label'=>'Prénom']),
            TextField::new('lastname')->setFormTypeOptions(['label'=>'Nom de famille']),
            DateTimeField::new('birthdate')->setFormTypeOptions(['label'=>'Date de naissance']),
            TextField::new('address')->setFormTypeOptions(['label'=>'Adresse']),
            TextField::new('zipcode')->setFormTypeOptions(['label'=>'Code postal']),
            TextField::new('city')->setFormTypeOptions(['label'=>'Ville']),
            TextField::new('status')->setTemplatePath('dashboard/user_status_template.html.twig'),

        ];
    }

}

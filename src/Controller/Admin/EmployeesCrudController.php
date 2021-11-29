<?php

namespace App\Controller\Admin;

use App\Entity\Employees;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeesCrudController extends AbstractCrudController
{
    /** @var UserPasswordHasherInterface */
    private $passwordHasher;

    public static function getEntityFqcn(): string
    {
        return Employees::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('email'),
            TextField::new('status')->setTemplatePath('dashboard/user_status_template.html.twig'),
            Field::new('password')->onlyOnForms()
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'invalid_message' => 'les mots de passe ne sont pas identiques',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'first_options'  => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Répétez le mot de passe']
                ]),
        ];
    }

    public function passwordHasher(UserPasswordHasherInterface $passwordHasher, Employees $employee): string
    {
        return $passwordHasher->hashPassword($employee, $employee->getPassword());
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Reservations;
use App\Entity\Users;
use App\Repository\ReservationsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ReservationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservations::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            ChoiceField::new('status', 'Statut')
                ->setChoices(["réservé"=>"reserved","emprunté"=>"borrowed"])
                ->setTemplatePath('dashboard/reservation_status_template.html.twig'),
            AssociationField::new('book', 'Livre'),
            AssociationField::new('User', 'Usager'),
            DateTimeField::new('start_date', 'Date de début'),
        ];

    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Reservations;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
        if (Crud::PAGE_NEW == $pageName) {
            return [
                TextField::new('status'),
                AssociationField::new('book')->setFormattedValue(function ($value) {
                    return $value . ' lol';
                }),
                AssociationField::new('User'),
            ];
        }

        if (Crud::PAGE_INDEX == $pageName) {
            return [
                IntegerField::new('id', 'Id'),
                TextField::new('status'),
                AssociationField::new('book'),
                AssociationField::new('User'),
                DateTimeField::new('start_date', 'Date de début'),
                DateTimeField::new('end_date', 'Date de fin'),
            ];
        }
    }
}

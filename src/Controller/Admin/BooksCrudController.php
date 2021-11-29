<?php

namespace App\Controller\Admin;

use App\Entity\Books;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BooksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Books::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('author', 'Auteur'),
            TextField::new('title', 'Titre'),
            TextField::new('description', 'Description'),
            ChoiceField::new('literary_genre', 'Genre')->setChoices([
                'Polar'=>'Polar',
                'Poésie'=>'Poésie',
                'Fantastique'=>'Fantastique',
                'Science-fiction'=>'Science-fiction',
                'Littérature' =>'littérature',
                'littérature' =>'Littérature',
                'Théâtre' =>'Théâtre',
                'Essai' =>'Essai',]),
            DateField::new('releaseDate', 'Date de parution'),
            AssociationField::new('reservation', 'Statut')
                ->setTemplatePath('dashboard/book_status_template.html.twig')
                ->onlyOnIndex()
        ];
    }


}

<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class BooksType extends AbstractType
{
    public $choices = [
        'Polar'=>'Polar',
        'Fantastique'=>'Fantastique',
        'Science-fiction'=>'Science-fiction'
    ];


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', TextType::class,
                [
                'required'=>false,
                'label'=>'Auteur'])
            ->add('title',TextType::class, [
                'required'=>false,
                'label'=>'Titre'])
            ->add('image', FileType::class, [
                'required'=>false,
                'label'=>'Image de couverture',
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop lourd. Taille maximum autorisée : 1024 ko',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Seul les formats JPEG et JPG sont acceptés',
                    ])
                ],
                ])
            ->add('description', TextType::class, [
                'required'=>false,
                'label'=>'Description',
            ])
            ->add('literaryGenre', ChoiceType::class,
                [
                'required'=>false,
                'placeholder'=>'Dérouler la liste',
                'label'=>'Genre du livre',
                    'choices'=> $this->choices,
                ])
            ->add('releaseDate', DateType::class, [
                'required'=>false,
                'label'=>'Date de parution',
                'format'=>'dd/MM/yyyy',
                'years'=> range(date('Y')-200, date('Y')+100),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}

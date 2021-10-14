<?php

namespace App\Service;

use App\Entity\Books;
use App\Form\BooksType;
use App\Repository\BooksRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookService extends AbstractController
{
    public function makeBook(FileUploader $fileUploader, $form, $book)
    {
        $imageFile = $form['image']->getData();

        if($imageFile) {
            $fileName = $fileUploader->upload($imageFile);
            $book->setImage($fileName);
        } else {
            $book->setImage('default_cover.jpg');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();

        $this->addFlash('success','Le livre a été ajouté au catalogue');
    }
}
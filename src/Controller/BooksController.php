<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooksType;
use App\Repository\BooksRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/books")
 */
class BooksController extends AbstractController
{
    /**
     * @param BooksRepository $booksRepository
     * @return Response
     * @Route ("/books_catalog", name="books_catalog", methods={"GET"}),
     */
    public function displayBookCatalog(BooksRepository $booksRepository): Response
    {
        return $this->render('books/booksCatalog.html.twig', [
            'books' => $booksRepository->findAll(),
        ]);
    }

    /**
     * @param BooksRepository $booksRepository
     * @return Response
     * @Route ("/search/{type}/{title?}", name="books_search", methods={"GET"}),
     */
    public function search(BooksRepository $booksRepository, string $type, ?string $title): Response
    {
        $books = $booksRepository->likeBy($title, $type);

        return $this->render('books/_books_template.html.twig', ['books' => $books]);
    }

    /**
     * @param BooksRepository $booksRepository
     * @return Response
     * @Route ("/searchByTitle/{title}", name="books_search_by_title", methods={"GET"}),
     */
    public function searchByTitle(BooksRepository $booksRepository, string $title): Response
    {
        $type = null;
        $books = $booksRepository->likeBy($title, $type);
        return $this->render('books/_books_template.html.twig', ['books' => $books]);
    }

    /**
     * @param BooksRepository $booksRepository
     * @return Response
     * @Route ("/", name="books_index", methods={"GET"}),
     */
    public function index(BooksRepository $booksRepository): Response
    {
        return $this->render('books/index.html.twig', [
            'books' => $booksRepository->findAll(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/new", name="books_new", methods={"GET","POST"}),
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $book = new Books();
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('books/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    /**
     * @param Books $book
     * @return Response
     * @Route("/{id}", name="books_show", methods={"GET"}),
     */
    public function show(Books $book): Response
    {
        return $this->render('books/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @param Request $request
     * @param Books $book
     * @return Response
     * @Route("/{id}/edit", name="books_edit", methods={"GET","POST"}),
     */
    public function edit(Request $request, Books $book): Response
    {
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('books/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param Books $book
     * @return Response
     * @Route ("/{id}", name="books_delete", methods={"POST"}),
     */
    public function delete(Request $request, Books $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
    }
}

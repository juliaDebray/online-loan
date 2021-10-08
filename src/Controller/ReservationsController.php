<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationsController extends AbstractController
{
    /**
     * Allow a user to reserve a book
     *
     * @Route("/reservations/{bookId}", name="reservations", methods={"GET","POST"}),
     */
    public function new(BooksRepository $booksRepository, int $bookId): Response
    {
        $book = $booksRepository->find($bookId);
        $startDate = new \DateTime('now');
        $endDate = $startDate->modify('+3 day');

        $reservation = new Reservations();
        $reservation->setBook($book);
        $reservation->setUser($this->getUser());
        $reservation->setStartDate($startDate);
        $reservation->setEndDate($endDate);
        $reservation->setStatus('reserved');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();

        $book->setStatus('reserved');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('books_catalog');
    }
}

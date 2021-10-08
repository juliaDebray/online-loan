<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Repository\BooksRepository;
use App\Repository\ReservationsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\component\Notifier\Notification\Notification;
//use Symfony\Component\Notifier\NotifierInterface;

/**
 * @Route("/reservations")
 */
class ReservationsController extends AbstractController
{
    /**
     * Allow a user to reserve a book
     *
     * @Route("/reserve/{bookId}", name="book_reservation", methods={"GET","POST"}),
     */
    public function new(BooksRepository $booksRepository, int $bookId): Response
    {
        $book = $booksRepository->find($bookId);
        $startDate = new DateTime('now');
        $endDate = new DateTime('now');
        $endDate->modify('+3 day');

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
        $entityManager->flush();

        return $this->redirectToRoute('books_catalog');
    }

    /**
     * Confirm the loan of a book
     *
     * @param BooksRepository $booksRepository
     * @param int $bookId
     * @return Response
     * @Route("/edit/{bookId}", name="book_loaning", methods={"GET","POST"})
     */
    public function setLoaning(BooksRepository $booksRepository, int $bookId): Response
    {
        $book = $booksRepository->find($bookId);
        $reservation = $book->getReservation();

        $startDate = new DateTime('now');
        $endDate = new DateTime('now');
        $endDate->modify('+21 day');

        $reservation->setStatus('borrowed');
        $reservation->setStartDate($startDate);
        $reservation->setEndDate($endDate);

        $this->getDoctrine()->getManager()->flush();

        $book->setStatus('borrowed');
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('books_catalog');
    }

    /**
     * display the all the reservations
     *
     * @Route("/show_loanings", name="loanings_show", methods={"GET","POST"})
     */
    public function showLoaning(ReservationsRepository $reservationsRepository): Response
    {
        $reservations = $reservationsRepository->findBy(['status'=>'borrowed']);

        $books = [];
        $lateBooks = [];
        $now = new DateTime();

        foreach($reservations as $reservation)
        {
            if($reservation->getEndDate() < $now)
            {
                array_push($lateBooks, $reservation->getBook());
            } else {
                array_push($books, $reservation->getBook());
            }
        }

        return $this->render('/reservations/showAll.html.twig', [
            'lateBooks' => $lateBooks,
            'books' => $books,
        ]);
    }

    /**
     * display the reservations of one user
     *
     * @Route("/show_user_loanings", name="loanings_user_show", methods={"GET","POST"})
     */
    public function showUserLoaning(): Response
    {
        $user = $this->getUser();
        $userReservations = $user->getReservations();
        $now = new DateTime();
        $userLateBooks = [];
        $userBooks = [];

        foreach ($userReservations as $userReservation)
        {
            if($userReservation->getEndDate() < $now )
            {
                array_push($userLateBooks, $userReservation->getBook());
            } else {
                array_push($userBooks, $userReservation->getBook());
            }
        }

        if(!empty($userLateBooks))
        {
            $this->addFlash('warning',' Attention : Vous devez rendre les livres en retard !');
        }

        return $this->render('/reservations/showUserReservations.html.twig',
        [
            'userLateBooks' => $userLateBooks,
            'userBooks' => $userBooks
        ]);
    }

        /**
         * Delete a book's reservation (the user had returned the book to the library)
         *
         * @Route("/delete/{reservationId}", name="delete_reservation", methods={"GET","POST"})
         */
        public function delete(ReservationsRepository $reservationsRepository, int $reservationId): Response
        {
            $reservationToDelete = $reservationsRepository->find($reservationId);
            $bookReserved = $reservationToDelete->getBook();
            $bookReserved->setStatus('disponible');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservationToDelete);
            $entityManager->flush();

            return $this->redirectToRoute('loanings_show');
        }
}

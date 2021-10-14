<?php

namespace App\Service;

use App\Entity\Reservations;
use App\Repository\BooksRepository;
use App\Repository\ReservationsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationService extends AbstractController
{
    /**
     * Create or edit a book's reservation
     */
    public function makeOrEditReservation(BooksRepository $booksRepository, int $bookId, string $duration, string $status)
    {
        $book = $booksRepository->find($bookId);
        $startDate = new DateTime('now');
        $endDate = new DateTime('now');
        $endDate->modify($duration);

        if($status == 'reserved') {
            $reservation = new Reservations();
            $reservation->setBook($book);
            $reservation->setUser($this->getUser());
        } else {
            $reservation = $book->getReservation();
        }

        $reservation->setStartDate($startDate);
        $reservation->setEndDate($endDate);
        $reservation->setStatus($status);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();
    }

    public function getAllReservations(ReservationsRepository $reservationsRepository): array
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

        return [
            'lateBooks' => $lateBooks,
            'books' => $books ];
    }

    public function getUserReservations(): array
    {
        $user = $this->getUser();
        $userReservations = $user->getReservations();
        $now = new DateTime();
        $userLateBooks = [];
        $userBooks = [];
        $userLateReservations = [];

        foreach ($userReservations as $userReservation)
        {
            if($userReservation->getEndDate() < $now && $userReservation->getStatus() == 'borrowed')
            {
                array_push($userLateBooks, $userReservation->getBook());
            } elseif ($userReservation->getEndDate() < $now && $userReservation->getStatus() == 'reserved')
            {
                array_push($userLateReservations, $userReservation->getBook());
            } else {
                array_push($userBooks, $userReservation->getBook());
            }
        }

        if(!empty($userLateBooks))
        {
            $this->addFlash('warning',' Attention : Vous devez rendre les livres en retard !');
        }

        return [
            'userLateBooks' => $userLateBooks,
            'userBooks' => $userBooks,
            'userLateReservations' => $userLateReservations
        ];
    }

    public function deleteReservation(ReservationsRepository $reservationsRepository, int $reservationId)
    {
        $reservationToDelete = $reservationsRepository->find($reservationId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reservationToDelete);
        $entityManager->flush();
    }

    public function cleanDelayedReservations(ReservationsRepository $reservationsRepository)
    {
        $reservations = $reservationsRepository->findAll();
        $now = new \DateTime();

        foreach ($reservations as $reservation)
        {
            if($reservation->getStatus() == 'reserved' && $reservation->getEndDate() <= $now)
            {
                $this->deleteReservation($reservationsRepository, $reservation->getId());
            }
        }
    }
}
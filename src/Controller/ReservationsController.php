<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Repository\BooksRepository;
use App\Repository\ReservationsRepository;
use App\Service\ReservationService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/reservations")
 */
class ReservationsController extends AbstractController
{
    /**
     * Allow a user to reserve a book
     *
     * @IsGranted("ROLE_CUSTOMER"),
     * @Route("/reserve/{bookId}", name="book_reservation", methods={"GET","POST"}),
     */
    public function new(BooksRepository $booksRepository,
                        int $bookId,
                        ReservationService $reservationService): Response
    {
        $duration = '+3 day';
        $status = 'reserved';
        $reservationService->makeOrEditReservation($booksRepository, $bookId, $duration, $status);

        return $this->redirectToRoute('books_catalog');
    }

    /**
     * Confirm the loan of a book
     *
     * @IsGranted("ROLE_EMPLOYEE"),
     * @param BooksRepository $booksRepository
     * @param int $bookId
     * @return Response
     * @Route("/edit/{bookId}", name="book_loaning", methods={"GET","POST"})
     */
    public function setLoaning(BooksRepository $booksRepository,
                               int $bookId,
                               ReservationService $reservationService): Response
    {
        $duration = '+21 day';
        $status = 'borrowed';
        $reservationService->makeOrEditReservation($booksRepository, $bookId, $duration, $status);

        return $this->redirectToRoute('books_catalog');
    }

    /**
     * display the all the reservations
     *
     * @IsGranted("ROLE_EMPLOYEE"),
     * @Route("/show_loanings", name="loanings_show", methods={"GET","POST"})
     */
    public function showLoaning(ReservationsRepository $reservationsRepository,
                                ReservationService $reservationService): Response
    {
        $reservations = $reservationService->getAllReservations($reservationsRepository);

        return $this->render('/reservations/showAll.html.twig', $reservations);
    }

    /**
     * display the reservations of one user
     *
     * @IsGranted ("ROLE_CUSTOMER"),
     * @Route("/show_user_loanings", name="loanings_user_show", methods={"GET","POST"})
     */
    public function showUserLoaning(ReservationService $reservationService): Response
    {
        $userReservations = $reservationService->getUserReservations();

        return $this->render('/reservations/showUserReservations.html.twig', $userReservations);
    }

        /**
         * Delete a book's reservation (the user returned the book to the library)
         *
         * @Route("/delete/{reservationId}", name="delete_reservation", methods={"GET","POST"})
         */
        public function delete(ReservationsRepository $reservationsRepository,
                               int $reservationId,
                               ReservationService $reservationService): Response
        {
            $reservationService->deleteReservation($reservationsRepository, $reservationId);

            return $this->redirectToRoute('loanings_show');
        }
}

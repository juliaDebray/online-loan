<?php

namespace App\Controller;

use App\Repository\ReservationsRepository;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * display home page
     *
     * @Route("/", name="home_page")
     */
    public function HomePage(ReservationService $reservationService,
                             ReservationsRepository $reservationsRepository) : Response
    {
        $reservationService->cleanDelayedReservations($reservationsRepository);

        return $this->Render('home/home.html.twig');
    }
}
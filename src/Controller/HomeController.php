<?php

namespace App\Controller;

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
    public function HomePage() : Response
    {
        return $this->Render('home/home.html.twig');
    }
}
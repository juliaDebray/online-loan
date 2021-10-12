<?php

namespace App\Controller\Admin;

use App\Entity\Books;
use App\Entity\Customers;
use App\Entity\Employees;
use App\Entity\Reservations;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(BooksCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Online Loan');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour vers le site', 'fas fa-home', 'home_page');
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Books::class);
        yield MenuItem::linkToCrud('Réservations', 'fas fa-shopping-bag', Reservations::class);
        yield MenuItem::linkToCrud('Consomateurs', 'fas fa-user', Customers::class);
        yield MenuItem::linkToCrud('Employés', 'fas fa-user', Employees::class);
    }
}

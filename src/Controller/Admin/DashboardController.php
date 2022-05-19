<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Inspection;
use App\Entity\Make;
use App\Entity\Model;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Car Service');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Make', 'fas fa-list', Make::class);
        yield MenuItem::linkToCrud('Model', 'fas fa-list', Model::class);
        yield MenuItem::linkToCrud('Car', 'fas fa-list', Car::class);
        yield MenuItem::linkToCrud('Inspection', 'fas fa-list', Inspection::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}

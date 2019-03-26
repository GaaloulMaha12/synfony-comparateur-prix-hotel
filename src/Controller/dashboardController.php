<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 26/03/2019
 * Time: 16:41
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class dashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('admin/dashboard/dashboard.html.twig');
    }

}
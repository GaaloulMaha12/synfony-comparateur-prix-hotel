<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 26/03/2019
 * Time: 16:41
 */

namespace App\Controller;

use App\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\Agence;
use App\Entity\Offre;
use App\Entity\Pension;
use App\Entity\Chambre;
use App\Entity\Categoriechambre;
use App\Entity\Parametre;
use App\Entity\Page;
class dashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function dashboard()
    {
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $hotelsData = $repository->findAll();
        $repository1 = $this->getDoctrine()->getRepository(Agence::class);
        $agencesData = $repository1->findAll();
        $repository2 = $this->getDoctrine()->getRepository(Offre::class);
        $offresData = $repository2->findAll();
        $repository3 = $this->getDoctrine()->getRepository(Pension::class);
        $pensionsData = $repository3->findAll();
        $repository4 = $this->getDoctrine()->getRepository(Chambre::class);
        $chambresData = $repository4->findAll();
        $repository5 = $this->getDoctrine()->getRepository(Categoriechambre::class);
        $categoriechambresData = $repository5->findAll();
        $repository6 = $this->getDoctrine()->getRepository(Page::class);
        $pagesData = $repository6->findAll();
        $repository7 = $this->getDoctrine()->getRepository(Parametre::class);
        $parametresData = $repository7->findAll();
        $repository8 = $this->getDoctrine()->getRepository(Administrateur::class);
        $administrateursData = $repository8->findAll();
        return $this->render('admin/dashboard/dashboard.html.twig', [
            'hotels' => $hotelsData,
            'agences' => $agencesData,
            'offres' => $offresData,
            'pensions' => $pensionsData,
            'chambres' => $chambresData,
            'categoriechambres' => $categoriechambresData,
            'pages' => $pagesData,
            'parametres' => $parametresData,
            'administrateurs' => $administrateursData,
            ]);

    }

}
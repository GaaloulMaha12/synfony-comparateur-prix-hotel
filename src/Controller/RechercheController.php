<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 10/04/2019
 * Time: 16:12
 */

namespace App\Controller;
use App\Entity\Hotel;
use App\Entity\Offre;
use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RechercheController  extends  AbstractController
{
    /**
 * @Route("/accueil")
 */
    public function accueil()
    {
        $hotel = new Hotel();
        $repository = $this->getDoctrine()->getRepository(Hotel::class);

        $hotelsData = $repository->findAll();




        return $this->render('client/recherche.html.twig', [
            'hotels' => $hotelsData,]);
    }
//    /**
//     * @Route("/deal")
//     */
//    public function offre()
//    {
//        $offre = new Offre();
//        $repository = $this->getDoctrine()->getRepository(Offre::class);
//
//        $DealsData = $repository->findAll();
//
//
//
//
//        return $this->render('client/offre.html.twig', [
//            'offres' => $DealsData,]);
//    }
   /**
 * @Route("/hotel/{id}")
 */
    public function hotelById($id)
    {
        $offre = new Offre();
        $repository = $this->getDoctrine()->getRepository(Offre::class);

        $DealsData = $repository->findBy(["hotel" => $id]);

        $repository2 = $this->getDoctrine()->getRepository(Hotel::class);

        $HotelData = $repository2->find( $id);




        return $this->render('client/offre.html.twig', [
            'offres' => $DealsData,
            'hotel' => $HotelData
            ]);
    }
}
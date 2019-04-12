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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RechercheController  extends  AbstractController
{

//    public function accueil()
//    {
//        $hotel = new Hotel();
//        $repository = $this->getDoctrine()->getRepository(Hotel::class);
//
//        $hotelsData = $repository->findAll();
//
//
//
//
//        return $this->render('client/recherche.html.twig', [
//            'hotels' => $hotelsData,]);
//    }
//
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

    /**
     * @Route("/accueil", name="recherche")
     */

    public function RechHotel(Request $request)
    {
        $hotel = new Hotel();
        $form = $this->createFormBuilder($hotel)
            ->add('positionhotel', TextType::class)
            ->add('typehotel', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'chercher'])
            ->getForm();
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $hotelsData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hotel);
            $entityManager->flush();
            return $this->redirectToRoute('recherche');
        }
        return $this->render('client/recherche.html.twig', [
            'hotels' => $hotelsData,
            'formRech' => $form->createView(),
        ]);
    }






}
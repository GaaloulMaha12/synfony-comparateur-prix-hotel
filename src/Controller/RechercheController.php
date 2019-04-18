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
use App\Entity\Chambre;
use function Symfony\Bridge\Twig\Extension\twig_is_selected_choice;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RechercheController extends AbstractController
{
    /**
     * @Route("/resultat")
     */
    public function searchhotel(request $request)
    {

        $pos = $request->get('destination');
        $type= $request->get('type');
        $debut = $request->get('arrivee');
        $datefin= $request->get('depart');
        $note = $request->get('note');
        $chambre  = $request->get('chambre');
        $autre= $request->get('autre');

        $repository2 = $this->getDoctrine()->getRepository(chambre::class);
        $repository = $this->getDoctrine()->getRepository(Offre::class);
        $offers = $repository->getHotelsByCriteria($pos, $type, $debut, $datefin, $note, $chambre, $autre);
        $hotelsNotUnique = array();
        foreach ($offers as $o => $val) {
            $hotelsNotUnique[$val->getHotel()->getId()] = $val->getHotel();
        }
        $hotels = array();
        foreach ($hotelsNotUnique as $key => $value) {
            if (!isset($hotels[$key])) {
                $hotels[$key] = $value;
            }
        }

//        print_r($hotels);


//        $positionhotel = array();
//        foreach ($hotels as $a => $val) {
//            $positionhotel[$val->getPositionhotel()] = $val->getPositionhotel();
//        }

        $chambres = $repository2->findAll();
        $typeschambre = array();
        foreach ($chambres as $a => $val) {
            $typeschambre[$val->getTypechambre()] = $val->getTypechambre();
        }


        $form = $this->createFormBuilder()
            ->add('positionhotel', ChoiceType::class, [
//                'choices' => $hotelsArray
            ])
            ->add('arrivee', TextType::class, [

            ])
            ->add('depart', TextType::class, [

            ])
            ->add('chambre', ChoiceType::class, [

            ])
            ->add('save', SubmitType::class, ['label' => 'rechercher'])
            ->getForm();
        $form->handleRequest($request);
        $selectedHotels = [];

//        var_dump($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $crit = $form->getData();
            $selectedHotels = $repository->findBy(['typehotel' => $crit->getTypehotel()]);

            $hotelsData = $selectedHotels;
            return $this->redirect('/resultat?positionhotel' . $positionhotel . "arrivée=" . $arrivée . "départ=" . $départ . "chambre" . $typeschambre);
        }
        return $this->render('client/recherche.html.twig', [
            'hotels' => $hotels,
            'form' => $form->createView(),
            'types' => [],

            'notes' => [],

        ]);

    }
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

        $HotelData = $repository2->find($id);


        return $this->render('client/detailsoffre.html.twig', [
            'offres' => $DealsData,
            'hotel' => $HotelData

        ]);
    }


    public function searchhotelbytypehotel($critéres)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.typehotel = :typehotel')
            ->setParameter('typehotel', $critéres['typehotel'])
            ->getQuery()
            ->getResult();


    }


}







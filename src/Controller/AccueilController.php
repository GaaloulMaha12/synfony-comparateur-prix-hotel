<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 10/04/2019
 * Time: 16:12
 */

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Detailsoffre;
use App\Entity\Hotel;
use App\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil")
     */

    public function pageAccueil(request $request)
    {

        $pos = $request->get('destination');
        $debut = $request->get('arrivee');
        $datefin = $request->get('depart');
        $chambre = $request->get('chambre');

        $repository2 = $this->getDoctrine()->getRepository(detailsoffre::class);
        $repository = $this->getDoctrine()->getRepository(offre::class);
        $offers = $repository->getHotelsByCriteria($pos, $chambre, $debut, $datefin, null, null, null, null );
        $details = $repository2->getChambresByCriteria($chambre);
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
        $chambresNotUnique = array();
        foreach ($details as $o => $val) {
            $chambresNotUnique[$val->getChambre()->getId()] = $val->getChambre();
        }
        $chambres = array();
        foreach ($chambresNotUnique as $key => $value) {
            if (!isset($chambres[$key])) {
                $chambres[$key] = $value;
            }
        }

//        $chambres = $repository2->findAll();
//        $typeschambre = array();
//        foreach ($chambres as $a => $val) {
//            $typeschambre[$val->getTypechambre()] = $val->getTypechambre();
//        }


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
//            ->add('save', SubmitType::class, ['label' => 'rechercher'])
            ->getForm();
        $form->handleRequest($request);
        $selectedHotels = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $crit = $form->getData();
            $selectedHotels = $repository->findBy(['typehotel' => $crit->getTypehotel()]);
            $selectedChambres = $repository2->findBy(['typechambre' => $crit->getTypechambre()]);

            $hotelsData = $selectedHotels;
            return $this->redirect('/resultat?positionhotel' . $positionhotel . "arrivée=" . $arrivée . "départ=" . $départ . "chambre" . $typeschambre);
        }
        return $this->render('client/accueil.html.twig', [
            'hotels' => $hotels,
            'form' => $form->createView(),
            'types' => [],

            'notes' => [],
            'typeschambres' => []

        ]);

    }

}
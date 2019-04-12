<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 30/03/2019
 * Time: 20:53
 */

namespace App\Controller;

use App\Entity\Categoriechambre;
use App\Entity\Pension;
use App\Entity\Agence;
use App\Entity\Hotel;
use App\Entity\Chambre;
use function Symfony\Bridge\Twig\Extension\twig_is_selected_choice;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OffresController extends AbstractController
{
    /**
     * @Route("/offres",name="offre")
     */
    public function agenciesList(Request $request)
    {


        $offre = new Offre();
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $agences = $repository->findAll();
        $agencesArray = array();
        foreach ($agences as $a => $val) {
            $agencesArray[$val->getNomAgence()] = $val;
        }
        $repository1 = $this->getDoctrine()->getRepository(Hotel::class);
        $hotels = $repository1->findAll();
        $hotelsArray = array();
        foreach ($hotels as $a => $val) {
            $hotelsArray[$val->getNomhotel()] = $val;
        }
        $repository2 = $this->getDoctrine()->getRepository(Chambre::class);
        $chambres = $repository2->findAll();
        $chambresArray = array();
        foreach ($chambres as $a => $val) {
            $chambresArray[$val->getTypechambre() ] = $val;
        }
        $repository3 = $this->getDoctrine()->getRepository(Categoriechambre::class);
        $categoriechambre = $repository3->findAll();
        $categoriechambreArray = array();
        foreach ($categoriechambre as $a => $val) {
            $categoriechambreArray[$val->getCategorie()] = $val;
        }
        $repository4 = $this->getDoctrine()->getRepository(Pension::class);
        $pension = $repository4->findAll();
        $pensionArray = array();
        foreach ($pension as $a => $val) {
            $pensionArray[$val->getTypepension()] = $val;
        }


        //   var_dump($agences);

        // jib liste des agences
        // declaration mta3 array vide
        // boucle for bch n7adher el array
        // fel array 3andi nom => id

        $form = $this->createFormBuilder($offre)
            ->add('nomoffre', TextType::class)
            ->add('datedebut', TextType::class)
            ->add('datefin', TextType::class)
            ->add('lienoffre', TextType::class)
            ->add('agence', ChoiceType::class, [
                    'choices' => $agencesArray
                ]
            )
            ->add('hotel', ChoiceType::class, [
                    'choices' => $hotelsArray
                ]
            )
            ->add('chambre', ChoiceType::class,
                [
                    'choices' => $chambresArray
                ]
            )
<<<<<<< HEAD

//            ->add('tarif', TextType::class)
//            ->add('chambres', ChoiceType::class)
=======
            ->add('pension', ChoiceType::class)
            ->add('chambre', ChoiceType::class)
            ->add('tarif', TextType::class)
            ->add('chambres', ChoiceType::class)
>>>>>>> 2f39d60bec47236b8b7b8ae32c86b58bc2732c17
            ->add('categoriechambre', ChoiceType::class,
                [
                    'choices' => $categoriechambreArray
                ])
            ->add('pension', ChoiceType::class,
                [
                    'choices' => $pensionArray
                ])
            ->add('tariflocal', TextType::class)
<<<<<<< HEAD

=======
>>>>>>> 2f39d60bec47236b8b7b8ae32c86b58bc2732c17
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Offre::class);
        $DealsData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $offre = $form->getData();
//            var_dump($offre);
            $entityManager = $this->getDoctrine()->getManager();
//
//            $tarif = new Tarif();
//            $tarif->setPrix($offre->getTarifLocal());
//
//            $entityManager->persist($tarif);
//            $offre->setTarif($tarif);

            $entityManager->persist($offre);
            $entityManager->flush();
            $offre = $repository->findAll();
            return $this->redirectToRoute('offre');

        }
        return $this->render('admin/offres/offresList.html.twig', [
            'offres' => $DealsData,
            'form' => $form->createView(),

        ]);


    }

    /**
     * @Route("/offres/edit/{id}" ,name="editoffre")
     */
    public function editOffre(Request $request, $id)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        /* $agencesArray = array();
         foreach ($agencesArray as $a => $val) {
             $agencesArray[$val->setNomAgence()] = $val;
         }
 */
        $repository = $this->getDoctrine()->getRepository(Agence::class);

        $agences = $repository->findAll();
        $agencesArray = array();
        foreach ($agences as $a => $val) {
            $agencesArray[$val->getNomAgence()] = $val;
        }
        $repository1 = $this->getDoctrine()->getRepository(Hotel::class);

        $hotels = $repository1->findAll();
        $hotelsArray = array();
        foreach ($hotels as $a => $val) {
            $hotelsArray[$val->getNomhotel()] = $val;
        }

        $repository2 = $this->getDoctrine()->getRepository(Chambre::class);
        $chambres = $repository2->findAll();
        $chambresArray = array();
        foreach ($chambres as $a => $val) {
            $chambresArray[$val->getTypechambre()] = $val;
        }
        $repository3= $this->getDoctrine()->getRepository(Categoriechambre::class);

        $categories = $repository3->findAll();
        $categoriesArray = array();
        foreach ($categories as $a => $val) {
            $categoriesArray[$val->getCategorie()] = $val;
        }

        $repository4 = $this->getDoctrine()->getRepository(Pension::class);

        $pension = $repository4->findAll();
        $pensionArray = array();
        foreach ($pension as $a => $val) {
            $pensionArray[$val->getTypepension()] = $val;
        }
//        var_dump($offre->getAgence()->getNomAgence());
        $form = $this->createFormBuilder($offre)
            ->add('nomoffre', TextType::class)
            ->add('datedebut', TextType::class)
            ->add('datefin', TextType::class)
<<<<<<< HEAD
            ->add('lienoffre', TextType::class)
=======

            ->add('agence', ChoiceType::class)
            ->add('hotel', ChoiceType::class)
            ->add('pension', ChoiceType::class)
            ->add('chambre', ChoiceType::class)
            ->add('tarif', TextType::class)
            ->add('chambres', ChoiceType::class)

>>>>>>> 2f39d60bec47236b8b7b8ae32c86b58bc2732c17

            ->add('agence', ChoiceType::class,
                [
                    'choices' => $agencesArray,
                    'empty_data' => $offre->getAgence()->getNomAgence()
                ])
            ->add('hotel', ChoiceType::class,
                [
                    'choices' => $hotelsArray,
//                    'empty_data' => $offre->getHotel()->getNomhotel()
                ])
            ->add('chambre', ChoiceType::class,
                [
                    'choices' => $chambresArray,
                    'empty_data' => $offre->getChambre()->getTypechambre()
                ])
            ->add('categoriechambre', ChoiceType::class,
                [
                    'choices' => $categoriesArray,
//                    'empty_data' => $offre->getChambre()->getNomchambre()
                ])
            ->add('pension', ChoiceType::class,
                [
                    'choices' => $pensionArray,
                    'empty_data' => $offre->getPension()->getTypepension()
                ])
            ->add('tariflocal', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$offre) {
            throw $this->createNotFoundException(
                'No deal found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $offre->setDatedebut($form->getData()->getDatedebut());
            $offre->setDatefin($form->getData()->getDatefin());


            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offre');
        }
        return $this->render('admin/offres/editoffre.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/offres/delete/{id}",name="deleteoffre")
     */
    public function delete(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(offre::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(offre::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
            return $this->redirectToRoute('offre');
        }

        return $this->render('admin/offres/deleteoffre.html.twig', [
            'form' => $form->createView(),
        ]);


    }
}
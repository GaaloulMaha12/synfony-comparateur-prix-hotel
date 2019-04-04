<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 30/03/2019
 * Time: 20:53
 */

namespace App\Controller;
use App\Entity\Agence;
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
        $agencesArray = array("");
        foreach($agences as $a => $val) {
            $agencesArray[$val->getNomAgence()]= $val->getId();
        }

        var_dump($agences);

        // jib liste des agences
        // declaration mta3 array vide
        // boucle for bch n7adher el array
        // fel array 3andi nom => id

        $form = $this->createFormBuilder($offre)
            ->add('nomoffre', TextType::class)
            ->add('datedebut', TextType::class)
            ->add('datefin', TextType::class)
            ->add('agence', ChoiceType::class, [
             'choices' => $agencesArray
                    ]
            )
            ->add('hotel', ChoiceType::class)
            ->add('pension', ChoiceType::class)
            ->add('chambre', ChoiceType::class)

            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Offre::class);
        $DealsData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $offre = $form->getData();
            var_dump($offre);
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($offre);
//            $entityManager->flush();
            $offre = $repository->findAll();
            return $this->redirectToRoute('offre');

        }
        return $this->render('admin/offres/offresList.html.twig', [
            'offres' =>  $DealsData,
            'form' => $form->createView(),

        ]);


    }
    /**
     * @Route("/offres/edit/{id}" ,name="editoffre")
     */
    public function editAgency(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(offre::class)->find($id);


        $form = $this->createFormBuilder($offre)
            ->add('nomoffre', TextType::class)
            ->add('datedebut', TextType::class)
            ->add('datefin', TextType::class)
            ->add('agence', ChoiceType::class)
            ->add('hotel', ChoiceType::class)
            ->add('pension', ChoiceType::class)
            ->add('chambre', ChoiceType::class)

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
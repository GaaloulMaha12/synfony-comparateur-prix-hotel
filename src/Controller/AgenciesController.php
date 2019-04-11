<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 28/03/2019
 * Time: 14:26
 */

namespace App\Controller;

use App\Entity\Agence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AgenciesController extends AbstractController
{


    /**
     * @Route("/agences",name="agence")
     */
    public function agenciesList(Request $request)
    {
        $agence = new Agence();
        $form = $this->createFormBuilder($agence)
            ->add('nom_agence', TextType::class)
            ->add('lien_agence', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $usersData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
//            $agence = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agence);
            $entityManager->flush();
            return $this->redirectToRoute('agence');
        }
        return $this->render('admin/agences/agencesList.html.twig', [
            'agences' => $usersData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/agences/edit/{id}" ,name="editAgency")
     */
    public function editagency(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $agence = $entityManager->getRepository(agence::class)->find($id);


        $form = $this->createFormBuilder($agence)
            ->add('nom_agence', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$agence) {
            throw $this->createNotFoundException(
                'No agency found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $agence->setNomAgence($form->getData()->getNomAgence());


            $entityManager->persist($agence);
            $entityManager->flush();

            return $this->redirectToRoute('agence');
        }
        return $this->render('admin/agences/editagency.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/agences/deleteagency/{id}",name="deleteagency")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function delete(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $agence = $entityManager->getRepository(agence::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(agence::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($agence);
            $entityManager->flush();
            return $this->redirectToRoute('agence');
        }

        return $this->render('admin/agences/deleteagency.html.twig', [
            'form' => $form->createView(),
        ]);


    }


}
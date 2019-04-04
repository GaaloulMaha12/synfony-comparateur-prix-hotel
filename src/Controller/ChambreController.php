<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 04/04/2019
 * Time: 11:56
 */

namespace App\Controller;
use App\Entity\Chambre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ChambreController extends  AbstractController
{
    /**
    /**
     * @Route("/chambres",name="chambres")
     */
    public function chambreList(Request $request)
    {


        $chambre = new chambre();


        $form = $this->createFormBuilder($chambre)
            ->add('nomchambre', TextType::class)
            ->add('typechambre', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(chambre::class);
        $chambresData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $chambre = $form->getData();
            $entityManager->persist($chambre);
            $entityManager->flush();
            $chambre = $repository->findAll();
            return $this->redirectToRoute('chambres');

        }
        return $this->render('admin/chambres/chambreList.html.twig', [
            'chambres' => $chambresData,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/chambre/edit/{id}" ,name="editchambre")
     */
    public function editChambre(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $chambre = $entityManager->getRepository(chambre::class)->find($id);


        $form = $this->createFormBuilder($chambre)
            ->add('nomchambre', TextType::class)
            ->add('typechambre', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$chambre) {
            throw $this->createNotFoundException(
                'No chambres found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $chambre->setNomchambre($form->getData()->getNomchambre());
            $chambre->setTypechambre($form->getData()->getTypechambre());


            $entityManager->persist($chambre);
            $entityManager->flush();

            return $this->redirectToRoute('chambres');
        }
        return $this->render('admin/chambres/editchambre.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/chambre/delete/{id}",name="deletechambre")
     */
    public function deleteChambre(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $chambre = $entityManager->getRepository(chambre::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(chambre::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chambre);
            $entityManager->flush();
            return $this->redirectToRoute('chambres');
        }

        return $this->render('admin/chambres/deletechambre.html.twig', [
            'form' => $form->createView(),
        ]);


    }

}
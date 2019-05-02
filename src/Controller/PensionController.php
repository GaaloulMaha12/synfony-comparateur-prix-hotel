<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 03/04/2019
 * Time: 16:22
 */

namespace App\Controller;


use App\Entity\Pension;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\HttpFoundation\Request;
class PensionController extends AbstractController
{
    /**
     * @Route("/pension",name="pension")
     * @IsGranted("ROLE_ADMIN")
     */
    public function pensionList(Request $request)
    {

        $pension = new Pension();

        $form = $this->createFormBuilder($pension)
            ->add('typepension', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Pension::class);
        $pensionData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $pension = $form->getData();
            $entityManager->persist($pension);
            $entityManager->flush();
            $pension = $repository->findAll();

            return $this->redirectToRoute('pension');


        }

        return $this->render('admin/pension/pensionList.html.twig', [
            'pension' => $pensionData,
            'form' => $form->createView(),

        ]);

    }
    /**
     * @Route("/pension/delete/{id}",name="deletepension")

     */
    public function deletePension(request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $entityManager = $this->getDoctrine()->getManager();
        $pension = $entityManager->getRepository(pension::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(pension::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pension);
            $entityManager->flush();
            return $this->redirectToRoute('pension');
        }

        return $this->render('admin/pension/deletepension.html.twig', [
            'form' => $form->createView(),
        ]);


    }
    /**
     * @Route("/pension/edit/{id}" ,name="editpension")

     */
    public function editPension(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $entityManager = $this->getDoctrine()->getManager();
        $pension = $entityManager->getRepository(pension::class)->find($id);




        $form = $this->createFormBuilder($pension)
            ->add('typepension', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();



        $form->handleRequest($request);


        if (!$pension) {
            throw $this->createNotFoundException(
                'No pension found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $pension->setTypepension($form->getData()->getTypepension());


            $entityManager->persist($pension);
            $entityManager->flush();

            return $this->redirectToRoute('pension');
        }
        return $this->render('admin/pension/editpension.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
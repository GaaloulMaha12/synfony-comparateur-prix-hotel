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
use Symfony\Component\HttpFoundation\Request;
class PensionController extends AbstractController
{
    /**
     * @Route("/pension",name="pension")
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
}
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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class PensionController extends AbstractController
{
    /**
     * @Route("/pension",name="pension")
     */
    public function pensionList (Request $request)
    {

        $pension = new Pension ();

        $form = $this->createFormBuilder($pension)
            ->add('typepension', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(pension::class);
        $pensionData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $pension = $form->getData();
            $entityManager->persist($pension);
            $entityManager->flush();
            $pension = $repository->findAll();

            return $this->redirectToRoute('pension');


        }
    }

}
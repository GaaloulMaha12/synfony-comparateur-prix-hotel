<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 26/03/2019
 * Time: 16:22
 */

namespace App\Controller;

use App\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsersController extends AbstractController
{

    /**
     * @Route("/users", name="users")
     */
    public function usersList(Request $request)
    {

        $administrateur = new Administrateur();


//        $form = $this->createFormBuilder($administrateur)
        //            ->add('Administrateur', TextType::class)
        $form = $this->createFormBuilder($administrateur)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Administrateur::class);
        $usersData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $administrateur = $form->getData();
            $entityManager->persist($administrateur);
            $entityManager->flush();
            $adminstrateur = $repository->findAll();
            return $this->redirectToRoute('users');

        }
        return $this->render('admin/users/usersList.html.twig', [
            'users' => $usersData,
            'form' => $form->createView(),

        ]);


    }


    /**
     * @Route("/users/edit/{id}",name="edit")
     */
    public function edit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $administrateur = $entityManager->getRepository(administrateur::class)->find($id);


        $form = $this->createFormBuilder($administrateur)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$administrateur) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $administrateur->setNom($form->getData()->getNom());
            $administrateur->setPrenom($form->getData()->getPrenom());
            $administrateur->setEmail($form->getData()->getEmail());
            $administrateur->setPassword($form->getData()->getPassword());


            $entityManager->persist($administrateur);
            $entityManager->flush();

            return $this->redirectToRoute('edit');
        }
        return $this->render('admin/users/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/delete/{id}",name="delete")
     */
    public function delete(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $administrateur = $entityManager->getRepository(administrateur::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Administrateur::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($administrateur);
            $entityManager->flush();
            return $this->redirectToRoute('users');
        }

        return $this->render('admin/users/delete.html.twig', [
            'form' => $form->createView(),
        ]);


    }

}


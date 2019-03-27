<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 27/03/2019
 * Time: 15:04
 */

namespace App\Controller;

namespace App\Controller;

use App\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function authentifier(Request $request)
    {
        $administrateur = new Administrateur();

        $form = $this->createFormBuilder($administrateur)
//            ->add('administrateur', TextType::class)
            ->add('email', TextType::class ,['label' => ' ' ,
                'attr' => ['placeholder' => 'email'],
            ])
            ->add('password', TextType::class,  ['label' => ' ' ,
                'attr' => ['placeholder' => 'password'],
            ])
            ->add('se connecter', SubmitType::class , [
                'attr' => ['class' => 'btn btn-primary btn-block btn-large'],
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $administrateurForm = $form->getData();
            $repository = $this->getDoctrine()->getRepository(Administrateur::class);
            $usersData = $repository->findOneBy(['email' => $administrateurForm->getEmail()]);
            $message = '';
            if ($usersData == NULL) {
                $message = 'invalid email';
                return $this->render('admin/auth/login.html.twig', [
                    'form' => $form->createView(),
                    'message' => $message
                ]);
            }

            if ($usersData->getPassword() != $administrateurForm->getPassword()) {
                $message = 'invalid password';
                return $this->render('admin/auth/login.html.twig', [
                    'form' => $form->createView(), 'message' => $message
                ]);
            }

            return $this->redirectToRoute('dashboard');

        }

        return $this->render('admin/auth/login.html.twig', ['form' => $form->createView(),
            'message' => '']);
    }
}
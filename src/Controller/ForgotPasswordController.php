<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 29/04/2019
 * Time: 09:46
 */

namespace App\Controller;

use App\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route("/ForgotPassword", name="forgotPassword")
     */
    public function ForgotPassword(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createFormBuilder()
            ->add('email', TextType::class, ['label' => ' ',
                'attr' => ['placeholder' => 'email'],
            ])
            ->add('reinitialiser le mot de passe ', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary btn-block btn-large'],
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $administrateurForm = $form->getData();
            $repository = $this->getDoctrine()->getRepository(Administrateur::class);
            $usersData = $repository->findOneBy(['email' => $administrateurForm["email"]]);
//            var_dump($usersData->getEmail());

            // generate a random string with 8 chars
            // update admin password
            $pass = "";
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, strlen($alphabet) - 1);
                $pass[$i] = $alphabet[$n];

            }
            $entityManager = $this->getDoctrine()->getManager();
            $admin = $entityManager->getRepository(Administrateur::class)->find($usersData->getId());
            $admin->setPassword($pass);
            $entityManager->flush();

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom($usersData->getEmail())//sender email
                ->setTo($usersData->getEmail())//reciever email
                ->setBody(
                    " hello  your new password " . $pass
                );
            $mailermsg = $mailer->send($message);


            $message = 'invalid email';
            return $this->render('admin/auth/forgotPassword.html.twig', [
                'form' => $form->createView(),
                'message' => $message
            ]);
        }
        return $this->render('admin/auth/forgotPassword.html.twig', ['form' => $form->createView(),
            'message' => '']);
    }
}

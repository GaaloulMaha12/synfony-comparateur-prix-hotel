<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityController extends AbstractController
{
    use TargetPathTrait;

    /**
     * @Route("/login", name="login")
     */
//    public function connexion()
//    {
//        $user = new User();
//
//        return $this->render('security/index.html.twig', [
//
//        ]);


    public function login(Request $request, AuthenticationUtils $helper): Response
    {

        $this->saveTargetPath($request->getSession(), 'main',
            $this->generateUrl('dashboard'));
        $form = $this->createFormBuilder()
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
        return $this->render('admin/auth/login.html.twig', [
            // last username entered by the user (if any)
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
            'form' => $form->createView(),
            'message'=>''
        ]);
    }


    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in config/packages/security.yaml
     *
     * @Route("/logout", name="security_logout")
     */


    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }


}


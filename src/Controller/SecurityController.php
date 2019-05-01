<?php

namespace App\Controller;

use App\Entity\Administrateur;
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
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/auth/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    /**
 * This is the route the user can use to logout.
 *
 * But, this will never be executed. Symfony will intercept this first
 * and handle the logout automatically. See logout in config/packages/security.yaml
 *
 * @Route("/logout", name="logout")
 */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}


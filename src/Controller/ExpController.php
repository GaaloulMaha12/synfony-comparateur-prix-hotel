<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 25/04/2019
 * Time: 19:55
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ExpController extends AbstractController
{
    /**
     * @Route("/exp")
     */

    public function pageAccueil(request $request)
    {
        return $this->render('client/exp.html.twig'

    );
    }

}
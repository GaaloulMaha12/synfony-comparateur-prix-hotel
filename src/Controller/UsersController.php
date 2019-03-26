<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 26/03/2019
 * Time: 16:22
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{

    /**
     * @Route("/users", name="users")
     */
    public function usersList()
    {
        return $this->render('admin/users/usersList.html.twig');
    }

}
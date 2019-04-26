<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 04/04/2019
 * Time: 17:18
 */

namespace App\Controller;

use App\Entity\Parametre ;
use App\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Bridge\Twig\Extension\twig_is_selected_choice;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ParametreController extends  AbstractController
{
    /**
    /**
     * @Route("/parametres",name="parametres")
     */
    public function parametreList(Request $request)
    {



        $parametre = new Parametre();
        $repository = $this->getDoctrine()->getRepository(Administrateur::class);
        $administrateurs = $repository->findAll();
        $administrateursArray = array();
        foreach ($administrateurs as $a => $val) {
            $administrateursArray[$val->getNom()] = $val;
        }

        $form = $this->createFormBuilder($parametre)

            ->add('nomparametre', TextType::class)
            ->add('typeparametre', TextType::class)
            ->add('valeurparametre', TextType::class)
            ->add('administrateur', ChoiceType::class,
                [
                    'choices' => $administrateursArray
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Parametre::class);
        $parametresData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $parametre = $form->getData();
            $entityManager->persist($parametre);
            $entityManager->flush();
            $parametre = $repository->findAll();
            return $this->redirectToRoute('parametres');

        }
        return $this->render('admin/parametres/parametreList.html.twig', [
            'parametres' => $parametresData,
            'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/parametres/edit/{id}" ,name="editparametre")
     */
    public function editParametre(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $parametre = $entityManager->getRepository(parametre::class)->find($id);

        $repository= $this->getDoctrine()->getRepository(Administrateur::class);
        $administrateurs = $repository->findAll();
        $administrateursArray = array();
        foreach ($administrateurs as $a => $val) {
            $administrateursArray[$val->getNom()] = $val;
        }
        $form = $this->createFormBuilder($parametre)
            ->add('nomparametre', TextType::class)
            ->add('typeparametre', TextType::class)
            ->add('valeurparametre', TextType::class)
            ->add('administrateur', ChoiceType::class,
                [
                    'choices' => $administrateursArray,
                    'empty_data' => $parametre->getAdministrateur()->getNom()
                ])
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$parametre) {
            throw $this->createNotFoundException(
                'No hotel found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $parametre->setNomparametre($form->getData()->getNomparametre());
            $parametre->setTypeparametre($form->getData()->getTypeparametre());
            $parametre->setValeurparametre($form->getData()->getValeurparametre());

            $entityManager->persist($parametre);
            $entityManager->flush();

            return $this->redirectToRoute('parametres');
        }
        return $this->render('admin/parametres/editparametre.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
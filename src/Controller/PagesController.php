<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 01/04/2019
 * Time: 11:06
 */

namespace App\Controller;
use App\Entity\Page;
use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PagesController extends AbstractController
{
    /**
     * @Route("/pages",name="page")
     */
    public function pagesList(Request $request)
    {


        $page = new Page();



        $form = $this->createFormBuilder( $page)
            ->add('typepage', TextType::class)
            ->add('titrepage', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Page::class);
        $PagesData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $page = $form->getData();
            $entityManager->persist( $page);
            $entityManager->flush();
            $page = $repository->findAll();
            return $this->redirectToRoute('page');

        }
        return $this->render('admin/pages/pagesList.html.twig', [
            'pages' => $PagesData,
            'form' => $form->createView(),

        ]);


    }
    /**
     * @Route("/pages/editpage/{id}" ,name="editpage")
     */
    public function editAgency(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $page = $entityManager->getRepository(page::class)->find($id);


        $form = $this->createFormBuilder(  $page)
            ->add('typepage', TextType::class)
            ->add('titrepage',TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$page) {
            throw $this->createNotFoundException(
                'No page found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $page->setTypepage($form->getData()->getTypepage());
            $page->setTitrepage($form->getData()->getTitrepage());

            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('page');
        }
        return $this->render('admin/pages/editpage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pages/deletepage/{id}",name="deletepage")
     */
    public function delete(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $page = $entityManager->getRepository(page::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(page::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($page);
            $entityManager->flush();
            return $this->redirectToRoute('page');
        }

        return $this->render('admin/pages/deletepage.html.twig', [
            'form' => $form->createView(),
        ]);


    }








}
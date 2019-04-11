<?php


namespace App\Controller;
use App\Entity\Categoriechambre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CategoriesController extends  AbstractController
{
    /**
    /**
     * @Route("/categories",name="categories")
     */
    public function categoriesList(Request $request)
    {


        $categoriechambre = new Categoriechambre();



        $form = $this->createFormBuilder($categoriechambre)
            ->add('categorie', TextType::class)

            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Categoriechambre::class);
        $usersData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $categoriechambre = $form->getData();
            $entityManager->persist($categoriechambre);
            $entityManager->flush();
            $categoriechambre = $repository->findAll();
            return $this->redirectToRoute('categories');

        }
        return $this->render('admin/categories/categoriesList.html.twig', [
            'categories' => $usersData,
            'form' => $form->createView(),

        ]);

    }

    /**
     * @Route("/categories/edit/{id}" ,name="editcategorie")
     */
    public function editCategorie(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriechambre  = $entityManager->getRepository(categoriechambre ::class)->find($id);


        $form = $this->createFormBuilder($categoriechambre )

            ->add('categorie', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$categoriechambre ) {
            throw $this->createNotFoundException(
                'No categorie found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $categoriechambre ->setCategorie($form->getData()->getCategorie());


            $entityManager->persist($categoriechambre );
            $entityManager->flush();

            return $this->redirectToRoute('categories');
        }
        return $this->render('admin/categories/editcategorie.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/categories/delete/{id}",name="deletecategorie")
     */
    public function deleteCategorie(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriechambre  = $entityManager->getRepository(categoriechambre ::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(categoriechambre ::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriechambre );
            $entityManager->flush();
            return $this->redirectToRoute('categories');
        }

        return $this->render('admin/categories/deletecategorie.html.twig', [
            'form' => $form->createView(),
        ]);


    }

}
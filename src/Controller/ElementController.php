<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 06/04/2019
 * Time: 09:01
 */

namespace App\Controller;

use App\Entity\Element;
use App\Entity\Page;
use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Router;

/**
 * @property  router
 */
class ElementController extends AbstractController
{
    private $router;

    /**
     * /**
     * @Route("/elements/elementList/{id}",name="elements")
     */
    public function elementList(Request $request,$id)
    {
        $element = new Element();


        $form = $this->createFormBuilder($element)
            ->add('contenuelement', TextType::class)
            ->add('typeelement', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Element::class);
        $elementsData = $repository->findBy(['page'=> $id]);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Page::class);
            $page = $repository->find($id);

            $element = $form->getData();
            $element->setPage($page);
            $entityManager->persist($element);
            $entityManager->flush();
            $element = $repository->findAll();

            return $this->redirect('/elements/elementList/'. $id);

        }
        return $this->render('admin/elements/elementList.html.twig', [
            'elements' => $elementsData,
            'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/pages/deletelement/{id}",name="deleteelement")
     */
    public function delete(request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(element::class);

        if ($form->isSubmitted() && $form->isValid()) {

            $elem = $repository->find($id);
            $idpage = $elem->getPage()->getId();
            $entityManager->remove($elem);
            $entityManager->flush();
            return $this->redirect('/elements/elementList/'. $idpage);
        }

        return $this->render('admin/elements/deleteElement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/elements/editelement/{id}" ,name="editelement")
     */
    public function editElement(Request $request, $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $element = $entityManager->getRepository(Element::class)->find($id);


        $form = $this->createFormBuilder($element)
            ->add('typeelement', TextType::class)
            ->add('contenuelement', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$element) {
            throw $this->createNotFoundException(
                'No element found for id ' . $id
            );
        }

        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Element::class);

            $elem = $repository->find($id);
            $idpage = $elem->getPage()->getId();
            $entityManager->persist($elem);
            $element->setTypeelement($form->getData()->getTypeelement());
            $element->setContenuelement($form->getData()->getContenuelement());

            $entityManager->flush();

            return $this->redirect('/elements/elementList/'. $idpage);
        }
        return $this->render('admin/elements/editelement.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
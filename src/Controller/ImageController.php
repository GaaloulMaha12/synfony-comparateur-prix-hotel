<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 25/04/2019
 * Time: 17:51
 */

namespace App\Controller;
use App\Entity\Image;
use App\Entity\Hotel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Router;

class ImageController extends AbstractController
{
    private $router;

    /**
     * /**
     * @Route("/images/imageList/{id}",name="image")

     */
    public function imageList(Request $request,$id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $image = new image();


        $form = $this->createFormBuilder($image)

            ->add('imagehotel', TextType::class)

            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Image::class);
        $imagesData = $repository->findBy(['hotel' => $id]);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(hotel::class);
            $hotel = $repository->find($id);

            $image = $form->getData();
            $image->sethotel($hotel);
            $entityManager->persist($image);
            $entityManager->flush();
            $image = $repository->findAll();

            return $this->redirect('/images/imageList/' . $id);

        }
        return $this->render('admin/images/imageList.html.twig', [
            'images' => $imagesData,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/images/deleteimage/{id}",name="deleteimage")

     */
    public function deleteimage (request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(image::class);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagehotel = $repository->find($id);
            $idimage = $imagehotel->getHotel()->getId();
            $entityManager->remove($imagehotel);
            $entityManager->flush();
            return $this->redirect('/images/imageList/'. $idimage);
        }

        return $this->render('admin/images/deleteimage.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/images/editeimage/{id}" ,name="editeimage")
     */
    public function editImage(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $entityManager = $this->getDoctrine()->getManager();
        $image = $entityManager->getRepository(Image::class)->find($id);


        $form = $this->createFormBuilder($image)
            ->add('imagehotel', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$image) {
            throw $this->createNotFoundException(
                'No element found for id ' . $id
            );
        }



        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Image::class);

            $elemimage = $repository->find($id);
            $idimage = $image->getHotel()->getId();
            $entityManager->persist($elemimage);
            $image->setImagehotel($form->getData()->getImagehotel());


            $entityManager->flush();

            return $this->redirect('/images/imageList/'. $idimage);
        }
        return $this->render('admin/images/editimage.html.twig', [
            'form' => $form->createView(),
        ]);
    }




}
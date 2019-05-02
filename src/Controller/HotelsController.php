<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 29/03/2019
 * Time: 10:15
 */



namespace App\Controller;

use App\Entity\{
    Hotel
};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HotelsController extends  AbstractController
{

    /**
    /**
     * @Route("/hotels",name="hotel")
     * @IsGranted("ROLE_ADMIN")
     */
    public function hotelsList(Request $request)
    {


        $hotel = new Hotel();



        $form = $this->createFormBuilder($hotel)
            ->add('nomhotel', TextType::class)
            ->add('positionhotel', TextType::class)
            ->add('typehotel', TextType::class)
            ->add('adresse', TextType::class)
            ->add('note', TextType::class)
            ->add('service', TextType::class)
            ->add('description', TextType::class)
            ->add('image', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $usersData = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $hotel = $form->getData();
            $entityManager->persist($hotel);
            $entityManager->flush();
            $hotel = $repository->findAll();
            return $this->redirectToRoute('hotel');

        }
        return $this->render('admin/hotels/hotelsList.html.twig', [
            'hotels' => $usersData,
            'form' => $form->createView(),

        ]);


    }

    /**
     * @Route("/hotels/edit/{id}" ,name="edithotel")

     */
    public function editHotel(Request $request, $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $hotel = $entityManager->getRepository(hotel::class)->find($id);


        $form = $this->createFormBuilder($hotel)
            ->add('nomhotel', TextType::class)
            ->add('positionhotel', TextType::class)
            ->add('typehotel', TextType::class)
            ->add('adresse', TextType::class)
            ->add('note', TextType::class)
            ->add('service', TextType::class)
            ->add('description', TextType::class)
            ->add('image', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$hotel) {
            throw $this->createNotFoundException(
                'No hotel found for id ' . $id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $hotel->setNomhotel($form->getData()->getNomhotel());
            $hotel->setPositionhotel($form->getData()->getPositionhotel());
            $hotel->setTypehotel($form->getData()->getTypehotel());
            $hotel->setNote($form->getData()->getNote());
            $hotel->setService($form->getData()->getService());
            $hotel->setDescription($form->getData()->getDescription());
            $hotel->setImage($form->getData()->getImage());

            $entityManager->persist($hotel);
            $entityManager->flush();

            return $this->redirectToRoute('hotel');
        }
        return $this->render('admin/hotels/edithotel.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/hotels/delete/{id}",name="deletehotel")

     */
    public function deleteHotel(request $request, $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $hotel = $entityManager->getRepository(hotel::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(hotel::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hotel);
            $entityManager->flush();
            return $this->redirectToRoute('hotel');
        }

        return $this->render('admin/hotels/deletehotel.html.twig', [
            'form' => $form->createView(),
        ]);


    }


}
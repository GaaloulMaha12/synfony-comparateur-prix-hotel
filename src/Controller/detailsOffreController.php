<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 19/04/2019
 * Time: 20:25
 */

namespace App\Controller;
use App\Entity\Detailsoffre;
use App\Entity\Offre;
use App\Entity\Categoriechambre;
use App\Entity\Pension;
use App\Entity\Chambre;

use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Router;
use function Symfony\Bridge\Twig\Extension\twig_is_selected_choice;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Validator\Constraints\Date;


class detailsOffreController extends AbstractController
{
    private $router;

    /**
     * /**
     * @Route("/detailsoffres/detailsoffreList/{id}",name="detailsoffres")
     */
    public function detailsoffreList(Request $request,$id)
    {
        $detailsoffre = new detailsoffre();
        $repository2 = $this->getDoctrine()->getRepository(Chambre::class);
        $chambres = $repository2->findAll();
        $chambresArray = array();
        foreach ($chambres as $a => $val) {
            $chambresArray[$val->getTypechambre()] = $val;
        }
        $repository3 = $this->getDoctrine()->getRepository(Categoriechambre::class);
        $categoriechambre = $repository3->findAll();
        $categoriechambreArray = array();
        foreach ($categoriechambre as $a => $val) {
            $categoriechambreArray[$val->getCategorie()] = $val;
        }
        $repository4 = $this->getDoctrine()->getRepository(Pension::class);
        $pension = $repository4->findAll();
        $pensionArray = array();
        foreach ($pension as $a => $val) {
            $pensionArray[$val->getTypepension()] = $val;
        }


        $form = $this->createFormBuilder($detailsoffre)
            ->add('chambre', ChoiceType::class,
                [
                    'choices' => $chambresArray
                ]
            )

            ->add('categoriechambre', ChoiceType::class,
                [
                    'choices' => $categoriechambreArray
                ])
            ->add('pension', ChoiceType::class,
                [
                    'choices' => $pensionArray
                ])
            ->add('tarif', TextType::class)
            ->add('lienoffre', TextType::class)

            ->add('save', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Detailsoffre::class);
        $detailsoffresData = $repository->findBy(['offre' => $id]);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Offre::class);
            $offre = $repository->find($id);

            $detailsoffre = $form->getData();
            $detailsoffre->setOffre($offre);
            $entityManager->persist($detailsoffre);
            $entityManager->flush();
            $detailsoffre = $repository->findAll();

            return $this->redirect('/detailsoffres/detailsoffreList/' . $id);

        }
        return $this->render('admin/detailsoffres/detailsoffreList.html.twig', [
            'detailsoffres' => $detailsoffresData,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/detailsoffres/editdetail/{id}" ,name="editdetail")
     */
    public function editElement(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $detailsoffre = $entityManager->getRepository(Detailsoffre::class)->find($id);


        $repository2 = $this->getDoctrine()->getRepository(Chambre::class);
        $chambres = $repository2->findAll();
        $chambresArray = array();
        foreach ($chambres as $a => $val) {
            $chambresArray[$val->getTypechambre()] = $val;
        }
        $repository3= $this->getDoctrine()->getRepository(Categoriechambre::class);

        $categories = $repository3->findAll();
        $categoriesArray = array();
        foreach ($categories as $a => $val) {
            $categoriesArray[$val->getCategorie()] = $val;
        }

        $repository4 = $this->getDoctrine()->getRepository(Pension::class);

        $pension = $repository4->findAll();
        $pensionArray = array();
        foreach ($pension as $a => $val) {
            $pensionArray[$val->getTypepension()] = $val;
        }


        $form = $this->createFormBuilder($detailsoffre)
            ->add('Typechambre', ChoiceType::class,
                [
                    'choices' => $chambresArray,
                    'empty_data' => $detailsoffre->getChambre()->getTypechambre()
                ])
            ->add('categoriechambre', ChoiceType::class,
                [
                    'choices' => $categoriesArray,
//                    'empty_data' => $detailsoffre->getChambre()->getNomchambre()
                ])
            ->add('typepension', ChoiceType::class,
                [
                    'choices' => $pensionArray,
                    'empty_data' => $detailsoffre->getPension()->getTypepension()
                ])
            ->add('prix', TextType::class)
            ->add('lienoffre', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'modifier'])
            ->getForm();


        $form->handleRequest($request);


        if (!$detailsoffre) {
            throw $this->createNotFoundException(
                'No element found for id ' . $id
            );
        }



        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Detailsoffre::class);

            $detail = $repository->find($id);
            $iddetail = $detail->getOffre()->getId();
            $entityManager->persist($detail);
            $detailsoffre->setTypechambre($form->getData()->getTypechambre());
            $detailsoffre->setCategorie($form->getData()->getCategorie());
            $detailsoffre->setTypepension($form->getData()->getTypepension());
            $detailsoffre->setTarif($form->getData()->getTarif());
            $detailsoffre->setLienOffre($form->getData()->getLienOffre());

            $entityManager->flush();

            return $this->redirect('/detailsoffres/detailsoffreList/'. $iddetail);
        }
        return $this->render('admin/detailsoffres/editdetail.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detailsoffres/deletedetail/{id}",name="deletedetail")
     */
    public function deletedetail (request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->getForm();

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(detailsoffre::class);

        if ($form->isSubmitted() && $form->isValid()) {

            $detail = $repository->find($id);
            $iddetail = $detail->getOffre()->getId();
            $entityManager->remove($detail);
            $entityManager->flush();
            return $this->redirect('/detailsoffres/detailsoffreList/'. $iddetail);
        }

        return $this->render('admin/detailsoffres/deletedetail.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
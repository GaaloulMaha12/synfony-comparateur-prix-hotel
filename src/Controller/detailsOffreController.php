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

}
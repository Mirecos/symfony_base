<?php

namespace App\Controller;

use App\Entity\Style;
use App\Form\StyleFormType;
use App\Repository\StyleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StyleController extends AbstractController
{
    #[Route('/{_locale}/style', name: 'app_style', requirements:['_locale'=>'en|fr'])]
    public function index(StyleRepository $styleRepository): Response
    {
        $styles = $styleRepository->findAll();

        return $this->render('style/index.html.twig', [
            'controller_name' => 'StyleController',
            'styles' => $styles
        ]);
    }

    #[Route('/{_locale}/style/creation', name: 'app_style_creation', methods: ['GET', 'POST'], requirements:['_locale'=>'en|fr'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $style = new Style();
        $form = $this->createForm(StyleFormType::class, $style);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($style);
            $em->flush();
    
            $this->addFlash('success', 'Style créé!');
            return $this->redirectToRoute('app_style');
        }
    
        return $this->render('style/ajout_style.html.twig', [
            'style' => $style,
            'form' => $form->createView()
        ]);
    }
}

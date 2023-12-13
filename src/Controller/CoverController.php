<?php

namespace App\Controller;

use App\Entity\Cover;
use App\Form\CoverFormType;
use App\Repository\CoverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoverController extends AbstractController
{
    #[Route('/{_locale}/cover', name: 'app_cover', requirements:['_locale'=>'en|fr'])]
    public function index(CoverRepository $coverRepository): Response
    {

        $covers = $coverRepository->findAll();

        return $this->render('cover/index.html.twig', [
            'controller_name' => 'CoverController',
            'covers' => $covers
        ]);
    }

    #[Route('/{_locale}/cover/creation', name: 'app_cover_creation', methods: ['GET', 'POST'], requirements:['_locale'=>'en|fr'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $cover = new Cover();
        $form = $this->createForm(CoverFormType::class, $cover);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cover);
            $em->flush();
    
            $this->addFlash('success', 'Cover créé!');
            return $this->redirectToRoute('app_cover');
        }
    
        return $this->render('cover/ajout_cover.html.twig', [
            'cover' => $cover,
            'form' => $form->createView()
        ]);
    }
}

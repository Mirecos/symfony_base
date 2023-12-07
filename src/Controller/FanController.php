<?php

namespace App\Controller;

use App\Entity\Fan;
use App\Form\FanFormType;
use App\Repository\FanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FanController extends AbstractController
{
    #[Route('/{_locale}/fan', name: 'app_fan', requirements:['_locale'=>'en|fr'])]
    public function index(FanRepository $fanRepository): Response
    {
        $fans = $fanRepository->findAll();

        return $this->render('fan/index.html.twig', [
            'controller_name' => 'FanController',
            'fans' => $fans
        ]);
    }

    #[Route('/{_locale}/fan/creation', name: 'app_fan_creation', methods: ['GET', 'POST'], requirements:['_locale'=>'en|fr'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $fan = new Fan();
        $form = $this->createForm(FanFormType::class, $fan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($fan);
            $em->flush();
    
            $this->addFlash('success', 'Fan créé!');
            return $this->redirectToRoute('app_fan');
        }
    
        return $this->render('fan/ajout_fan.html.twig', [
            'fan' => $fan,
            'form' => $form->createView()
        ]);
    }
}

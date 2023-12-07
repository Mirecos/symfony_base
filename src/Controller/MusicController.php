<?php

namespace App\Controller;

use App\Entity\Music;
use App\Form\MusicFormType;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MusicController extends AbstractController
{
    #[Route('/{_locale}/music', name: 'app_music', requirements:['_locale'=>'en|fr'])]
    public function index(Request $request, MusicRepository $musicRepository): Response
    {

        $musics = $musicRepository->findAll();

        return $this->render('music/index.html.twig', [
            'controller_name' => 'MusicController',
            'musics' => $musics
        ]);
    }

    #[Route('/{_locale}/music/creation', name: 'app_music_creation', methods: ['GET', 'POST'], requirements:['_locale'=>'en|fr'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {

        $music = new Music();
        $form = $this->createForm(MusicFormType::class, $music);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($music);
            $em->flush();
    
            $this->addFlash('success', 'Music créé!');
            return $this->redirectToRoute('app_music');
        }
    
        return $this->render('music/ajout_music.html.twig', [
            'music' => $music,
            'form' => $form->createView()
        ]);
    }
}

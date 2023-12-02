<?php

namespace App\Controller;

use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    #[Route('/music', name: 'app_music')]
    public function index(MusicRepository $musicRepository): Response
    {
        $musics = $musicRepository->findAll();

        return $this->render('music/index.html.twig', [
            'controller_name' => 'MusicController',
            'musics' => $musics
        ]);
    }
}

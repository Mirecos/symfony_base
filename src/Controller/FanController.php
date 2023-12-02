<?php

namespace App\Controller;

use App\Repository\FanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FanController extends AbstractController
{
    #[Route('/fan', name: 'app_fan')]
    public function index(FanRepository $fanRepository): Response
    {
        $fans = $fanRepository->findAll();

        return $this->render('fan/index.html.twig', [
            'controller_name' => 'FanController',
            'fans' => $fans
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FanController extends AbstractController
{
    #[Route('/fan', name: 'app_fan')]
    public function index(): Response
    {
        return $this->render('fan/index.html.twig', [
            'controller_name' => 'FanController',
        ]);
    }
}

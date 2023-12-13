<?php

namespace App\Controller;

use App\Event\UserListener;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/{_locale}/users', name: 'app_users', requirements:['_locale'=>'en|fr'])]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $users
        ]);
    }
}

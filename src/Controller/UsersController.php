<?php

namespace App\Controller;

use App\Event\UserListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/{_locale}/users', name: 'app_users', requirements:['_locale'=>'en|fr'])]
    public function index(): Response
    {
        $dispatcher = new EventDispatcher();
        $listener = new UserListener();
        $dispatcher->addListener('user.created', [$listener, 'onFooAction']);
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
}

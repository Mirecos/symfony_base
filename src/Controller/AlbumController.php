<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumFormType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{

    #[Route('/album', name: 'app_album')]
    public function index(AlbumRepository $albumRepository): Response
    {
        $albums = $albumRepository->findAll();

        return $this->render('album/index.html.twig', [
            'controller_name' => 'AlbumController',
            'albums' => $albums
        ]);
    }

    #[Route('/album/creation', name: 'app_album_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumFormType::class, $album);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($album);
            $em->flush();
    
            $this->addFlash('success', 'Album créé!');
            return $this->redirectToRoute('app_album');
        }
    
        return $this->render('album/ajout_album.html.twig', [
            'album' => $album,
            'form' => $form->createView()
        ]);
    }
}

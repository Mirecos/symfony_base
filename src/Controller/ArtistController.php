<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistFormType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();

        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
            'artists' => $artists
        ]);
    }

    #[Route('/artist/creation', name: 'app_artist_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistFormType::class, $artist);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($artist);
            $em->flush();
    
            $this->addFlash('success', 'Artist créé!');
            return $this->redirectToRoute('app_artist');
        }
    
        return $this->render('artist/ajout_artist.html.twig', [
            'artist' => $artist,
            'form' => $form->createView()
        ]);
    }
}

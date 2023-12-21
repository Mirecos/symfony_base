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
    private AlbumRepository $albumRepository;
    public function __construct(AlbumRepository $albumRepository){
        $this->albumRepository=$albumRepository;
    }
    #[Route('/{_locale}/album/like/{id}', name: 'app_like', methods: ['GET'], requirements:['_locale'=>'en|fr'])]
    public function __invoke(string $_locale, string $id): Response
    {
        $user = $this->getUser();
        $album = $this->albumRepository->findBy(array('id' => $id))[0];
        
        $this->albumRepository->persist($album, $user);

        return $this->redirectToRoute('app_album');
    }

    #[Route('/{_locale}/album', name: 'app_album', requirements:['_locale'=>'en|fr'])]
    public function index(AlbumRepository $albumRepository): Response
    {
        $albums = $albumRepository->findAll();

        return $this->render('album/index.html.twig', [
            'controller_name' => 'AlbumController',
            'albums' => $albums
        ]);
    }

    #[Route('/{_locale}/album/creation', name: 'app_album_creation', methods: ['GET', 'POST'], requirements:['_locale'=>'en|fr'])]
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

<?php

namespace App\Controller;

use App\Enum\AlbumStatus;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/{_locale}/home', name: 'app_home', requirements:['_locale'=>'en|fr'])]
    public function index(AlbumRepository $albumRepository): Response
    {

        $AvailableCount = 0;
        $NotAvailableCount = 0;
        $IncomingCount = 0;
        $totalCount = 0;
        $albums = $albumRepository->findAll();
        

        foreach($albums as $key=>$album){
            $totalCount++;
            if($album->getStatus() == AlbumStatus::Available)$AvailableCount++;
            else if($album->getStatus() == AlbumStatus::NotAvailable)$NotAvailableCount++;
            else if($album->getStatus() == AlbumStatus::Incoming)$IncomingCount++;
        }

        $lastAlbums = array_splice($albums,count($albums)-5);

        return $this->render('home/index.html.twig', [
            'availableCount' =>$AvailableCount,
            'notAvailableCount' =>$NotAvailableCount,
            'incomingCount' => $IncomingCount,
            'controller_name' => 'HomeController',
            'lastAlbums' => $lastAlbums,
            'totalCount' => $totalCount
        ]);
    }
}

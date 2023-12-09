<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use APP\Entity\Artist;

class ArtistFixtures extends Fixture
{

    public const ARTIST_REFERENCE = 'artist_';

    public function load(ObjectManager $manager): void
    {
        $Artists = [
            ['XXXTentacion', ["?", "Look_at_me"] ],
            ['Lil baguette', [] ],
            ['Hooba Booba', ["GLAIVE"] ]
        ];
        foreach ($Artists as $key => $artistdata) {
            $artist = new Artist();
            $artist->setName($artistdata[0]);
            // foreach ( $artistdata[1] as $key => $albumName){
            //     $artist->addAlbum($this->getReference(AlbumFixtures::ALBUM_REFERENCE . $albumName));
            // }
            $manager->persist($artist);
            $ref = self::ARTIST_REFERENCE . $artistdata[0];
            $this->addReference($ref, $artist);
        }

        $manager->flush();
    }
}

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
            'XXXTentafion',
            'Freeze porcelaine',
            'Lil baguette',
            'Hooba Booba'
        ];
        foreach ($Artists as $key => $artistName) {
            $artist = new Artist();
            $artist->setName($artistName);
            $manager->persist($artist);
            $ref = self::ARTIST_REFERENCE . $artistName;
            $this->addReference($ref, $artist);
        }

        $manager->flush();
    }
}

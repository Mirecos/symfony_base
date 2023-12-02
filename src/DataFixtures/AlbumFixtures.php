<?php

namespace App\DataFixtures;

use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture
{

    public const ALBUM_REFERENCE = 'album_';

    public function load(ObjectManager $manager): void
    {
        $Albums = [
            "Look_at_me",
            "?",
            "GLAIVE"
        ];
        foreach ($Albums as $key => $albumName) {
            $album = new Album();
            $album->setName($albumName);
            $manager->persist($album);
            $ref = self::ALBUM_REFERENCE . $albumName;
            $this->addReference($ref, $album);
        }

        $manager->flush();
    }
}

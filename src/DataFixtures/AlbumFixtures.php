<?php

namespace App\DataFixtures;

use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture implements DependentFixtureInterface
{

    public const ALBUM_REFERENCE = 'album_';

    public function getDependencies() {
        return [
            StyleFixtures::class,
            ArtistFixtures::class,
            FanFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $Albums = [
            ["Look at me", "Rock"],
            ["?", "Rap"],
            ["GLAIVE", "Rap"],
        ];
        foreach ($Albums as $key => $albumData) {
            $album = new Album();
            $album->setName($albumData[0]);
            $album->setStyle( $this->getReference(StyleFixtures::STYLE_REFERENCE . $albumData[1]) );
            $manager->persist($album);

            $ref = self::ALBUM_REFERENCE . $albumData[0];
            $this->addReference($ref, $album);
        }

        $manager->flush();
    }
}

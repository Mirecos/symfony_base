<?php

namespace App\DataFixtures;

use AlbumStatus;
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
            ["Look at me", "Rock", "XXXTentafion" ,["JP-47"], AlbumStatus::Available],
            ["?", "Rap", "XXXTentafion" ,["Inspecteur gaydget"], AlbumStatus::Incoming],
            ["GLAIVE", "Rap", "Hooba Booba", [], AlbumStatus::Available],
        ];
        foreach ($Albums as $key => $albumData) {
            $album = new Album();
            $album->setName($albumData[0]);
            $album->setStyle( $this->getReference(StyleFixtures::STYLE_REFERENCE . $albumData[1]) );
            $album->setArtist( $this->getReference(ArtistFixtures::ARTIST_REFERENCE . $albumData[2]) );
            $album->setStatus( $albumData[4] );
            foreach($albumData[3] as $key => $user){
                $album->addFan( $this->getReference(FanFixtures::FAN_REFERENCE . $user));
            }
            $manager->persist($album);

            $ref = self::ALBUM_REFERENCE . $albumData[0];
            $this->addReference($ref, $album);
        }

        $manager->flush();
    }
}

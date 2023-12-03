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
            ["Look at me", "Rock", "XXXTentafion" ,["JP-47"], AlbumStatus::Available, "https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg"],
            ["?", "Rap", "XXXTentafion" ,["Inspecteur gaydget"], AlbumStatus::Incoming, "https://e-cdn-images.dzcdn.net/images/cover/9b6da786cd3ca8b286a04186b3c9079c/500x500-000000-80-0-0.jpg"],
            ["GLAIVE", "Rap", "Hooba Booba", [], AlbumStatus::Available, "https://e-cdn-images.dzcdn.net/images/cover/5ae761b7a0c5b89910dc8c320265de7b/500x500-000000-80-0-0.jpg"],
            ["Look at me2", "Rock", "XXXTentafion" ,["JP-47"], AlbumStatus::Available, "https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg"],

            ["Look at me3", "Rock", "XXXTentafion" ,["JP-47"], AlbumStatus::Available, "https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg"],

            ["Look at me4", "Rock", "XXXTentafion" ,["JP-47"], AlbumStatus::Available, "https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg"],

            ["Look at me5", "Rock", "XXXTentafion" ,["JP-47"], AlbumStatus::Available, "https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg"],

        ];

        foreach ($Albums as $key => $albumData) {
            $album = new Album();
            $album->setName($albumData[0]);
            $album->setStyle( $this->getReference(StyleFixtures::STYLE_REFERENCE . $albumData[1]) );
            $album->setArtist( $this->getReference(ArtistFixtures::ARTIST_REFERENCE . $albumData[2]) );
            $album->setStatus( $albumData[4] );
            $album->setImage($albumData[5]);
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

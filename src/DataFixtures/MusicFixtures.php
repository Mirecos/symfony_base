<?php

namespace App\DataFixtures;

use App\Entity\Music;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MusicFixtures extends Fixture implements DependentFixtureInterface
{

    public const MUSIC_REFERENCE = 'music_';

    public function getDependencies()
    {
        return [
            ArtistFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {
        $musics = [
            ["Look at me!", "XXXTentafion", "Look_at_me"],
            ["Moonlight", "XXXTentafion", "?"],
            ["Arc-en-ciel", 'Hooba Booba', "GLAIVE"],
            ["GLAIVE", 'Hooba Booba', "GLAIVE"]
        ];
        foreach ($musics as $key => $musicData) {
            $music = new Music();
            $music->setTitle($musicData[0]);
            $music->setArtist( $this->getReference(ArtistFixtures::ARTIST_REFERENCE . $musicData[1]) );
            $music->setAlbum( $this->getReference(AlbumFixtures::ALBUM_REFERENCE . $musicData[2]) );
            $manager->persist($music);
            $ref = self::MUSIC_REFERENCE . $musicData[0];
            $this->addReference($ref, $music);
        }

        $manager->flush();
    }
}

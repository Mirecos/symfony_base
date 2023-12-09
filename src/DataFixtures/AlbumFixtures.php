<?php

namespace App\DataFixtures;


use App\Entity\Album;
use App\Enum\AlbumStatus;
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
            FanFixtures::class,
            CoverFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $Albums = [
            ["Look at me", "Rock", "XXXTentacion" ,["JP-47"], AlbumStatus::NotAvailable],
            ["?", "Rap", "XXXTentacion" ,["Inspecteur gaydget"], AlbumStatus::Available],
            ["Riot", "Rap", "XXXTentacion", [], AlbumStatus::Available],
            ["Bad Vibes Forever", "Pop", "XXXTentacion" ,["JP-47"], AlbumStatus::Available],
            ["SKINS", "Rap", "XXXTentacion" ,["JP-47"], AlbumStatus::Incoming],
            ["Revenge", "Rock", "XXXTentacion" ,["JP-47"], AlbumStatus::Available],
            ["17", "Rap", "XXXTentacion" ,["JP-47"], AlbumStatus::Incoming],

        ];

        foreach ($Albums as $key => $albumData) {
            $album = new Album();
            $album->setName($albumData[0]);
            $album->setStyle( $this->getReference(StyleFixtures::STYLE_REFERENCE . $albumData[1]) );
            $album->setArtist( $this->getReference(ArtistFixtures::ARTIST_REFERENCE . $albumData[2]) );
            $album->setStatus($albumData[4]);
            $album->setStatus( $albumData[4] );
            $album->setCover( $this->getReference(CoverFixtures::COVER_REFERENCE . $albumData[0]) );
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

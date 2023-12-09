<?php

namespace App\DataFixtures;

use App\Entity\Cover;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoverFixtures extends Fixture
{

    public const COVER_REFERENCE = 'cover_';

    public function load(ObjectManager $manager): void
    {
        $Covers = [
            ['https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg','Look at me'],
            ['https://e-cdn-images.dzcdn.net/images/cover/9b6da786cd3ca8b286a04186b3c9079c/500x500-000000-80-0-0.jpg','?'],
            ['https://e-cdn-images.dzcdn.net/images/cover/cec40f144f8dda85a284559d1d052b30/500x500-000000-80-0-0.jpg','Bad Vibes Forever'],
            ['https://e-cdn-images.dzcdn.net/images/cover/31826748d576ae33bc22632f7a95ac4f/500x500-000000-80-0-0.jpg','SKINS'],
            ['https://e-cdn-images.dzcdn.net/images/cover/177766506572208a91b1d69a49149384/500x500-000000-80-0-0.jpg','Revenge'],
            ['https://e-cdn-images.dzcdn.net/images/cover/406f99fbbb8f44475d4507e373e46f5c/500x500-000000-80-0-0.jpg','17'],
            ['https://e-cdn-images.dzcdn.net/images/cover/3450201b761178db651b7b8e2df820e6/500x500-000000-80-0-0.jpg','Riot']
        ];
        foreach ($Covers as $key => $coverData) {
            $cover = new Cover();
            $cover->setLink($coverData[0]);
            $cover->setAlbumName($coverData[1]);
            $manager->persist($cover);
            $ref = self::COVER_REFERENCE . $coverData[1];
            $this->addReference($ref, $cover);
        };

        $manager->flush();
    }
}

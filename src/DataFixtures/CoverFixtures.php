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
            ['https://e-cdn-images.dzcdn.net/images/cover/5ae761b7a0c5b89910dc8c320265de7b/500x500-000000-80-0-0.jpg','GLAIVE'],
            ['https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg','Look at me2'],
            ['https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg','Look at me3'],
            ['https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg','Look at me4'],
            ['https://e-cdn-images.dzcdn.net/images/cover/52b1deb1b8200691f68bb5faf84c6f31/500x500-000000-80-0-0.jpg','Look at me5']
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

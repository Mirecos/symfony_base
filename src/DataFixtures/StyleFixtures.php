<?php

namespace App\DataFixtures;

use App\Entity\Style;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StyleFixtures extends Fixture
{

    public const STYLE_REFERENCE = 'style_';

    public function load(ObjectManager $manager): void
    {
        $Styles = [
            'Pop',
            'Rap',
            'Electro',
            'Hard bass',
            'Rock'
        ];
        foreach ($Styles as $key => $styleName) {
            $style = new Style();
            $style->setName($styleName);
            $manager->persist($style);
            $ref = self::STYLE_REFERENCE . $styleName;
            $this->addReference($ref, $style);
        }

        $manager->flush();
    }
}

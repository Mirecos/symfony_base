<?php

namespace App\DataFixtures;

use App\Entity\Fan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FanFixtures extends Fixture
{

    public const FAN_REFERENCE = 'fan_';
    
    public function load(ObjectManager $manager): void
    {
        $Fans = [
            'JP-47',
            'Aladesh',
            'Inspecteur gaydget',
            'Michael jackson'
        ];
        foreach ($Fans as $key => $fanName) {
            $fan = new Fan();
            $fan->setUsername($fanName);
            $manager->persist($fan);
            $ref = self::FAN_REFERENCE . $fanName;
            $this->addReference($ref, $fan);
        }

        $manager->flush();
    }
}

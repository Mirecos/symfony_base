<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{

    public const USER_REFERENCE = 'user_';

    public function load(ObjectManager $manager): void
    {
        $Users = [
            ["admin@gmail.com", '$2y$13$z7ij./rHFIzOVHJL71i3tu0GIrGq5NZNp8txzHaEp/vOtPWdUnO6y', ["ROLE_ADMIN"]],
            ["user@gmail.com", '$2y$13$z7ij./rHFIzOVHJL71i3tu0GIrGq5NZNp8txzHaEp/vOtPWdUnO6y', []]
        ];
        foreach ($Users as $key => $userCredentials) {
            $user = new User();
            $user->setEmail($userCredentials[0]);
            $user->setPassword($userCredentials[1]);
            $user->setRoles($userCredentials[2]);
            $user->setIsSend(true);
            $manager->persist($user);
            $ref = self::USER_REFERENCE . $userCredentials[0];
            $this->addReference($ref, $user);
        }

        $manager->flush();
    }
}

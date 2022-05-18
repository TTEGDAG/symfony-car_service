<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function hashPassword(string $plainPassword): string
    {
        return $this->encoder->encodePassword(new User(), $plainPassword);
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail('admin@carservice.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test123'));

        $manager->persist($user);

        $user2 = new User();
        $user2->setRoles(['ROLE_USER']);
        $user2->setEmail('user@carservice.com');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'test123'));

        $manager->persist($user2);
        $manager->flush();
    }
}

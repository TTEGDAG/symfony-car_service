<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
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

<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $customer = new Customer();
        $customer->setRoles(['ROLE_USER', 'ROLE_CUSTOMER']);
        $customer->setEmail('customer@carservice.com');
        $customer->setPassword($this->passwordEncoder->encodePassword($customer, 'test123'));
        $customer->setFirstName('Joanna');
        $customer->setLastName('Krawiec');

        $manager->persist($customer);

        $manager->flush();
    }
}

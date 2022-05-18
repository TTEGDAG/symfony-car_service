<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmployeeFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $employee = new Employee();
        $employee->setRoles(['ROLE_USER', 'ROLE_EMPLOYEE']);
        $employee->setEmail('employee@carservice.com');
        $employee->setPassword($this->passwordEncoder->encodePassword($employee, 'test123'));
        $employee->setFirstName('Jan');
        $employee->setLastName('Kowalski');
        $employee->setJobTitle('manager');
        $manager->persist($employee);

        $manager->flush();
    }
}

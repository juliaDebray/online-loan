<?php

namespace App\DataFixtures;

use App\Entity\Customers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 3; $i++) {
            $customer = new Customers();
            $customer->setFirstname('Jonh' . $i);
            $customer->setLastname('Doe' . $i);
            $customer->setBirthdate(new \DateTime());
            $customer->setEmail('customer' . $i . '@mail.fr');
            $customer->setRoles(['ROLE_CUSTOMER']);
            $customer->setPassword('test');
            $customer->setStatus('pending');
            $customer->setAddress('120 rue des Lila');
            $customer->setZipcode('44200');
            $customer->setCity('NANTES');

            $manager->persist($customer);
        }
        $manager->flush();
    }
}

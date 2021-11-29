<?php

namespace App\Tests\Entity;

use App\Entity\Customers;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UsersTest extends KernelTestCase
{
    public function getCustomer(): Customers
    {
        return $customer = (new Customers())
            ->setFirstname('Jonh')
            ->setLastname('Doe')
            ->setBirthdate(new \DateTime())
            ->setAddress('120 rue des Lila')
            ->setZipcode('44200')
            ->setCity('NANTES')
            ->setEmail('customer@mail.fr')
            ->setRoles(['ROLE_CUSTOMER'])
            ->setPassword('Pa$$w0rd')
            ->setStatus('pending');
    }

    public function assertHasError(Customers $customer, int $errorNumber = 0)
    {
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($customer);
        $this->assertCount($errorNumber, $error);
    }

    public function testValidEntity()
    {
        $customer = $this->getCustomer();
        $this->assertHasError($customer);

    }

    public function testBlankCustomer()
    {
        $customer = $this->getCustomer()
            ->setFirstname('')
            ->setLastname('')
            ->setStatus('')
            ->setPassword('')
            ->setRoles('')
            ->setAddress('')
            ->setCity('')
            ->setZipcode('')
            ->setEmail('');
        $this->assertHasError($customer,7);
    }

    public function testPassword()
    {
        $this->assertHasError($this->getCustomer()->setPassword(1234),1);
        $this->assertHasError($this->getCustomer()->setPassword('azert'),1);
        $this->assertHasError($this->getCustomer()->setPassword('azerty'),1);
        $this->assertHasError($this->getCustomer()->setPassword('azerty123'),1);
        $this->assertHasError($this->getCustomer()->setPassword('azerty123@'),1);
        $this->assertHasError($this->getCustomer()->setPassword('Azerty123@'));
    }

}




<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomersControllerTest extends WebTestCase
{
    public function testValidateCustomers()
    {
        $client = static::createClient();
        $client->request('GET','/customers/validation');
        $this->assertResponseRedirects('/login');
    }
}
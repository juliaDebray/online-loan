<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationsControllerTest extends WebTestCase
{
    public function testLoaningCustomers()
    {
        $client = static::createClient();
        $client->request('GET','/reservations/show_user_loanings');
        $this->assertResponseRedirects('/login');
    }

    public function testLoaningEmployees()
    {
        $client = static::createClient();
        $client->request('GET','/reservations/show_loanings');
        $this->assertResponseRedirects('/login');
    }
}
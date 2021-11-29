<?php

namespace App\Tests\Repository;

use App\DataFixtures\BookssFixtures;
use App\DataFixtures\CustomersFixtures;
use App\Repository\CustomersRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class CustomerRepositoryTest extends KernelTestCase
{
    /** @var AbstractDatabaseTool */
    protected AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testCount()
    {
        self::bootKernel();
        $this->databaseTool->loadFixtures([CustomersFixtures::class]);
        $customer = self::getContainer()->get(CustomersRepository::class)->count([]);
        $this->assertEquals(3, $customer);
    }
}



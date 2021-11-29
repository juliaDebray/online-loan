<?php

namespace App\Tests\Entity;

use App\Entity\Books;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BooksTest extends KernelTestCase
{
    public function getEntity(): Books
    {
        return (new Books())
            ->setAuthor('Julia Debray')
            ->setLiteraryGenre('Polar')
            ->setReleaseDate(new \DateTime())
            ->setTitle('Mon nouveau livre')
            ->setDescription('ma description')
            ->setImage(null);
    }

    public function assertHasError(Books $book, int $errorNumber = 0) {
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($book);
        $this->assertCount($errorNumber, $error);
    }
    public function testValidEntity()
    {
        $book = $this->getEntity();
        $this->assertHasError($book);

    }

    public function testInvalidAuthor()
    {
        $book = $this->getEntity()
            ->setAuthor(1234)
            ->setTitle(1234)
            ->setLiteraryGenre(1234)
            ->setImage(1234)
            ->setDescription(1234);
        $this->assertHasError($book, 5);
    }

    public function testBlankBooks()
    {
        $book = $this->getEntity()
            ->setAuthor('')
            ->setTitle('')
            ->setDescription('')
            ->setImage('')
            ->setLiteraryGenre('');
        $this->assertHasError($book,4);
    }
}
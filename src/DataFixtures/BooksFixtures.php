<?php

namespace App\DataFixtures;

use App\Entity\Books;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BooksFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 3; $i++) {
            $book = new Books;
            $book->setTitle('Livre n° ' . $i);
            $book->setDescription('Ceci est le livre numéro ' . $i);
            $book ->setAuthor('Julia Debray');
            $book ->setLiteraryGenre('Polar');
            $book->setReleaseDate(new \DateTime());

            $manager->persist($book);
        }
        $manager->flush();
    }
}

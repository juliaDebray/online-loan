<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Books|null find($id, $lockMode = null, $lockVersion = null)
 * @method Books|null findOneBy(array $criteria, array $orderBy = null)
 * @method Books[]    findAll()
 * @method Books[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Books::class);
    }

     /**
      * @return Books[] Returns an array of Books objects
      */
    public function likeBy($title, $type): array
    {
        $query = $this->createQueryBuilder('b');

        if (isset($title) && !empty($title)) {
            $query
                ->andWhere('b.title LIKE :title')
                ->setParameter('title', '%'.$title.'%');
        }

        if (isset($type) && !empty($type)) {
            $query
                ->andWhere('b.literaryGenre = :type')
                ->setParameter('type', $type);
        }

        return $query
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

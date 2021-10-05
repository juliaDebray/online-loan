<?php

namespace App\Entity;

use App\Repository\AdministratorsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\User;

/**
 * @ORM\Entity(repositoryClass=AdministratorsRepository::class)
 */
final class Administrators extends Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
}

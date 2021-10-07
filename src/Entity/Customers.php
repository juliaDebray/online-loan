<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CustomersRepository::class)
 */
class Customers extends Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Seule les lettres sont acceptées")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum. Essayez de renomer votre fichier")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Seule les lettres sont acceptées")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum. Essayez de renomer votre fichier")
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Ce champs est recquis")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum. Essayez de renomer votre fichier")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum. Essayez de renomer votre fichier")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Seule les lettres sont acceptées")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum. Essayez de renomer votre fichier")
     */
    private $city;

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
}

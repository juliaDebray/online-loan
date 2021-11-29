<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 */
class Books
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
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Les chiffres ne sont pas acceptés.")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Les chiffres ne sont pas acceptés.")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     "/\D/",
     *     message="Les chiffres ne sont pas acceptés.")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum. Essayez de renomer votre fichier")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Les chiffres ne sont pas acceptés.")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Regex(
     *     "/\D/",
     *     message="Les chiffres ne sont pas acceptés.")
     * @Assert\Length(
     *     charset="UTF-8",
     *     max="255",
     *     maxMessage="255 caractères maximum")
     */
    private $literaryGenre;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Ce champs est recquis")
     * @Assert\Type("\DateTimeInterface")
     */
    private $releaseDate;

    /**
     * @ORM\OneToOne(targetEntity=Reservations::class, mappedBy="book", cascade={"persist", "remove"})
     */
    private $reservation;

    public function __toString(): string
    {
        if($this->getReservation()) {
            return $this->getTitle() . ': ' . $this->getReservation()->getStatus();
        }
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLiteraryGenre(): ?string
    {
        return $this->literaryGenre;
    }

    public function setLiteraryGenre(string $literaryGenre): self
    {
        $this->literaryGenre = $literaryGenre;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getReservation(): ?Reservations
    {
        return $this->reservation;
    }

    public function setReservation(Reservations $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getBook() !== $this) {
            $reservation->setBook($this);
        }

        $this->reservation = $reservation;

        return $this;
    }
}

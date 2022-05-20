<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[
        ORM\Id,
        ORM\Column(type: 'uuid', unique: true)
    ]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reviews')]
    public User $author;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'reviews')]
    public Book $book;

    #[ORM\Column(type: 'integer', nullable: true)]
    public int $note;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public string $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public string $body;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }
}

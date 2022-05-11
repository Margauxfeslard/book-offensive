<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Uuid;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[
        ORM\Id,
        ORM\Column(type: 'uuid', unique: true)
    ]
    private Uuid $id;

    #[ORM\Column()]
    public string $isbn;

    #[ORM\Column()]
    public string $title;

    #[ORM\Column(nullable: true)]
    public string $writerFirstname;

    #[ORM\Column()]
    public string $writerLastname;

    #[ORM\Column()]
    public string $category;

    #[ORM\Column(nullable: true)]
    public string $publisher;

    #[ORM\Column(nullable: true)]
    public string $language;

    #[ORM\Column(type: 'text')]
    public string $summary;

    #[ORM\OneToMany(mappedBy: 'physicalBook', targetEntity: Borrow::class)]
    public Collection $borrows;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: PhysicalBook::class, orphanRemoval: true)]
    public Collection $physicalBooks;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    public Collection $reviews;

    public function __construct()
    {
        $this->physicalBooks = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->borrows = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}

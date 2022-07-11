<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[
        ORM\Column(),
        Assert\NotNull
    ]
    public string $isbn;

    #[
        ORM\Column(),
        Assert\NotNull
    ]
    public string $title;

    #[ORM\Column(nullable: true)]
    public ?string $writerFirstname = null;

    #[ORM\Column(nullable: true)]
    public ?string $writerLastname = null;

    #[ORM\Column(nullable: true)]
    public ?string $publisher = null;

    #[ORM\Column(nullable: true)]
    public ?string $language = null;

    #[
        ORM\Column(type: 'text'),
        Assert\NotNull
    ]
    public string $summary;

    #[ORM\OneToMany(mappedBy: 'physicalBook', targetEntity: Borrow::class)]
    public Collection $borrows;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: PhysicalBook::class)]
    public Collection $physicalBooks;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    public Collection $reviews;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'books')]
    public Collection $categories;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->physicalBooks = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->borrows = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}

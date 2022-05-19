<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

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

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: PhysicalBook::class)]
    public Collection $physicalBooks;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    public Collection $reviews;

    public function __construct()
    {
        $this->physicalBooks = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->borrows = new ArrayCollection();
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
 
    public function getWriterFirstname(): string
    {
        return $this->writerFirstname;
    }

    public function setWriterFirstname(string $writerFirstname)
    {
        $this->writerFirstname = $writerFirstname;
    }

    public function getWriterLastname(): string
    {
        return $this->writerLastname;
    }

    public function setWriterLastname(string $writerLastname)
    {
        $this->writerLastname = $writerLastname;
    }
 
    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher)
    {
        $this->publisher = $publisher;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary)
    {
        $this->summary = $summary;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language)
    {
        $this->language = $language;
    }
}

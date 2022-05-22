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
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column()]
    public string $isbn;

    #[ORM\Column()]
    public string $title;

    #[ORM\Column(nullable: true)]
    public string $writerFirstname;

    #[ORM\Column()]
    public string $writerLastname;

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

    public function getWriterFirstname(): string
    {
        return $this->writerFirstname;
    }

    public function setWriterFirstname(string $writerFirstname): void
    {
        $this->writerFirstname = $writerFirstname;
    }

    public function getWriterLastname(): string
    {
        return $this->writerLastname;
    }

    public function setWriterLastname(string $writerLastname): void
    {
        $this->writerLastname = $writerLastname;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }
    }

    public function removeCategory(Category $category): void
    {
        $this->categories->removeElement($category);
    }
}

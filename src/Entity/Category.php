<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[
        ORM\Id,
        ORM\Column(type: 'uuid', unique: true, nullable: false)
    ]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    public $name;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'categories')]
    public Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book)
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addCategory($this);
        }
    }

    public function removeBook(Book $book)
    {
        if ($this->books->removeElement($book)) {
            $book->removeCategory($this);
        }
    }
}

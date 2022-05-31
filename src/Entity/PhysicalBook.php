<?php

namespace App\Entity;

use App\Repository\PhysicalBookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: PhysicalBookRepository::class)]
class PhysicalBook
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'physicalBooks')]
    public Book $book;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'booksOwned')]
    public User $owner;

    #[ORM\OneToMany(mappedBy: 'physicalBook', targetEntity: Borrow::class)]
    public Collection $borrows;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->borrows = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }
}

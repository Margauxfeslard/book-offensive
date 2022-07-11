<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[
        ORM\Column(),
        Assert\NotNull
    ]
    public string $name;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'categories')]
    public Collection $books;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->books = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}

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

    

    /**
     * Get the value of writerFirstname
     */ 
    public function getWriterFirstname()
    {
        return $this->writerFirstname;
    }

    /**
     * Set the value of writerFirstname
     *
     * @return  self
     */ 
    public function setWriterFirstname($writerFirstname)
    {
        $this->writerFirstname = $writerFirstname;

        return $this;
    }

    /**
     * Get the value of writerLastname
     */ 
    public function getWriterLastname()
    {
        return $this->writerLastname;
    }

    /**
     * Set the value of writerLastname
     *
     * @return  self
     */ 
    public function setWriterLastname($writerLastname)
    {
        $this->writerLastname = $writerLastname;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of publisher
     */ 
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set the value of publisher
     *
     * @return  self
     */ 
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get the value of summary
     */ 
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @return  self
     */ 
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get the value of language
     */ 
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @return  self
     */ 
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }
}

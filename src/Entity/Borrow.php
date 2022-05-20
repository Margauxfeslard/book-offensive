<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: BorrowRepository::class)]
class Borrow
{
    #[
        ORM\Id,
        ORM\Column(type: 'uuid', unique: true)
    ]
    private Uuid $id;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    public \DateTimeImmutable $provisionalEndDate;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    public \DateTimeImmutable $startDate;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    public \DateTimeImmutable $restitutionDate;

    #[ORM\ManyToOne(targetEntity: PhysicalBook::class, inversedBy: 'borrows')]
    public PhysicalBook $physicalBook;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'booksBorrow')]
    public User $borrower;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }
}

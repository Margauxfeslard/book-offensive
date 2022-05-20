<?php

namespace App\Repository;

use App\Entity\PhysicalBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhysicalBook>
 *
 * @method PhysicalBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicalBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicalBook[]    findAll()
 * @method PhysicalBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicalBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhysicalBook::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PhysicalBook $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PhysicalBook $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

}

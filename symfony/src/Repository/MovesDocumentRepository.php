<?php

namespace App\Repository;

use App\Entity\MovesDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovesDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovesDocument::class);
    }

    public function findAllScores(): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.status = :val')
            ->setParameter('score', "win")
            ->getQuery()
            ->getResult();
    }

    public function add(MovesDocument $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
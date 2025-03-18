<?php

namespace App\Repository;

use App\Entity\MatchDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MatchDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchDocument::class);
    }

    public function add(MatchDocument $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllRunning(): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.status = :val')
            ->setParameter('val', "runing")
            ->getQuery()
            ->getResult();
    }

    public function findByUuid(string $value): ?MatchDocument
    {
        return $this->createQueryBuilder('t')
            ->where('t.uuid = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

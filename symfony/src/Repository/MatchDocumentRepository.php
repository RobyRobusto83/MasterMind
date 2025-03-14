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

//    public function remove(Task $entity, bool $flush = false): void
//    {
//        $this->getEntityManager()->remove($entity);
//
//        if ($flush) {
//            $this->getEntityManager()->flush();
//        }
//    }
//
//    public function findByIdProject(int $value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->where('t.isDeleted = 0')
//            ->andWhere('t.idProject = :val')
//            ->setParameter('val', $value)
//            //    ->orderBy('t.id', 'ASC')
//            //    ->setMaxResults(10)
//            ->getQuery()
//            ->getResult();
//    }

    public function findByUuid(string $value): ?MatchDocument
    {
        return $this->createQueryBuilder('t')
            ->where('t.uuid = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

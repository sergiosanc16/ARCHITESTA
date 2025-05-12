<?php

namespace App\Repository;

use App\Entity\TestaTvalidacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestaTvalidacion>
 */
class TestaTvalidacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestaTvalidacion::class);
    }

   public function findByIdtestamento(int $idTestamento): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id_testamento = :idTestamento')
            ->setParameter('idTestamento', $idTestamento)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }        

}

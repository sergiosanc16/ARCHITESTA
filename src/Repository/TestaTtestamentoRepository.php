<?php

namespace App\Repository;

use App\Entity\TestaTtestamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestaTtestamento>
 */
class TestaTtestamentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestaTtestamento::class);
    }

    //    /**
    //     * @return TestaTtestamento[] Returns an array of TestaTtestamento objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TestaTtestamento
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

        public function findTestaImagen($id_imagen): array
        {
            return $this->createQueryBuilder('t')
                ->andWhere('t.imagen = :val')
                ->setParameter('val', $id_imagen)
                ->getQuery()
                ->getResult()
            ;
        }
        // número de testamentos con una imagen
        public function countTestaImagen($id_imagen): int
        {
            return (int) $this->createQueryBuilder('t')
                ->select('COUNT(t.id)')  // O el campo ID o el que sea tu clave primaria
                ->andWhere('t.imagen = :val')
                ->setParameter('val', $id_imagen)
                ->getQuery()
                ->getSingleScalarResult();
        }

        public function findTestaNotario($id_notario): array
        {
            return $this->createQueryBuilder('t')
                ->andWhere('t.notario = :val')
                ->setParameter('val', $id_notario)
                ->getQuery()
                ->getResult()
            ;
        }
}

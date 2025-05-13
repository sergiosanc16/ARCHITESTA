<?php

namespace App\Repository;

use App\Entity\TestaVtestaotorgante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestaVtestaotorgante>
 *
 * @method TestaVtestaotorgante|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestaVtestaotorgante|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestaVtestaotorgante[]    findAll()
 * @method TestaVtestaotorgante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestaVtestaotorganteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestaVtestaotorgante::class);
    }

    public function findByIdOtorgante(int $idOtorgante): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.idOtorgante = :idOtorgante')
            ->setParameter('idOtorgante', $idOtorgante)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

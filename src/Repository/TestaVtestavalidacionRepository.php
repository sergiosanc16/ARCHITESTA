<?php 
namespace App\Repository;

use App\Entity\TestaVtestavalidacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TestaVtestavalidacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestaVtestavalidacion::class);
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

        public function findTestaNotario($id_notario): array
        {
            return $this->createQueryBuilder('t')
                ->andWhere('t.notario = :val')
                ->setParameter('val', $id_notario)
                ->getQuery()
                ->getResult()
            ;
        }   
        
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
        // query para peticion ajax
        public function findAjax(int $ini, int $lar): array
        {
            return $this->createQueryBuilder('t')
                ->select('t')  
                ->setFirstResult($ini)
                ->setMaxResults($lar)
                ->getQuery()
                ->getResult();
        }

        public function countTotal(): int
        {
            return (int) $this->createQueryBuilder('t')
                ->select('COUNT(t)')
                ->getQuery()
                ->getSingleScalarResult();
        }
}

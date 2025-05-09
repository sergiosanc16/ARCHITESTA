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

    // Aquí puedes añadir métodos personalizados de consulta
}

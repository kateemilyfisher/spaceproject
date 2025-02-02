<?php

namespace App\Repository;

use App\Entity\Position;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Position::class);
    }


    public function findByLatitudeAndLongitude($latitude)
    {
        return $this->findby([]);
    }


    // public function findOneBySomeField(): ?Position
    // {
    //     $latitude = '';
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.latitude = :val')
    //         ->setParameter('val', $latitude)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }

}

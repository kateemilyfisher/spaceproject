<?php

namespace App\Repository;

use App\Entity\SpaceStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpaceStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceStation[]    findAll()
 * @method SpaceStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceStation::class);
    }

    /**
    * @return SpaceStation[] Returns an array of SpaceStation objects
    */

    public function findByCraft($craft)
    {
        return $this->findBy(array("name" => $craft));
    }

}

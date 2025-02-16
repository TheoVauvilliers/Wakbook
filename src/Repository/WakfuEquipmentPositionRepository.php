<?php

namespace App\Repository;

use App\Entity\WakfuEquipmentPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WakfuEquipmentPosition>
 */
class WakfuEquipmentPositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WakfuEquipmentPosition::class);
    }
}

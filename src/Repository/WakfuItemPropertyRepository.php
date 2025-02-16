<?php

namespace App\Repository;

use App\Entity\WakfuItemProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WakfuItemProperty>
 */
class WakfuItemPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WakfuItemProperty::class);
    }
}

<?php

namespace App\Repository;

use App\Entity\Sejour;
use App\Form\Data\HomeSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Stopwatch\Stopwatch;

class SejourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sejour::class);
    }

    public function homeSearch(HomeSearchData $searchData)
    {
        $queryBuilder = $this->createQueryBuilder('sejour');

        if (\is_null($searchData->getStartDate()) === false) {
            $queryBuilder
                ->andWhere('sejour.endDate > :dateStart')
                ->setParameter('dateStart', $searchData->getStartDate());
        }

        if (\is_null($searchData->getEndDate()) === false) {
            $queryBuilder
                ->andWhere('sejour.startDate < :endDate')
                ->setParameter('endDate', $searchData->getEndDate());
        }

        if (empty($searchData->getStatus()) === false) {
            $queryBuilder
                ->andWhere('sejour.status = :status')
                ->setParameter('status', $searchData->getStatus());
        }

        if (\is_null($searchData->getName()) === false) {
            $queryBuilder
                ->andWhere('sejour.customerLastname = :name')
                ->setParameter('name', $searchData->getName());
        }

        if (\is_null($searchData->getLocation()) === false) {
            $queryBuilder
                ->andWhere('sejour.emplacement = :location')
                ->setParameter('location', $searchData->getLocation());
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}

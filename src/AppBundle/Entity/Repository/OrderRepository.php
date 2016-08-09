<?php
// src/AppBundle/Entity/Repository/OrderRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    public function findMaxOrderId()
    {
        $query = $this->createQueryBuilder('clientOrder')
            ->select('MAX(clientOrder.orderId) AS maxOrderId')
            ->orderBy('maxOrderId', 'DESC')
            ->getQuery();

        return $query->getSingleResult()['maxOrderId'];
    }

    public function findVerifiedClientOrder($orderId, $orderCheckSum)
    {
        $query = $this->createQueryBuilder('clientOrder')
            ->select('clientOrder')
            ->where('clientOrder.orderId = :orderId')
            ->andWhere('clientOrder.orderCheckSum = :orderCheckSum')
            ->setParameters([
                'orderId' => $orderId,
                'orderCheckSum' => $orderCheckSum
            ])
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    public function findSumOfTickets()
    {
        $query = $this->createQueryBuilder('clientOrder')
            ->select('SUM(clientOrder.ticketsAmount) as ticketsSum')
            ->getQuery();

        return $query->getOneOrNullResult()['ticketsSum'];
    }
}
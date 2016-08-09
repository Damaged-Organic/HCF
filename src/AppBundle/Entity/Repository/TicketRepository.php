<?php
// src/AppBundle/Entity/Repository/TicketRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query;

class TicketRepository extends EntityRepository
{
    public function findSingleTicket()
    {
        $query = $this->createQueryBuilder('ticket')
            ->select('ticket')
            ->getQuery();

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getSingleResult();
    }
}
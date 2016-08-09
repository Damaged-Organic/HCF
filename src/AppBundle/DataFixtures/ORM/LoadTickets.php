<?php
// src/AppBundle/DataFixtures/ORM/LoadTickets.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Ticket;

class LoadTickets implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new Ticket)
            ->setEventTitle("Healthcare Creative Forum 2015")
            ->setPrice(3360.00);
        $manager->persist($object_1);

        // ---

        $manager->flush();
    }
}
<?php
// src/AppBundle/DataFixtures/ORM/LoadForumNumbers.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ForumNumber;

class LoadForumNumbers implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new ForumNumber)
            ->setIcon("icon-users")
            ->setTitle("Участников")
            ->setNumber(300);
        $manager->persist($object_1);

        // ---

        $object_2 = (new ForumNumber)
            ->setIcon("icon-connection")
            ->setTitle("Экспертов")
            ->setNumber(8);
        $manager->persist($object_2);

        // ---

        $object_3 = (new ForumNumber)
            ->setIcon("icon-origami")
            ->setTitle("Креативных секции")
            ->setNumber(4);
        $manager->persist($object_3);

        // ---

        $manager->flush();
    }
}
<?php
// src/AppBundle/DataFixtures/ORM/LoadMetadata.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Metadata;

class LoadMetadata extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $metadata_1 = (new Metadata)
            ->setRoute("index")
            ->setRobots("index, follow")
            ->setTitle("Главная")
            ->setDescription("Описание");
        $manager->persist($metadata_1);

        // ---

        $metadata_2 = (new Metadata)
            ->setRoute("programme")
            ->setRobots("index, follow")
            ->setTitle("Программа")
            ->setDescription("Описание");
        $manager->persist($metadata_2);

        // ---

        $metadata_3 = (new Metadata)
            ->setRoute("experts")
            ->setRobots("index, follow")
            ->setTitle("Эксперты")
            ->setDescription("Описание");
        $manager->persist($metadata_3);

        // ---

        $metadata_4 = (new Metadata)
            ->setRoute("cases")
            ->setRobots("index, follow")
            ->setTitle("Кейсы")
            ->setDescription("Описание");
        $manager->persist($metadata_4);

        // ---

        $metadata_5 = (new Metadata)
            ->setRoute("case")
            ->setRobots("index, follow")
            ->setTitle("Кейс")
            ->setDescription("");
        $manager->persist($metadata_5);

        // ---

        $metadata_6 = (new Metadata)
            ->setRoute("contacts")
            ->setRobots("index, follow")
            ->setTitle("Контакты")
            ->setDescription("Описание");
        $manager->persist($metadata_6);

        // ---

        $metadata_7 = (new Metadata)
            ->setRoute("tickets")
            ->setRobots("noindex, nofollow, noarchive")
            ->setTitle("Заказ билетов")
            ->setDescription("Описание");
        $manager->persist($metadata_7);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
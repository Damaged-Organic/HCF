<?php
// src/AppBundle/DataFixtures/ORM/LoadMainSlide.php
namespace AppBundle\DataFixtures\ORM;

use DateTime;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\MainSlide;

class LoadMainSlide implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new MainSlide)
            ->setSlogan("Профилактика маркетинговых заболеваний")
            ->setEventWhen("<p>15 октября 2015,</p> <p>10:00 - 18:00</p>")
            ->setEventWhere("<p>ТРЦ Гулливер, к-тр \"Оскар\"</p> <p>Спортивная пл., 1а</p>")
            ->setDatetime(new DateTime("2015-10-15 10:00"));
        $manager->persist($object_1);

        // ---

        $manager->flush();
    }
}
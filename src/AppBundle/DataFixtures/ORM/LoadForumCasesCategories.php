<?php
// src/AppBundle/DataFixtures/ORM/LoadForumCasesCategories.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ForumCaseCategory;

class LoadForumCasesCategories extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new ForumCaseCategory)
            ->setTitle("OTC препараты");
        $manager->persist($object_1);

        // ---

        $object_2 = (new ForumCaseCategory)
            ->setTitle("RX препараты");
        $manager->persist($object_2);

        // ---

        $object_3 = (new ForumCaseCategory)
            ->setTitle("Wellness");
        $manager->persist($object_3);

        // ---

        $object_4 = (new ForumCaseCategory)
            ->setTitle("Социальная реклама");
        $manager->persist($object_4);

        // ---

        $object_5 = (new ForumCaseCategory)
            ->setTitle("Услуги");
        $manager->persist($object_5);

        // ---

        $object_6 = (new ForumCaseCategory)
            ->setTitle("Разное");
        $manager->persist($object_6);

        // ---

        $manager->flush();

        $this->addReference('object_1', $object_1);
        $this->addReference('object_2', $object_2);
        $this->addReference('object_3', $object_3);
        $this->addReference('object_4', $object_4);
        $this->addReference('object_5', $object_5);
        $this->addReference('object_6', $object_6);
    }

    public function getOrder()
    {
        return 1;
    }
}
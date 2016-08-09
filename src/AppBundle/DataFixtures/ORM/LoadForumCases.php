<?php
// src/AppBundle/DataFixtures/ORM/LoadForumCases.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ForumCase;

class LoadForumCases extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new ForumCase)
            ->setForumCaseCategory($this->getReference('object_6'))
            ->setTitle("10M² OF LOVE")
            ->setYear(2015)
            ->setCreditClient("UNICEF CHINA")
            ->setCreditProduct("BREAST IS BEST")
            ->setCreditAgency("Y&R BEIJING, CHINA")
            ->setVideoLink("https://www.youtube.com/watch?v=pqf8vVf_k98");
        $manager->persist($object_1);

        // ---

        $object_2 = (new ForumCase)
            ->setForumCaseCategory($this->getReference('object_6'))
            ->setTitle("BALD FINDER")
            ->setYear(2015)
            ->setCreditClient("SESDERMA")
            ->setCreditProduct("SESKAVEL")
            ->setCreditAgency("McCANN MADRID, SPAIN")
            ->setVideoLink("https://www.youtube.com/watch?v=MFzEGkmDZFE");
        $manager->persist($object_2);

        // ---

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
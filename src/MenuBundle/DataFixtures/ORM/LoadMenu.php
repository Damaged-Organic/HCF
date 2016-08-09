<?php
// src/MenuBundle/DataFixtures/ORM/LoadMenu.php
namespace MenuBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use MenuBundle\Entity\Menu;

class LoadMenu extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $menuItem_1 = (new Menu)
            ->setTitle("Главная")
            ->setRoute("index");
        $manager->persist($menuItem_1);

        // ---

        $menuItem_2 = (new Menu)
            ->setTitle("Программа")
            ->setRoute("programme");
        $manager->persist($menuItem_2);

        // ---

        $menuItem_3 = (new Menu)
            ->setTitle("Кейсы")
            ->setRoute("cases");
        $manager->persist($menuItem_3);

        // ---

        $menuItem_4 = (new Menu)
            ->setTitle("Эксперты")
            ->setRoute("experts");
        $manager->persist($menuItem_4);

        // ---

        $menuItem_5 = (new Menu)
            ->setTitle("Контакты")
            ->setRoute("contacts");
        $manager->persist($menuItem_5);

        // ---

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
<?php
// src/AppBundle/DataFixtures/ORM/LoadStaffContacts.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\StaffContact;

class LoadStaffContacts implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new StaffContact)
            ->setPosition("Вопросы участия")
            ->setName("Полякова Наталья")
            ->setEmail("tickets@hcf.com.ua");
        $manager->persist($object_1);

        $object_2 = (new StaffContact)
            ->setPosition("Контакты с партнерами")
            ->setName("Шляхова Татьяна")
            ->setEmail("hcf@hcf.com.ua");
        $manager->persist($object_2);

        $object_3 = (new StaffContact)
            ->setPosition("Руководитель проекта")
            ->setName("Обидовская Виктория")
            ->setEmail("obidovskaya@hcf.com.ua");
        $manager->persist($object_3);

        $object_4 = (new StaffContact)
            ->setPosition("PR менеджер")
            ->setName("Елена Чубенко")
            ->setEmail("pr@hcf.com.ua");
        $manager->persist($object_4);

        $manager->flush();
    }
}
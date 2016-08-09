<?php
// src/AppBundle/DataFixtures/ORM/LoadProgrammeItems.php
namespace AppBundle\DataFixtures\ORM;

use DateTime;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ProgrammeItem;

class LoadProgrammeItems implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $object_1 = (new ProgrammeItem)
            ->setIcon(NULL)
            ->setTitle("Вступление")
            ->setShortDescription(NULL)
            ->setFullDescription(NULL)
            ->setTimeFrom(new DateTime("10:15"))
            ->setTimeTo(new DateTime("10:30"))
            ->setIsMain(FALSE);
        $object_1->setRawContent(
            $object_1->getFullDescription()
        );
        $manager->persist($object_1);

        // ---

        $object_2 = (new ProgrammeItem)
            ->setIcon("icon-bird")
            ->setTitle("Секция 1: ADMIRE!")
            ->setShortDescription("Показ вдохновляющих кейсов-победителей фестиваля Lions Health 2015. Вы увидите кейсы, которые видели только члены жюри этого международного конкурса, ведь многие из проектов никогда не будут открыты для публичного просмотра. Почувствуйте себя признанным экспертом в мировой сфере healthcare коммуникаций! Резюме Светлана Степаненко")
            ->setFullDescription("<p>Показ вдохновляющих кейсов-победителей фестиваля Lions Health 2015. Вы увидите кейсы, которые видели только члены жюри этого международного конкурса, ведь многие из проектов никогда не будут открыты для публичного просмотра. Почувствуйте себя признанным экспертом в мировой сфере healthcare коммуникаций! Резюме Светлана Степаненко</p>")
            ->setTimeFrom(new DateTime("10:30"))
            ->setTimeTo(new DateTime("11:30"))
            ->setIsMain(TRUE);
        $object_2->setRawContent(
            $object_2->getFullDescription()
        );
        $manager->persist($object_2);

        // ---

        $object_3 = (new ProgrammeItem)
            ->setIcon(NULL)
            ->setTitle("Перерыв")
            ->setShortDescription(NULL)
            ->setFullDescription(NULL)
            ->setTimeFrom(new DateTime("11:30"))
            ->setTimeTo(new DateTime("12:00"))
            ->setIsMain(FALSE);
        $object_3->setRawContent(
            $object_3->getFullDescription()
        );
        $manager->persist($object_3);

        // ---

        $object_4 = (new ProgrammeItem)
            ->setIcon("icon-lion")
            ->setTitle("Секция 2: BATTLE!")
            ->setShortDescription("Нужны ли креативные решения в фармацевтическом маркетинге? Как это влияет на эффективность? Авторитетные эксперты проведут панельную дискуссию и попробуют найти компромисс, как реализовать креативные и при этом эффективные проекты. Получится ли?")
            ->setFullDescription("<p>Нужны ли креативные решения в фармацевтическом маркетинге? Как это влияет на эффективность? Авторитетные эксперты проведут панельную дискуссию и попробуют найти компромисс, как реализовать креативные и при этом эффективные проекты. Получится ли?</p>")
            ->setTimeFrom(new DateTime("12:00"))
            ->setTimeTo(new DateTime("13:20"))
            ->setIsMain(TRUE);
        $object_4->setRawContent(
            $object_4->getFullDescription()
        );
        $manager->persist($object_4);

        // ---

        $object_5 = (new ProgrammeItem)
            ->setIcon(NULL)
            ->setTitle("Обед")
            ->setShortDescription(NULL)
            ->setFullDescription(NULL)
            ->setTimeFrom(new DateTime("13:20"))
            ->setTimeTo(new DateTime("14:00"))
            ->setIsMain(FALSE);
        $object_5->setRawContent(
            $object_5->getFullDescription()
        );
        $manager->persist($object_5);

        // ---

        $object_6 = (new ProgrammeItem)
            ->setIcon("icon-dolphine")
            ->setTitle("Секция 3: FEEL!")
            ->setShortDescription("О Каннских кейсах социальной рекламы ходят целые легенды! А решать социальные проблемы – это самый активнорастущий мировой тренд в маркетинге брендов. Ваша компания может уже сегодня сделать первые шаги в этом направлении в Украине")
            ->setFullDescription("<p>О Каннских кейсах социальной рекламы ходят целые легенды! А решать социальные проблемы – это самый активнорастущий мировой тренд в маркетинге брендов. Ваша компания может уже сегодня сделать первые шаги в этом направлении в Украине</p>")
            ->setTimeFrom(new DateTime("14:00"))
            ->setTimeTo(new DateTime("15:00"))
            ->setIsMain(TRUE);
        $object_6->setRawContent(
            $object_6->getFullDescription()
        );
        $manager->persist($object_6);

        // ---

        $object_7 = (new ProgrammeItem)
            ->setIcon(NULL)
            ->setTitle("Перерыв")
            ->setShortDescription(NULL)
            ->setFullDescription(NULL)
            ->setTimeFrom(new DateTime("15:00"))
            ->setTimeTo(new DateTime("15:30"))
            ->setIsMain(FALSE);
        $object_7->setRawContent(
            $object_7->getFullDescription()
        );
        $manager->persist($object_7);

        // ---

        $object_8 = (new ProgrammeItem)
            ->setIcon("icon-horse")
            ->setTitle("Секция 4: WORK!")
            ->setShortDescription("Доклад международного эксперта в healthcare communication")
            ->setFullDescription("<p>Доклад международного эксперта в healthcare communication</p>")
            ->setTimeFrom(new DateTime("15:30"))
            ->setTimeTo(new DateTime("16:50"))
            ->setIsMain(TRUE);
        $object_8->setRawContent(
            $object_8->getFullDescription()
        );
        $manager->persist($object_8);

        // ---

        $object_9 = (new ProgrammeItem)
            ->setIcon(NULL)
            ->setTitle("Заключение")
            ->setShortDescription(NULL)
            ->setFullDescription(NULL)
            ->setTimeFrom(new DateTime("16:50"))
            ->setTimeTo(new DateTime("17:00"))
            ->setIsMain(FALSE);
        $object_9->setRawContent(
            $object_9->getFullDescription()
        );
        $manager->persist($object_9);

        $manager->flush();
    }
}
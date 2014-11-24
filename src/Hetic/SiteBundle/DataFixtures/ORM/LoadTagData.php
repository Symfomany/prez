<?php

namespace Hetic\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hetic\SiteBundle\Entity\Tag;

class LoadTagData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tag = new Tag();
        $tag->setWord('Hello Promo P2016!');

        $tag2 = new Tag();
        $tag2->setWord('Hetic Symfony 2!');

        $manager->persist($tag);
        $manager->persist($tag2);
        $manager->flush();
    }
}
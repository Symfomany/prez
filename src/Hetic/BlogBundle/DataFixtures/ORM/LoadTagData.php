<?php


namespace Hetic\BlogBundle\DataFixtures\ORM;

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
        $tag->setWord('coucou');

        $manager->persist($tag);
        $manager->flush();

        $tag = new Tag();
        $tag->setWord('bonjour');

        $manager->persist($tag);
        $manager->flush();
    }
}


<?php
namespace Hetic\PublicBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hetic\PublicBundle\Entity\Post;

class LoadPostData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle('Hollande en chut libre');
        $post->setDescription("Hollande est en chute libre dans les sondages partout en France");
        $manager->persist($post);
        $manager->flush();
    }
}
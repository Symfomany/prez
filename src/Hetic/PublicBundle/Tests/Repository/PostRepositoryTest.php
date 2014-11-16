<?php

namespace Hetic\PublicBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostRepositoryTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Setup Doctrine Entity Manger
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * Test getPostBuTitle
     */
    public function testgetPostsByTitle()
    {
        $posts = $this->em
            ->getRepository('HeticPublicBundle:Post')
            ->getPostsByIdDesc();

        $this->assertCount(1, $posts);

        $posts = $this->em
            ->getRepository('HeticPublicBundle:Post')
            ->getPostsByTitle();

        $this->assertCount(1, $posts);
    }

    /**
     * Test getPostBuTitle
     */
    public function testgetPostsVisible()
    {
        $posts = $this->em
            ->getRepository('HeticPublicBundle:Post')
            ->getPostsVisible();

        $this->assertCount(0, $posts);
    }
}

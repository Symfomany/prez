<?php

namespace Hetic\PublicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Bonjour Fabien")')->count() > 0);

        $crawler = $client->request('GET', '/message');

        $this->assertTrue($crawler->filter('html:contains("Vous avez un nouveau message")')->count() > 0);

        $crawler = $client->request('GET', '/redirection');
        $crawler = $client->followRedirect();
//        exit(var_dump($client->getResponse()->getContent()));

        $this->assertTrue($crawler->filter('html:contains("Vous avez un nouveau message")')->count() > 0);
    }
}

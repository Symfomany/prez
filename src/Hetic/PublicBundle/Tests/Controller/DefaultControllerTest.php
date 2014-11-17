<?php

namespace Hetic\PublicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    /**
     * Navigating in application
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Hello Boyer Julien")')->count() > 0);

        $crawler = $client->request('GET', '/fr/message');

        $this->assertTrue($crawler->filter('html:contains("Vous avez un nouveau message")')->count() > 0);

        $crawler = $client->request('GET', '/en/message');

        $this->assertTrue($crawler->filter('html:contains("You are a new message Julien")')->count() > 0);

        $crawler = $client->request('GET', '/redirection');
        $crawler = $client->followRedirect();
//      var_dump($client->getResponse()->getContent()));

//        $crawler = $client->request('GET', '/notfound');
//
//        $this->assertTrue($crawler->filter('html:contains("404 Not Found")')->count() > 0);

        $crawler = $client->request('GET', '/messageflash');
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("Hello Boyer Julien !")')->count() > 0);

        $crawler = $client->request('GET', '/notification/error');

        $this->assertTrue($crawler->filter('html:contains("Notification: Error")')->count() > 0);

        $crawler = $client->request('GET', '/fr/message');

// Assert that there is at least one h2 tag
// with the class "subtitle"
        $this->assertGreaterThan(
            0,
            $crawler->filter('h3')->count()
        );

// Assert that there are exactly 4 h2 tags on the page
        $this->assertCount(0, $crawler->filter('h2'));

// Assert that the "Content-Type" header is "application/json"
        $this->assertFalse(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

//        $this->assertRegExp('/message', $client->getResponse()->getContent());

// Assert that the response status code is 2xx
        $this->assertTrue($client->getResponse()->isSuccessful());

//        $crawler = $client->request('GET', '/messages');

// Assert that the response status code is 404
//        $this->assertTrue($client->getResponse()->isNotFound());
// Assert a specific 200 status code
        $this->assertEquals(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );

// Assert that the response is a redirect to /demo/contact
//        $this->assertTrue(
//            $client->getResponse()->isRedirect('/redirection')
//        );
// or simply check that the response is a redirect to any URL
        $crawler = $client->request('GET', '/redirection');
        $this->assertTrue($client->getResponse()->isRedirect());

//        $crawler = $client->request('GET', '/twig');
//
//        $this->assertTrue($crawler->filter('html:contains("Hello HETIC!")')->count() > 0);
    }
}

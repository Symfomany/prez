<?php

namespace Hetic\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/g1/post/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /post/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'hetic_blogbundle_post[title]'  => 'Titre de mon post de test',
            'hetic_blogbundle_post[description]'  => 'La fameuse et longe description de mon post de test',
            'hetic_blogbundle_post[visible]'  => 1,
            'hetic_blogbundle_post[tag]'  => array(2)
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

//        $this->assertGreaterThan(0, $crawler->filter('td:contains("post de test")')->count(), 'Missing element td:contains("post de test")');
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'hetic_blogbundle_post[title]'  => 'Titre 2 de mon post de test modifié',
            'hetic_blogbundle_post[description]'  => 'La fameuse et longue description modifiée de mon post de test',

        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
//        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
//        $client->submit($crawler->selectButton('Delete')->form());
//        $crawler = $client->followRedirect();
//
//        // Check the entity has been delete on the list
//        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }


}

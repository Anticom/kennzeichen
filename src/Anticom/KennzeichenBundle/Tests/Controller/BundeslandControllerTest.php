<?php

namespace Anticom\KennzeichenBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BundeslandControllerTest extends WebTestCase
{
    public function testList()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/bundesland/list');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Bundesland")')->count() > 0);
    }

    public function testShow()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/bundesland/show/Hessen');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Details")')->count() > 0);
    }

    public function testShow404()
    {
        $client  = static::createClient();
        $client->request('GET', '/bundesland/show/Nope');

        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testEdit()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/bundesland/edit/1');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Bearbeiten")')->count() > 0);
    }

    public function testEdit404()
    {
        $client  = static::createClient();
        $client->request('GET', '/bundesland/edit/0');

        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testDelete()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/bundesland/delete/1');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Löschen")')->count() > 0);
    }

    public function testDelete404()
    {
        $client  = static::createClient();
        $client->request('GET', '/bundesland/delete/0');

        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }
} 
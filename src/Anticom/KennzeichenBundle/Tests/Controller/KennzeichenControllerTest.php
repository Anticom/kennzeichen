<?php

namespace Anticom\KennzeichenBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class KennzeichenControllerTest extends WebTestCase
{
    public function testList()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/kennzeichen/list');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Kennzeichen")')->count() > 0);
    }

    public function testShow()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/kennzeichen/show/1');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Details")')->count() > 0);
    }

    public function testShow404()
    {
        $client  = static::createClient();
        $client->request('GET', '/kennzeichen/show/0');

        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testEdit()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/kennzeichen/edit/1');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Bearbeiten")')->count() > 0);
    }

    public function testEdit404()
    {
        $client  = static::createClient();
        $client->request('GET', '/kennzeichen/edit/0');

        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testDelete()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/kennzeichen/delete/1');

        $this->assertTrue($crawler->filter('ol.breadcrumb:contains("Löschen")')->count() > 0);
    }

    public function testDelete404()
    {
        $client  = static::createClient();
        $client->request('GET', '/kennzeichen/delete/0');

        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }
} 
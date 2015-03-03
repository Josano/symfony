<?php

namespace Code\CarBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FabricanteControllerTest extends WebTestCase
{
    public function testFabricante()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fabricante');
    }

}

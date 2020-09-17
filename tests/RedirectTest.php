<?php

namespace App\Tests;

use App\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RedirectTest extends WebTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient();

        static::bootKernel();

    }

    public function testRedirectOnCall()
    {
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $link = new Link();
        $link->setSourceUrl('https://google.com');
        $em->persist($link);
        $em->flush();

        $this->client->request('GET', '/' . $link->getShortKey());
        $this->assertResponseRedirects('https://google.com', 302);
    }
}

<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Link;

class ApiTest extends ApiTestCase
{
    public function testGetLinks()
    {
        static::createClient()->request('GET', '/api/links');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceCollectionJsonSchema(Link::class);
    }

    public function testCreateShortenedUrl()
    {
        $request = static::createClient()->request('POST', '/api/links', [
            'json' => ['sourceUrl' => 'https://google.com']
        ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Link::class);
    }

    public function testBadUrlRequest()
    {
        $request = static::createClient()->request('POST', '/api/links', [
            'json' => ['sourceUrl' => 'some-invalid-url']
        ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}

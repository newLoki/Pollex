<?php
namespace Pollex\Tests;

class IndexTest extends BaseTestCase
{
    public function testIndexStatusCode()
    {
        $client = $this->createClient();
        $result = $client->request('GET', '/');


        $this->assertTrue($client->getResponse()->isOk());
    }
}
<?php
namespace Pollex\Tests;
use Silex\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class BaseTestCase extends BaseWebTestCase
{

    public function createApplication()
    {
        // load Silex
        //dont refactor to use require_once, this will break all -.-
        $app = require realpath(__DIR__.'/../app/app.php');

        return $app;
    }


    public function testHttpAuth()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/', array(), array(), array(
            'PHP_AUTH_USER' => 'john.doe@example.com',
            'PHP_AUTH_PW'   => '5f4dcc3b5aa765d61d8327deb882cf99'
        ));

        /** @var $response \Symfony\Component\HttpFoundation\JsonResponse */
        $response = $client->getResponse();
        $this->assertTrue($response->isOk(), $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testHttpAuthNotAuthorisedWrongPassword()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/', array(), array(), array(
            'PHP_AUTH_USER' => 'john.doe@example.com',
            'PHP_AUTH_PW'   => 'foo'
        ));

        /** @var $response \Symfony\Component\HttpFoundation\JsonResponse */
        $response = $client->getResponse();
        $this->assertFalse($response->isOk());
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testHttpAuthNotAuthorisedWrongUser()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/', array(), array(), array(
            'PHP_AUTH_USER' => 'bar@example.com',
            'PHP_AUTH_PW'   => 'foo'
        ));

        /** @var $response \Symfony\Component\HttpFoundation\JsonResponse */
        $response = $client->getResponse();
        $this->assertFalse($response->isOk());
        $this->assertEquals(403, $response->getStatusCode());
    }
}
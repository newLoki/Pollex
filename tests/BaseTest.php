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
        $this->markTestIncomplete(APPLICATION_ENV);
        $client = $this->createClient();
        $crawler = $client->request('GET', '/', array(), array(), array(
            'PHP_AUTH_USER' => 'john.doe@example.com',
            'PHP_AUTH_PW'   => '5f4dcc3b5aa765d61d8327deb882cf99'
        ));
        $this->assertTrue($client->getResponse()->isOk());
        //$result = json_decode($client->getResponse()->getContent());
        //$this->assertObjectHasAttribute('name', $result);
        //$this->assertEquals($result->name, 'foo');
    }

    public function testHttpAuthNotAuthorised()
    {
        $this->markTestIncomplete(APPLICATION_ENV);
    }
}
<?php
namespace Pollex\Tests;
use Silex\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class BaseTestCase extends BaseWebTestCase
{

    public function createApplication()
    {
            // load Silex
            $this->app = require __DIR__.'/../app/app.php';

            // Tests mode
            $this->app['debug'] = true;
            unset($this->app['exception_handler']);
            $app['translator.messages'] = array();

            // Use FilesystemSessionStorage to store session
            $this->app['session.storage'] = $this->app->share(function() {
                return new MockFileSessionStorage(sys_get_temp_dir());
            });

            return $app;
    }


    public function testJsonReturn()
    {
        $this->markTestIncomplete('not working yet, because there are no possibility to authentificate yet');
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $result = json_decode($client->getResponse()->getContent());
        $this->assertObjectHasAttribute('name', $result);
        $this->assertEquals($result->name, 'foo');
    }
}
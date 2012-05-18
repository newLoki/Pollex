<?php
namespace Pollex\Tests;
use Silex\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class BaseTestCase extends BaseWebTestCase
{

    public function createApplication()
    {
            // load Silex
            $this->app = require __DIR__.'/../../app/app.php';

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
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        var_dump($client->getResponse());
        $this->assertTrue($client->getResponse()->isOk());
    }
}
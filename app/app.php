<?php
use Silex\Provider\SymfonyBridgesServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\FormServiceProvider;

require_once __DIR__.'/bootstrap.php';

$app = new Silex\Application();
$app['debug'] = true;

//register config dir
$app->register(new KevinGH\Silex\Config\Provider, array(
    'config.path' => __DIR__ . '/config'
));

//register Doctrine ORM extension
$app['autoloader']->registerNamespace('Nutwerk', __DIR__ . '/vendor/nutwerk-orm-extension/lib');
$app->register(new Nutwerk\Provider\DoctrineORMServiceProvider(), array(
    'db.orm.class_path'            => __DIR__.'/../vendor/doctrine2-orm/lib',
    'db.orm.proxies_dir'           => __DIR__.'/../var/cache/doctrine/Proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.auto_generate_proxies' => true,
    'db.orm.entities'              => array(array(
        'type'      => 'annotation',
        'path'      => __DIR__.'/../src/entites',
        'namespace' => 'Pollex\Entity',
    )),
));

//ensure that content type is json
$app->before(function ($request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request = new ParameterBag($data);
    }
});

//ensure it is authentificated
//look @ http://chemicaloliver.net/programming/http-basic-auth-in-silex/
$app->before(function() use ($app)
{
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        $domain = $app['config']->get('domain');
        header('WWW-Authenticate: Basic realm="' . $domain . '"');
        return $app->json(array('Message' => 'Not Authorised'), 401);
    } else {
        //get user given in $_SERVER['PHP_AUTH_USER'] and check if
        //password is same as $_SERVER['PHP_AUTH_PW']
        //if not -> return $app->json(array('Message' => 'Forbidden'), 403);


    }
});

$app->get('/', function() use ($app) {

    $test = new stdClass();
    $test->name = 'foo';

    return $app->json($test);
});

return $app;
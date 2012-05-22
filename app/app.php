<?php
require_once __DIR__.'/bootstrap.php';

$app = new Silex\Application();
$app['debug'] = true;

//register own namespace
$app['autoloader']->registerNamespace('Pollex', realpath(__DIR__ . '/../src/'));

//register Doctrine ORM extension
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'            => array(
        'driver'    => 'pdo_sqlite',
        'path'      => __DIR__.'/app.db',
    ),
    'db.dbal.class_path'    => __DIR__.'/../vendor/doctrine/dbal/lib',
    'db.common.class_path'  => __DIR__.'/../vendor/doctrine/common/lib',
));
$app['autoloader']->registerNamespace('Nutwerk', realpath(__DIR__ . '/../vendor/nutwerk/doctrine-orm-provider/lib/'));
$app->register(new Nutwerk\Provider\DoctrineORMServiceProvider(), array(
    'db.orm.class_path'            => __DIR__.'/../vendor/doctrine/orm/lib',
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
$app->before(function() use ($app)
{
    //$request->server->get('PHP_AUTH_USER', false)
    $username = $app['request']->server->get('PHP_AUTH_USER', false);
    $password = $app['request']->server->get('PHP_AUTH_PW', false);
    if (!$username) {
        $domain = 'http://pollex.de';
        $app['request']->headers->set('WWW-Authenticate', 'Basic realm="' . $domain . '"');
        return $app->json(array('Message' => 'Not Authorised'), 401);
    } else {

        $query = $app['db.orm.em']->createQuery(
            'SELECT u.password FROM Pollex\Entity\User u WHERE u.name = :name');
        $query->setParameter(':name', $username);
        $userPassword = $query->getResult();
        if($userPassword !== $password) {
            return $app->json(array('Message' => 'Forbidden'), 403);
        }
    }
});

$app->get('/', function() use ($app) {

    $test = new stdClass();
    $test->name = 'foo';

    return $app->json($test);
});

return $app;
<?php
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use JG\Silex\Provider\CapsuleServiceProvider;
use Solidsites\UserProvider;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app->register(new Silex\Provider\VarDumperServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates',
));
$app->register(new CapsuleServiceProvider(),
    [
        'capsule.connections' =>
        [
            'default' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'solidsites',
                'username' => 'root',
                'password' => 'root'
            ]
        ]
    ]
);
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
        'security.firewalls' => array(
            'admin' => array(
                'pattern' => '^/admin',
                'form' => array('login_path' => '/login', 'check_path' => '/admin/login_check'),
                'logout' => array('logout_path' => '/admin/logout', 'invalidate_session' => true),
                'users' => function () use ($app) {
                    return new UserProvider($app['capsule.connections']);
                },
            ),
        ),
        'security.encoder.bcrypt.cost' => 4,
    )
);
$app['debug'] = true;
return $app;
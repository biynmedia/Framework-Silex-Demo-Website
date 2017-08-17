<?php

use Silex\Application;
use TechNews\Controller\Provider\NewsControllerProvider;
use TechNews\Controller\Provider\AdminControllerProvider;
use Silex\Provider\AssetServiceProvider;
use Idiorm\Silex\Provider\IdiormServiceProvider;

#1 : Importation de l'Autoloader
require_once __DIR__.'/../vendor/autoload.php';

#2 : Instanciation de l'Application
$app = new Application();

#3 : Activation du Debuggage
$app['debug'] = true;

#4 : Gestion de nos Controllers via ControllerProvider
$app->mount('/', new NewsControllerProvider());
$app->mount('/admin', new AdminControllerProvider());

#5 : Activation de Twig
 # : composer require twig/twig
 # : composer require symfony/twig-bridge 
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        __DIR__.'/../ressources/views',
        __DIR__.'/../ressources/layout'
    ],
));

#6 : Activation de Asset
$app->register(new AssetServiceProvider());

#7 : Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'technews-limas',
        'user'      => 'root',
        'password'  => ''
    ),
));

$app->register(new IdiormServiceProvider(), array(
    'idiorm.db.options' => array(
        'connection_string' => 'mysql:host=localhost;dbname=technews-limas',
        'username' => 'root',
        'password' => '',
    )
));

#8.1 : Récupération des catégories
$app['technews_categories'] = function() use($app) {
    return $app['db']->fetchAll('SELECT * FROM categorie');
};

#8.2 : Récupération des tags
$app['technews_tags'] = function() use($app) {
    return $app['db']->fetchAll('SELECT * FROM tags');
};

#8.3 : Récupération des categories via Idiorm
$app['idiorm_categories'] = function() use($app) {
    return $app['idiorm.db']->for_table('categorie')->find_result_set();
};

#9 : Execution de l'Application
$app->run();

















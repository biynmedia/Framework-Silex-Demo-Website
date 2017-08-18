<?php

use Silex\Application;
use TechNews\Controller\Provider\NewsControllerProvider;
use TechNews\Controller\Provider\AdminControllerProvider;
use Silex\Provider\AssetServiceProvider;
use Idiorm\Silex\Provider\IdiormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use TechNews\Extension\TechNewsTwigExtension;

#1 : Importation de l'Autoloader
require_once __DIR__.'/../vendor/autoload.php';

#2 : Instanciation de l'Application
$app = new Application();

#3 : Activation du Debuggage
$app['debug'] = true;

#4 : Gestion de nos Controllers via ControllerProvider
$app->mount('/', new NewsControllerProvider());
$app->mount('/admin', new AdminControllerProvider());

#5.1 : Activation de Twig
 # : composer require twig/twig
 # : composer require symfony/twig-bridge 
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        __DIR__.'/../ressources/views',
        __DIR__.'/../ressources/layout'
    ],
));

#5.2 : Ajout des Extensions TechNews pour Twig
# use TechNews\Extension\TechNewsTwigExtension;
$app->extend('twig', function($twig, $app){
    $twig->addExtension(new TechNewsTwigExtension());
    return $twig;
});

#6 : Activation de Asset
$app->register(new AssetServiceProvider());

#7.1 : Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'technews-limas',
        'user'      => 'root',
        'password'  => ''
    ),
));

#7.2 : Idiorm ORM
$app->register(new IdiormServiceProvider(), array(
    'idiorm.db.options' => array(
        'connection_string' => 'mysql:host=localhost;dbname=technews-limas',
        'username' => 'root',
        'password' => '',
		'id_column_overrides' => array(
			'view_articles' =>  'IDARTICLE'
		)
    )
));

#8 : Permet le rendu d'un controller dans la vue 
# https://silex.symfony.com/doc/2.0/providers/twig.html#rendering-a-controller
$app->register(new HttpFragmentServiceProvider());

#9.1 : Récupération des catégories
$app['technews_categories'] = function() use($app) {
    return $app['db']->fetchAll('SELECT * FROM categorie');
};

#9.2 : Récupération des tags
$app['technews_tags'] = function() use($app) {
    return $app['db']->fetchAll('SELECT * FROM tags');
};

#9.3 : Récupération des categories via Idiorm
$app['idiorm_categories'] = function() use($app) {
    return $app['idiorm.db']->for_table('categorie')->find_result_set();
};

#10 : Execution de l'Application
$app->run();

















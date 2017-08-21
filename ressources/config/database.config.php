<?php

use Idiorm\Silex\Provider\IdiormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

#1 : Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'technews-limas',
        'user'      => 'root',
        'password'  => ''
    ),
));

#2 : Idiorm ORM
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

#3 : Permet le rendu d'un controller dans la vue
# https://silex.symfony.com/doc/2.0/providers/twig.html#rendering-a-controller
$app->register(new HttpFragmentServiceProvider());

#4.1 : Récupération des catégories
$app['technews_categories'] = function() use($app) {
    return $app['db']->fetchAll('SELECT * FROM categorie');
};

#4.2 : Récupération des tags
$app['technews_tags'] = function() use($app) {
    return $app['db']->fetchAll('SELECT * FROM tags');
};

#4.3 : Récupération des categories via Idiorm
$app['idiorm_categories'] = function() use($app) {
    return $app['idiorm.db']->for_table('categorie')->find_result_set();
};
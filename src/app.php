<?php

use Silex\Provider\AssetServiceProvider;
use TechNews\Extension\TechNewsTwigExtension;

#1 : Activation du Debuggage
$app['debug'] = true;

#2 : Gestion de nos Controllers via ControllerProvider
require PATH_SRC . '/routes.php';

#3 : Activation de Twig
# : composer require twig/twig
# : composer require symfony/twig-bridge
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        PATH_VIEWS,
        PATH_RESSOURCES .'/layout'
    ],
));

#4 : Ajout des Extensions TechNews pour Twig
# use TechNews\Extension\TechNewsTwigExtension;
$app->extend('twig', function($twig, $app){
    $twig->addExtension(new TechNewsTwigExtension());
    return $twig;
});

#5 : Activation de Asset
$app->register(new AssetServiceProvider());

#6 : Doctrine DBAL
require PATH_RESSOURCES . '/config/database.config.php';

#7 : Sécurisation de notre Application
require PATH_RESSOURCES . '/config/security.php';

#8 : On retourne $app
return $app;














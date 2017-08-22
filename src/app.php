<?php

use Silex\Provider\AssetServiceProvider;
use TechNews\Extension\TechNewsTwigExtension;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\CsrfServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

#6 : Importations pour les Formulaires

$app->register(new FormServiceProvider());
$app->register(new CsrfServiceProvider());
$app->register(new LocaleServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TranslationServiceProvider(), array(
    'translator.domains' => array(),
));

#7 : Doctrine DBAL
require PATH_RESSOURCES . '/config/database.config.php';

#8 : Sécurisation de notre Application
require PATH_RESSOURCES . '/config/security.php';

#9 : Gestion des Erreurs
#  : https://gist.github.com/tournasdim/171b443065936bbb5ef3
$app->error(function (\Exception $e) use ($app) {
    if ($e instanceof NotFoundHttpException) {
        return $app['twig']->render('erreur.html.twig', [
            'message' => $e->getMessage()
        ]);
    };

    #$code = ($e instanceof HttpException) ? $e->getStatusCode() : 500;
    #return $app->json(array('error' => $e->getMessage()), $code);
});
#10 : On retourne $app
return $app;














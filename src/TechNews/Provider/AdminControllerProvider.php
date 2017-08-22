<?php
namespace TechNews\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class AdminControllerProvider implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        # : Créer une instance de Silex\ControllerCollection
        # : https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        
        # Ajouter un Article en BDD
        $controllers
            ->match('/article/ajouter', 
                  'TechNews\Controller\AdminController::addarticleAction')
            ->method('GET|POST')
            ->bind('technews_addarticle');
        
       return $controllers;
    }
}











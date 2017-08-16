<?php
namespace TechNews\Controller\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class AdminControllerProvider implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        # : Créer une instance de Silex\ControllerCollection
        # : https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        
        # Connexion à l'Administration
        $controllers
            ->get('/connexion', 'TechNews\Controller\AdminController::connexionAction')
            ->bind('technews_adminconnexion');
        
        # Inscription d'un Administrateur
        $controllers
            ->get('/inscription', 'TechNews\Controller\AdminController::inscriptionAction')
            ->bind('technews_admininscription');
        
        # Ajouter un Article en BDD
        $controllers
            ->get('/article/ajouter', 
                  'TechNews\Controller\AdminController::addarticleAction')
            ->bind('technews_addarticle');
        
       return $controllers;
    }
}











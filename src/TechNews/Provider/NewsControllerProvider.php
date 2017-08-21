<?php

namespace TechNews\Provider;

use Silex\Api\ControllerProviderInterface;

class NewsControllerProvider implements ControllerProviderInterface {
    
    /**
     * {@inheritDoc}
     * @see \Silex\Api\ControllerProviderInterface::connect()
     */
    public function connect(\Silex\Application $app)
    {
        
        # : Créer une instance de Silex\ControllerCollection
        # : https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        
            # Page d'Accueil
            $controllers
                # On associe une Route à un Controller et une Action
                ->get('/', 'TechNews\Controller\NewsController::indexAction')
                # En option je peux donner un nom à la route, qui servira plus tard
                # pour la créations de lien
                ->bind('technews_home');
            
            # Page Catégories
            $controllers
                ->get('/categorie/{libellecategorie}', 
                        'TechNews\Controller\NewsController::categorieAction')
                # Je spécifie le type de paramètre attendu via une RegEx
                ->assert('libellecategorie', '[^/]+')
                # Je peux attribuer une valeur par défaut.
                ->value('libellecategorie', 'computer')
                # Nom de ma Route
                ->bind('technews_categorie');
            
            # Page Articles
            $controllers
                ->get('/{libellecategorie}/{slugarticle}_{idarticle}.html',
                        'TechNews\Controller\NewsController::articleAction')
                ->assert('idarticle', '\d+')
                ->bind('technews_article');
            
           #PHP Info
           $controllers
                ->get('/infos', 
                    'TechNews\Controller\Provider\NewsControllerProvider::infoAction');
        
                
            # Connexion à l'Administration
            $controllers
                ->get('/connexion', 'TechNews\Controller\NewsController::connexionAction')
                ->bind('technews_connexion');
            
            # Déconnexion à l'Administration
            $controllers
                ->get('/deconnexion', 'TechNews\Controller\NewsController::deconnexionAction')
                ->bind('technews_deconnexion');
            
            # Inscription d'un Administrateur
            $controllers
                ->get('/inscription', 'TechNews\Controller\NewsController::inscriptionAction')
                ->bind('technews_inscription');
            
            $controllers
                ->post('/inscription', 'TechNews\Controller\NewsController::inscriptionPost')
                ->bind('technews_inscription_post');
            
        # On retourne la liste des controllers (ControllerCollection)
        return $controllers;
        
    }
    
    /**
     * Affiche les informations PHP
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function infoAction() {
        return phpinfo();
    }
}
















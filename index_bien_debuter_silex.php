<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

/**
 * 1 : Importation de l'Autoload de Composer
 * Il permet de charger toutes les dépendances du projet
 * de façon automatique. Ex. Symfony, Pimple, Silex, ...
 */
require_once __DIR__.'/vendor/autoload.php';

/**
 * 2 : Instanciation de l'application Silex
 * @var \Silex\Application $app
 */
$app = new Application();

/**
 * 3 : Activation du Debuggage
 */
$app['debug'] = true;

/**
 * J'associe la route "/" à ma fonction anonyme
 * qui me renvoi le résultat à afficher. 
 */
$app->get('/', function() {
   return '<h1>Page Accueil</h1>'; 
});

/**
 * "match" me permet de ne pas spécifier de type de méthode (get, post, ...)
 * "method" me permet de n'autoriser que certaines méthodes HTTP.
 */

# J'enregistre dans App ma valeur "prenom.default"
# J'y accède ensuite de la même façon
$app['prenom.default'] = function() {
    return 'Hugo';
};

/**
 * Dans SILEX :
 * 1. Si ma route est détectée grâce à "match()"
 * 2. Alors, la fonction anonyme (closure - controller) est executée.
 * 3. Une réponse HTML et un code statut HTTP sont renvoyés au navigateur.
 */
$app->match('/hello/{prenom}', function($prenom){
   # Une "Response" Silex associe à notre "Réponse HTML" à un statut HTTP
   return  new Response("<h1>Hello $prenom</h1>");
})->method('GET|POST')->value('prenom', $app['prenom.default']);

/**
 * 4 : Execution de Silex
 */
$app->run();















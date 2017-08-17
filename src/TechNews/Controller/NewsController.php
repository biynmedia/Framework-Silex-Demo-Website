<?php
namespace TechNews\Controller;

use Silex\Application;

class NewsController
{
    /**
     * Affichage de la Page d'Accueil
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function indexAction(Application $app) {
        
        # Connexion à la BDD & Récupération des Articles
        $articles = $app['db']->fetchAll('SELECT * FROM view_articles');
        
        # Récupération des Articles en Spotlight
        $spotlight = $app['db']->fetchAll('SELECT * FROM view_articles WHERE SPOTLIGHTARTICLE = 1');
       
        # Affichage dans la Vue
        return $app['twig']->render('index.html.twig',[
            'articles'  => $articles,
            'spotlight' => $spotlight
        ]);
    }
    
    /**
     * Affichage de la Page Categorie
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function categorieAction($libellecategorie) {
        return "<h1>Categorie - $libellecategorie</h1>";
    }
    
    /**
     * Affichage de la Page Article
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function articleAction($libellecategorie, $slugarticle, $idarticle) {
        # index.php/business/une-formation-innovante-a-villefranche_092232555252.html
        return "<h1>Article n° $idarticle | $slugarticle</h1>";
    }
}














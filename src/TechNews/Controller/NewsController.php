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
    public function categorieAction($libellecategorie, Application $app) {
        
        # Connexion à la BDD et la Récupération des Articles de la Catégorie
        $articles = $app['idiorm.db']->for_table('view_articles')
                                     ->where('LIBELLECATEGORIE', ucfirst($libellecategorie))
                                     ->find_result_set();
        
        # Transmission à la Vue
        return $app['twig']->render('categorie.html.twig',[
            'articles' => $articles,
            'categorie' => $libellecategorie
        ]);
                                     
    }
    
    /**
     * Affichage de la Page Article
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function articleAction($libellecategorie, $slugarticle, $idarticle, Application $app) {
        # index.php/business/une-formation-innovante-a-villefranche_092232555252.html
        
        # Récupération de l'Article
        $article = $app['idiorm.db']->for_table('view_articles')->find_one($idarticle);
        
        # Récupération des Articles de la Catégorie (suggestions)
        $suggestions = $app['idiorm.db']->for_table('view_articles')
        
        # Je récupère uniquement les articles de la même catégorie que mon article
        ->where('LIBELLECATEGORIE', ucfirst($libellecategorie))
        
        # Sauf mon article en cours
        ->where_not_equal('IDARTICLE', $idarticle)
        
        # 3 articles maximum
        ->limit(3)
        
        # Par ordre décroissant
        ->order_by_desc('IDARTICLE')
        
        # Je récupère les résultats
        ->find_result_set();
        
        return $app['twig']->render('article.html.twig',[
            'article' => $article,
            'suggestions' => $suggestions
        ]);
        
    }
    
    /**
     * Génération du Menu dans le Layout
     * @param Application $app
     */
    public function menu(Application $app) {
        
        # Récupération des Catégories
        $categories = $app['idiorm.db']->for_table('categorie')->find_result_set();
        
        # Transmission à la Vue
        return $app['twig']->render('menu.html.twig',['categories' => $categories]);
        
    }
    
    /**
     * Génération de la sidebar dans le Layout
     * @param Application $app
     */
    public function sidebar(Application $app) {
        
        # Récupération des informations pour la sidebar
        $sidebar = $app['idiorm.db']->for_table('view_articles')
                                    ->order_by_desc('DATECREATIONARTICLE')
                                    ->limit(5)
                                    ->find_result_set();
        
        $special = $app['idiorm.db']->for_table('view_articles')
                                    ->where('SPECIALARTICLE', 1)
                                    ->find_result_set();
        
        # Transmission à la Vue
        return $app['twig']->render('sidebar.html.twig',[
           'sidebar' => $sidebar,
           'special' => $special
        ]);
        
    }
}














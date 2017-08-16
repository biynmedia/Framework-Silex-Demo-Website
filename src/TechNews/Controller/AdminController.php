<?php
namespace TechNews\Controller;

class AdminController
{
    /**
     * Affichage de la Page Connexion
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function connexionAction() {
        return '<h1>Connexion</h1>';
    }
    
    /**
     * Affichage de la Page Inscription
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function inscriptionAction() {
        return '<h1>Inscription</h1>';
    }
    
    /**
     * Affichage de la Page Ajouter un Article
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function addarticleAction() {
        return '<h1>Ajouter un Article</h1>';
    }
}


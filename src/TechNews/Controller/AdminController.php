<?php
namespace TechNews\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use TechNews\Traits\Shortcut;

class AdminController
{
    use Shortcut;
    
    /**
     * Affichage de la Page Ajouter un Article
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function addarticleAction(Application $app, Request $request) {
        
        # Récupérer la Liste des Auteurs
        $auteurs = function() use($app) {
            
            # Récupération des auteurs dans la BDD
            $auteurs = $app['idiorm.db']->for_table('auteur')->find_result_set();
            
            # On formate l'affichage pour le champ select (ChoiceType)
            $array = [];
            foreach ($auteurs as $auteur) :
                $array[$auteur->PRENOMAUTEUR.' '.$auteur->NOMAUTEUR] = $auteur->IDAUTEUR;
            endforeach;
            
            return $array;
            
        };
        
        # Récupérer la Liste des Catégories
        $categories = function() use($app) {
        
            # Récupération des auteurs dans la BDD
            $categories = $app['idiorm.db']->for_table('categorie')->find_result_set();
        
            # On formate l'affichage pour le champ select (ChoiceType)
            $array = [];
            foreach ($categories as $categorie) :
                $array[$categorie->LIBELLECATEGORIE] = $categorie->IDCATEGORIE;
            endforeach;
        
            return $array;
        
        };
        
        # Création Formulaire permettant l'ajout d'un Article
        # use Symfony\Component\Form\Extension\Core\Type\FormType;
        $form = $app['form.factory']->createBuilder(FormType::class)
        
            # use Symfony\Component\Form\Extension\Core\Type\TextType;
            # use Symfony\Component\Validator\Constraints\NotBlank;
            ->add('TITREARTICLE', TextType::class, [
                
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'         => 'form-control',
                    'placeholder'   => 'Titre de l\'Article...'
                ]
            ])
            
            ->add('IDAUTEUR', ChoiceType::class, [
                
                'choices'   => $auteurs(),
                'expanded'  => false,
                'multiple'  => false,
                'label'     => false,
                'attr'          =>  [
                    'class'         => 'form-control'
                ]                
            ])
            
            ->add('IDCATEGORIE', ChoiceType::class, [
            
                'choices'   => $categories(),
                'expanded'  => false,
                'multiple'  => false,
                'label'     => false,
                'attr'          =>  [
                    'class'         => 'form-control'
                ]
            ])
            
            ->add('CONTENUARTICLE', TextareaType::class, [
            
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'         => 'form-control'
                ]
            ])
            
            ->add('FEATUREDIMAGEARTICLE', FileType::class, [
            
                'required'      =>  false,
                'label'         =>  false,
                'attr'          =>  [
                    'class'         => 'dropify'
                ]
            ])
            
            ->add('SPECIALARTICLE', CheckboxType::class, [
                'required' => false,
                'label'    => false
            ])
            
            ->add('SPOTLIGHTARTICLE', CheckboxType::class, [
                'required' => false,
                'label'    => false
            ])
            
            ->add('submit', SubmitType::class, ['label' => 'Publier'])
            
            ->getForm();
            
       # Traitement des données POST
       # use Symfony\Component\HttpFoundation\Request;
       $form->handleRequest($request);
       
       if($form->isValid()) :
       
            # Récupération des données du Formulaire
            $article = $form->getData();
       
            # Récupération de l'image
            $image  = $article['FEATUREDIMAGEARTICLE'];
            $chemin = PATH_PUBLIC.'/assets/images/product/';
            $image->move($chemin, $this->generateSlug($article['TITREARTICLE']).'.jpg');
            
            # Insertion en BDD
            $articleDb  = $app['idiorm.db']->for_table('article')->create();
            $categorie  = $app['idiorm.db']->for_table('categorie')->find_one($article['IDCATEGORIE']);
            
            # On associe les coloinnes de notre BDD avec les valeurs du Formulaire
            #Colonne mySQL                      # Valeurs Formulaire
            $articleDb->IDAUTEUR                =   $article['IDAUTEUR'];
            $articleDb->IDCATEGORIE             =   $article['IDCATEGORIE'];
            $articleDb->TITREARTICLE            =   $article['TITREARTICLE'];
            $articleDb->CONTENUARTICLE          =   $article['CONTENUARTICLE'];
            $articleDb->SPECIALARTICLE          =   $article['SPECIALARTICLE'];
            $articleDb->SPOTLIGHTARTICLE        =   $article['SPOTLIGHTARTICLE'];
            $articleDb->FEATUREDIMAGEARTICLE    =   $this->generateSlug($article['TITREARTICLE']).'.jpg';
            
            # Insertion en BDD
            $articleDb->save();
            
            # Redirection
            return $app->redirect( $app['url_generator']->generate('technews_article', [
                'libellecategorie'  => strtolower($categorie->LIBELLECATEGORIE),
                'idarticle'         => $articleDb->IDARTICLE,
                'slugarticle'       => $this->generateSlug($article['TITREARTICLE'])
            ]) );
            
       endif;
        
       # Affichage du Formulaire dans la Vue
       return $app['twig']->render('admin/ajouterarticle.html.twig', [
           'form' => $form->createView()
       ]);
            
    }
}

















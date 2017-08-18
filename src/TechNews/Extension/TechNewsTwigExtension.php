<?php
namespace TechNews\Extension;

class TechNewsTwigExtension extends \Twig_Extension
{
    # : https://twig.symfony.com/doc/2.x/advanced.html#creating-an-extension
    # : https://twig.symfony.com/doc/2.x/advanced.html#id3
    /**
     * Création des Filtres "Acrroche" et "Slugify"
     * {@inheritDoc}
     * @see Twig_Extension::getFilters()
     */
    public function getFilters() {
        return array(
            # : https://twig.symfony.com/doc/2.x/advanced.html#filters
            new \Twig_Filter('accroche', function($text) {
                
                # Supprimer toutes les balises HTML
                $string = strip_tags($text);
                
                # Si ma chaîne de caractère est supérieure à 170, je poursuis.
                # Sinon c'est inutile.
                if(strlen($string) > 170) {
                
                    # Je coupe ma chaine à 170.
                    $stringCut = substr($string, 0, 170);
                
                    # Je m'assure que je ne coupe pas de mot !
                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
                
                }
                
                return $string;
                
            }), # -- Fin de Twig_Filter Accroche
            
            # https://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
            new \Twig_Filter('slug', function($text) {
                
                // replace non letter or digits by -
                $text = preg_replace('~[^\pL\d]+~u', '-', $text);
                
                // transliterate
                $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
                
                // remove unwanted characters
                $text = preg_replace('~[^-\w]+~', '', $text);
                
                // trim
                $text = trim($text, '-');
                
                // remove duplicate -
                $text = preg_replace('~-+~', '-', $text);
                
                // lowercase
                $text = strtolower($text);
                
                if (empty($text)) {
                    return 'n-a';
                }
                
                return $text;
                
            }) # -- Fin de Twig_Filter Slug
            
        ); # -- Fin du Array
            
    } # -- Fin de la Fonction getFilters()
    
} # -- Fin de la Classe TechNewsTwigExtension

# -- Fin du Fichier ^^
#
#
#
#
#
#
#
#
#
#
# -- Fin de la Vie... -_-

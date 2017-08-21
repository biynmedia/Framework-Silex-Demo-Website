<?php
namespace TechNews\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use TechNews\Model\Auteur;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AuteurProvider implements UserProviderInterface
{
    
    private $_db;
    
    /**
     * Récupération de l'instance de la BDD
     * @param Idiorm ou Doctrine DBAL $db
     */
    public function __construct($db)
    {
        $this->_db = $db;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::supportsClass()
     */
    public function supportsClass($class)
    {
        return $class === 'TechNews\Model\Auteur';
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::refreshUser()
     */
    public function refreshUser(UserInterface $auteur)
    {
        # use TechNews\Model\Auteur;
        # On s'assure de bien avoir un Objet de la classe auteur
        if(!$auteur instanceof Auteur) {
            throw new UnsupportedUserException(
                sprintf('Les instances de "%s" ne sont pas autorisées.', 
                    get_class($auteur)));
        }
        
        return $this->loadUserByUsername($auteur->getUsername());
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::loadUserByUsername()
     */
    public function loadUserByUsername($EMAILAUTEUR)
    {
        $auteur = $this->_db->for_table('auteur')
                            ->where('EMAILAUTEUR', $EMAILAUTEUR)
                            ->find_one();
        
        if(empty($auteur)) {
            throw new UsernameNotFoundException(
                sprintf('Cet utilisateur "%s" n\'existe pas.', $EMAILAUTEUR));
        }
        
        return new Auteur($auteur->IDAUTEUR, $auteur->NOMAUTEUR, 
            $auteur->PRENOMAUTEUR, $auteur->EMAILAUTEUR, $auteur->MDPAUTEUR, 
            $auteur->ROLESAUTEUR);
    }
}













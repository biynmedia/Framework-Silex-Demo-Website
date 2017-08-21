<?php
namespace TechNews\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class Auteur implements UserInterface
{
    # Définition des Propriétés
    private $IDAUTEUR,
            $NOMAUTEUR,
            $PRENOMAUTEUR,
            $EMAILAUTEUR,
            $MDPAUTEUR,
            $ROLESAUTEUR;
    
    /**
     * Création d'un Objet Auteur
     * @param Entier  $IDAUTEUR
     * @param String  $NOMAUTEUR
     * @param String  $PRENOMAUTEUR
     * @param String  $EMAILAUTEUR
     * @param String  $MDPAUTEUR
     * @param String  $ROLESAUTEUR
     */
    public function __construct(
        $IDAUTEUR,
        $NOMAUTEUR,
        $PRENOMAUTEUR,
        $EMAILAUTEUR,
        $MDPAUTEUR,
        $ROLESAUTEUR)
    {
        $this->IDAUTEUR         = $IDAUTEUR;
        $this->NOMAUTEUR        = $NOMAUTEUR;
        $this->PRENOMAUTEUR     = $PRENOMAUTEUR;
        $this->EMAILAUTEUR      = $EMAILAUTEUR;
        $this->MDPAUTEUR        = $MDPAUTEUR;
        $this->ROLESAUTEUR[]    = $ROLESAUTEUR;
    }


    # -------- Getters --------#
    
    
    /**
     * @return the $IDAUTEUR
     */
    public function getIDAUTEUR()
    {
        return $this->IDAUTEUR;
    }

    /**
     * @return the $NOMAUTEUR
     */
    public function getNOMAUTEUR()
    {
        return $this->NOMAUTEUR;
    }

    /**
     * @return the $PRENOMAUTEUR
     */
    public function getPRENOMAUTEUR()
    {
        return $this->PRENOMAUTEUR;
    }

    /**
     * @return the $EMAILAUTEUR
     */
    public function getEMAILAUTEUR()
    {
        return $this->EMAILAUTEUR;
    }

    /**
     * @return the $MDPAUTEUR
     */
    public function getMDPAUTEUR()
    {
        return $this->MDPAUTEUR;
    }

    /**
     * @return the $ROLESAUTEUR
     */
    public function getROLESAUTEUR()
    {
        return $this->ROLESAUTEUR;
    }
    
    # -------- Méthodes Héritées de l'Interface --------#
    
    public function getPassword()
    {
        return $this->MDPAUTEUR;
    }

    public function eraseCredentials() {}

    public function getSalt() { return null; }

    public function getRoles()
    {
        return $this->ROLESAUTEUR;
    }

    public function getUsername()
    {
        return $this->EMAILAUTEUR;
    }
}


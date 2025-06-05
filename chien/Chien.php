<?php
require_once 'Animal.php';

class Chien implements Animal {
    private $nom;
    private $age;
    private $race;
    private $couleur;
    private $sexe;
    private $poids;

    public function __construct($nom, $age, $race, $couleur, $sexe, $poids) {
        $this->nom = $nom;
        // Validation de l'âge
        if ($age < 0) {
            throw new InvalidArgumentException("L'âge ne peut pas être négatif.");
        }
        $this->age = $age;
        $this->race = $race;
        $this->couleur = $couleur;
        $this->sexe = $sexe;
        $this->poids = $poids;
    }

    public function getNom() { return $this->nom; }
    public function getAge() { return $this->age; }
    public function getRace() { return $this->race; }
    public function getCouleur() { return $this->couleur; }
    public function getSexe() { return $this->sexe; }
    public function getPoids() { return $this->poids; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setAge($age) {
        if ($age < 0) {
            throw new InvalidArgumentException("L'âge ne peut pas être négatif.");
        }
        $this->age = $age;
    }
    public function setRace($race) { $this->race = $race; }
    public function setCouleur($couleur) { $this->couleur = $couleur; }
    public function setSexe($sexe) { $this->sexe = $sexe; }
    public function setPoids($poids) { $this->poids = $poids; }

    public function afficherDetails() {
        return "Nom: {$this->nom}, Âge: {$this->age} ans, Race: {$this->race}, Couleur: {$this->couleur}, Sexe: {$this->sexe}, Poids: {$this->poids}kg";
    }

    public function ageHumain() {
        return $this->age * 7;
    }

    public function crier() {
        return "{$this->nom} dit : Wouf Wouf !";
    }

    public function estEnSurpoids() {
        return $this->poids > 20;
    }
}
?>
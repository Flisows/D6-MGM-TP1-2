<?php
class Chenil {
    private $chiens;

    public function __construct() {
        if (!isset($_SESSION['chiens'])) {
            $_SESSION['chiens'] = [];
        }
        $this->chiens = &$_SESSION['chiens'];
    }

    public function ajouterChien(Chien $chien) {
        $this->chiens[$chien->getNom()] = $chien;
    }

    public function getChien($nom) {
        return isset($this->chiens[$nom]) ? $this->chiens[$nom] : null;
    }

    public function getTousChiens() {
        return $this->chiens;
    }

    public function mettreAJourChien($nom, $data) {
        if (isset($this->chiens[$nom])) {
            $chien = $this->chiens[$nom];
            $chien->setAge($data['age']);
            $chien->setRace($data['race']);
            $chien->setCouleur($data['couleur']);
            $chien->setSexe($data['sexe']);
            $chien->setPoids($data['poids']);
        }
    }

    public function supprimerChien($nom) {
        unset($this->chiens[$nom]);
    }

    public function rechercherChiens($nom) {
        $resultats = [];
        foreach ($this->chiens as $chien) {
            if (stripos($chien->getNom(), $nom) !== false) { 
                $resultats[$chien->getNom()] = $chien;
            }
        }
        return $resultats;
    }
}
?>
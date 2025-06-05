<?php
require_once 'Chenil.php';
require_once 'Chien.php';
require_once 'ChienDeChasse.php';

class ChienController {
    private $chenil;

    public function __construct() {
        $this->chenil = new Chenil();
    }

    public function listerChiens() {
        $chiens = $this->chenil->getTousChiens();
        include 'listeChiensView.php';
    }

    public function afficherChien($nom) {
        $chien = $this->chenil->getChien($nom);
        if ($chien) {
            include 'chienView.php';
        } else {
            header('Location: index.php');
        }
    }

    public function ajouterChien($data) {
        $error = null;
        $formData = $data; 
        try {
            if (!empty($data['nom']) && !empty($data['age']) && !empty($data['race']) && 
                !empty($data['couleur']) && !empty($data['sexe']) && !empty($data['poids'])) {
                $chien = isset($data['type']) && $data['type'] == 'chasse'
                    ? new ChienDeChasse($data['nom'], $data['age'], $data['race'], $data['couleur'], $data['sexe'], $data['poids'])
                    : new Chien($data['nom'], $data['age'], $data['race'], $data['couleur'], $data['sexe'], $data['poids']);
                $this->chenil->ajouterChien($chien);
                header('Location: index.php');
                return;
            } else {
                $error = "Tous les champs sont requis.";
            }
        } catch (InvalidArgumentException $e) {
            $error = $e->getMessage();
        }
        $chiens = $this->chenil->getTousChiens();
        include 'listeChiensView.php';
    }

    public function mettreAJourChien($nom, $data) {
        $error = null;
        $formData = $data; 
        try {
            if (!empty($data['age']) && !empty($data['race']) && !empty($data['couleur']) && 
                !empty($data['sexe']) && !empty($data['poids'])) {
                $this->chenil->mettreAJourChien($nom, $data);
                header('Location: index.php');
                return;
            } else {
                $error = "Tous les champs sont requis.";
            }
        } catch (InvalidArgumentException $e) {
            $error = $e->getMessage();
        }
        $chien = $this->chenil->getChien($nom);
        include 'chienView.php';
    }

    public function supprimerChien($nom) {
        $this->chenil->supprimerChien($nom);
        header('Location: index.php');
    }

    public function rechercherChiens($nom) {
        $chiens = $this->chenil->rechercherChiens($nom);
        include 'listeChiensView.php';
    }
}
?>
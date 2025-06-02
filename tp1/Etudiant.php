<?php

class Etudiant {
    private $nom;
    private $prenom;
    private $notes;

    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->notes = array();
    }

    public function ajouterNote($note) {
        $this->notes[] = $note;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function calculerMoyenne() {
        if (empty($this->notes)) {
            return 0;
        }
        return array_sum($this->notes) / count($this->notes);
    }

    public function afficherInformations() {
        echo "Nom: " . $this->nom . "\n";
        echo "Prénom: " . $this->prenom . "\n";
        echo "Notes: " . implode(", ", $this->notes) . "\n";
        echo "Moyenne: " . $this->calculerMoyenne() . "\n";
    }
}

class Classe {
    private $etudiants;

    public function __construct() {
        $this->etudiants = array();
    }

    public function ajouterEtudiant(Etudiant $etudiant) {
        $this->etudiants[] = $etudiant;
    }

    public function supprimerEtudiant($index) {
        if (isset($this->etudiants[$index])) {
            unset($this->etudiants[$index]);
            // Réindexer le tableau pour éviter les trous
            $this->etudiants = array_values($this->etudiants);
        }
    }

    public function afficherListeEtudiants() {
        foreach ($this->etudiants as $etudiant) {
            $etudiant->afficherInformations();
            echo "\n";
        }
    }
}

?>

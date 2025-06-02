<?php

class Produit {
    private $nom;
    private $prix;
    private $quantite;

    public function __construct($nom, $prix) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = 0;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function afficherProduit() {
        echo "Produit: " . $this->nom . ", Prix: " . $this->prix . " €\n";
    }

    public function ajouterAuPanier($quantite) {
        $this->quantite += $quantite;
    }

    public function getQuantite() {
        return $this->quantite;
    }
}

?>

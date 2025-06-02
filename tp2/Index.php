<?php

require_once 'Produit.php';

// Création de produits
$produit1 = new Produit("Livre", 20);
$produit2 = new Produit("Stylo", 5);
$produit3 = new Produit("Cahier", 10);

// Ajout de produits au panier
$produit1->ajouterAuPanier(2);
$produit2->ajouterAuPanier(4);
$produit3->ajouterAuPanier(1);

// Création du panier
$panier = [$produit1, $produit2, $produit3];

// Affichage des produits dans le panier
foreach ($panier as $produit) {
    $produit->afficherProduit();
    echo "Quantité: " . $produit->getQuantite() . "\n";
}

// Calcul du total des prix des produits dans le panier
$total = 0;
foreach ($panier as $produit) {
    $total += $produit->getPrix() * $produit->getQuantite();
}

echo "Le total des prix des produits dans le panier est : " . $total . " €\n";

?>

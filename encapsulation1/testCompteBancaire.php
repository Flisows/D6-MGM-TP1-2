<?php
require_once 'CompteBancaire.php';

$compte = new CompteBancaire("François Lisowski", 1000);

echo "Titulaire du compte : " . $compte->getTitulaire() . "\n";

$compte->depot(500);
echo "Solde après dépôt : " . $compte->afficherSolde() . "\n";

$compte->retrait(200);
echo "Solde après retrait : " . $compte->afficherSolde() . "\n";

$tauxInteret = 5; 
$interets = $compte->calculerInterets($tauxInteret);
echo "Intérêts calculés pour un taux de $tauxInteret% : $interets\n";
?>

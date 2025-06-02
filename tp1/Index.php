<?php

require_once 'Etudiant.php';

// Création d'étudiants
$etudiant1 = new Etudiant("Dupont", "Jean");
$etudiant2 = new Etudiant("Martin", "Marie");

// Ajout de notes
$etudiant1->ajouterNote(15);
$etudiant1->ajouterNote(18);
$etudiant1->ajouterNote(12);

$etudiant2->ajouterNote(14);
$etudiant2->ajouterNote(17);

// Affichage des informations des étudiants
$etudiant1->afficherInformations();
echo "\n";
$etudiant2->afficherInformations();

// Création d'une classe et ajout d'étudiants
$classe = new Classe();
$classe->ajouterEtudiant($etudiant1);
$classe->ajouterEtudiant($etudiant2);

// Affichage de la liste des étudiants dans la classe
$classe->afficherListeEtudiants();

// Suppression d'un étudiant
$classe->supprimerEtudiant(0);

// Affichage de la liste des étudiants après suppression
echo "\nAprès suppression :\n";
$classe->afficherListeEtudiants();

?>

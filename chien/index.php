<?php
require_once 'Animal.php';
require_once 'Chien.php';
require_once 'ChienDeChasse.php';
require_once 'Chenil.php';
require_once 'ChienController.php';

session_start();

// Routeur
$controller = new ChienController();

if (!isset($_GET['action'])) {
    $controller->listerChiens();
} else {
    switch ($_GET['action']) {
        case 'afficher':
            if (isset($_GET['nom'])) {
                $controller->afficherChien($_GET['nom']);
            }
            break;
        case 'ajouter':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->ajouterChien($_POST);
            }
            break;
        case 'modifier':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['nom'])) {
                $controller->mettreAJourChien($_GET['nom'], $_POST);
            }
            break;
        case 'supprimer':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
                $controller->supprimerChien($_POST['nom']);
            }
            break;
        case 'rechercher':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
                $controller->rechercherChiens($_POST['nom']);
            }
            break;
        default:
            $controller->listerChiens();
            break;
    }
}
?>
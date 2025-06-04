<?php
require_once 'TacheController.php';
require_once 'TacheVue.php';

$controller = new TacheController();
$vue = new TacheVue();

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'ajouter':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->ajouterTache($_POST['nom'], $_POST['description']);
                }
                break;
            case 'supprimer':
                if (isset($_GET['id'])) {
                    $controller->supprimerTache($_GET['id']);
                }
                break;
            case 'editer':
                if (isset($_GET['id'])) {
                    $tache = null;
                    foreach ($controller->getTaches() as $t) {
                        if ($t['id'] == $_GET['id']) {
                            $tache = $t;
                            break;
                        }
                    }
                    if ($tache) {
                        $vue->afficherFormulaireEdition($tache);
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->editerTache($_POST['id'], $_POST['nom'], $_POST['description']);
                }
                break;
        }
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de tâches</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestion de tâches</h1>
    <?php $vue->afficherFormulaireAjout(); ?>
    <h2>Liste des tâches</h2>
    <?php $vue->afficherTaches($controller->getTaches()); ?>
</body>
</html>

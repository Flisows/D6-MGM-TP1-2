<?php
require_once 'Project.php';

$projectId = isset($_GET['id']) ? intval($_GET['id']) : 0;

echo "<p>Projet supprimé avec succès!</p>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le Projet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Projet Supprimé</h1>
        <p>Le projet a été supprimé avec succès.</p>
        <a href="index.html">Retour à la liste des projets</a>
    </div>
</body>
</html>
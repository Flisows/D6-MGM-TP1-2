<?php
require_once 'Task.php';
require_once 'DevelopmentTask.php';
require_once 'DesignTask.php';
require_once 'Developer.php';
require_once 'TaskAlreadyCompletedException.php';

$taskId = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;

$task = new DevelopmentTask($taskId, 'Développer le panier', new Developer(1, 'Nom du Développeur', []), 20);

try {
    $task->completeTask();
    echo "<p>La tâche a été marquée comme complétée avec succès!</p>";
} catch (TaskAlreadyCompletedException $e) {
    echo "<p>Erreur: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tâche Complétée</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <a href="process.php" class="button">Retour à la liste des tâches</a>
    </div>
</body>
</html>

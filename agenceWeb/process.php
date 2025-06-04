<?php
require_once 'Project.php';
require_once 'Task.php';
require_once 'DevelopmentTask.php';
require_once 'DesignTask.php';
require_once 'Developer.php';
require_once 'Billable.php';

// Simulation : Création de 2 projets et 2 développeurs
$developer1 = new Developer(1, 'Alice', ['PHP', 'Symfony']);
$developer2 = new Developer(2, 'Bob', ['UX', 'Figma']);

$project1 = new Project(1, 'Site E-commerce', 'Client A', new DateTime('2023-01-01'), new DateTime('2023-12-31'));
$project2 = new Project(2, 'Application Mobile', 'Client B', new DateTime('2023-02-01'), null);

// Création et assignation des tâches
$task1 = new DevelopmentTask(1, 'Développer le panier', $developer1, 20);
$task2 = new DevelopmentTask(2, 'Implémenter API', $developer1, 15);
$task3 = new DesignTask(3, 'Maquette Homepage', $developer2, 'Figma');
$task4 = new DesignTask(4, 'Design Profil Utilisateur', $developer2, 'Photoshop');

$project1->addTask($task1);
$project1->addTask($task3);
$project2->addTask($task2);
$project2->addTask($task4);

$developer1->assignTask($task1);
$developer1->assignTask($task2);
$developer2->assignTask($task3);
$developer2->assignTask($task4);

// Gestion de la complétion des tâches
$errorMessage = '';
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_task'])) {
        $taskId = intval($_POST['task_id']);
        $found = false;
        foreach ([$project1, $project2] as $project) {
            foreach ($project->getTasks() as $task) {
                if ($task->getId() == $taskId) {
                    $task->completeTask();
                    $found = true;
                    break;
                }
            }
            if ($found) break;
        }
        if (!$found) {
            $errorMessage = "Tâche non trouvée.";
        }
    }
} catch (TaskAlreadyCompletedException $e) {
    $errorMessage = $e->getMessage();
}

// Traitement du formulaire d'ajout
$projectName = isset($_GET['project_name']) ? $_GET['project_name'] : 'Site E-commerce';
$clientName = isset($_GET['client_name']) ? $_GET['client_name'] : 'Client A';
$startDate = isset($_GET['start_date']) ? new DateTime($_GET['start_date']) : new DateTime('2023-01-01');
$endDate = isset($_GET['end_date']) && !empty($_GET['end_date']) ? new DateTime($_GET['end_date']) : new DateTime('2023-12-31');

$project = new Project(1, $projectName, $clientName, $startDate, $endDate);

// Calcul du coût total
$totalCost = 0;
foreach ($project1->getTasks() as $task) {
    if ($task instanceof Billable) {
        $totalCost += $task->calculateAmount();
    }
}
foreach ($project2->getTasks() as $task) {
    if ($task instanceof Billable) {
        $totalCost += $task->calculateAmount();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif du Projet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Récapitulatif des Projets</h1>
        <?php if (!empty($errorMessage)): ?>
            <script>alert('<?php echo addslashes(htmlspecialchars($errorMessage)); ?>');</script>
        <?php endif; ?>
        <h2>Projet 1: <?php echo htmlspecialchars($project1->getName()); ?></h2>
        <p><strong>Nom du Client:</strong> <?php echo htmlspecialchars($project1->getClientName()); ?></p>
        <p><strong>Date de Début:</strong> <?php echo $project1->getStartDate()->format('Y-m-d'); ?></p>
        <p><strong>Date de Fin:</strong> <?php echo $project1->getEndDate() ? $project1->getEndDate()->format('Y-m-d') : 'Non spécifiée'; ?></p>
        <p><strong>Avancement:</strong> <?php echo $project1->getProgress(); ?>%</p>

        <h3>Tâches</h3>
        <div class="task-list">
            <?php foreach ($project1->getTasks() as $task): ?>
                <div class="task-item <?php echo $task->isCompleted() ? 'completed' : ''; ?>">
                    <p><strong>Titre:</strong> <?php echo htmlspecialchars($task->getTitle()); ?></p>
                    <p><strong>Développeur:</strong> <?php echo htmlspecialchars($task->getAssignedTo()->getName()); ?></p>
                    <p><strong>Statut:</strong> <?php echo $task->isCompleted() ? 'Complétée' : 'En cours'; ?></p>
                    <form method="post">
                        <input type="hidden" name="task_id" value="<?php echo $task->getId(); ?>">
                        <button type="submit" name="complete_task">Marquer comme complétée</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Projet 2: <?php echo htmlspecialchars($project2->getName()); ?></h2>
        <p><strong>Nom du Client:</strong> <?php echo htmlspecialchars($project2->getClientName()); ?></p>
        <p><strong>Date de Début:</strong> <?php echo $project2->getStartDate()->format('Y-m-d'); ?></p>
        <p><strong>Date de Fin:</strong> <?php echo $project2->getEndDate() ? $project2->getEndDate()->format('Y-m-d') : 'Non spécifiée'; ?></p>
        <p><strong>Avancement:</strong> <?php echo $project2->getProgress(); ?>%</p>

        <h3>Tâches</h3>
        <div class="task-list">
            <?php foreach ($project2->getTasks() as $task): ?>
                <div class="task-item <?php echo $task->isCompleted() ? 'completed' : ''; ?>">
                    <p><strong>Titre:</strong> <?php echo htmlspecialchars($task->getTitle()); ?></p>
                    <p><strong>Développeur:</strong> <?php echo htmlspecialchars($task->getAssignedTo()->getName()); ?></p>
                    <p><strong>Statut:</strong> <?php echo $task->isCompleted() ? 'Complétée' : 'En cours'; ?></p>
                    <form method="post">
                        <input type="hidden" name="task_id" value="<?php echo $task->getId(); ?>">
                        <button type="submit" name="complete_task">Marquer comme complétée</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <p><strong>Coût Total des Tâches de Développement:</strong> <?php echo $totalCost; ?> €</p>

        <div class="buttons">
            <a href="index.html">Retour</a>
            <a href="edit.php?id=<?php echo $project1->getId(); ?>" class="edit-btn">Éditer Projet 1</a>
            <a href="delete.php?id=<?php echo $project1->getId(); ?>" class="delete-btn">Supprimer Projet 1</a>
            <a href="edit.php?id=<?php echo $project2->getId(); ?>" class="edit-btn">Éditer Projet 2</a>
            <a href="delete.php?id=<?php echo $project2->getId(); ?>" class="delete-btn">Supprimer Projet 2</a>
        </div>
    </div>
</body>
</html>
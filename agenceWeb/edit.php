<?php
require_once 'Project.php';
require_once 'Task.php';
require_once 'DevelopmentTask.php';
require_once 'DesignTask.php';
require_once 'Developer.php';
require_once 'Billable.php';

$projectId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$project = new Project($projectId, 'Nom du Projet', 'Nom du Client', new DateTime('2023-01-01'), new DateTime('2023-12-31'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectName = $_POST['project_name'];
    $clientName = $_POST['client_name'];
    $startDate = new DateTime($_POST['start_date']);
    $endDate = !empty($_POST['end_date']) ? new DateTime($_POST['end_date']) : null;
    header("Location: process.php?project_name=$projectName&client_name=$clientName&start_date=" . $startDate->format('Y-m-d') . "&end_date=" . ($endDate ? $endDate->format('Y-m-d') : ''));
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer le Projet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Éditer le Projet</h1>
        <form method="post" action="edit.php?id=<?php echo $project->getId(); ?>">
            <div class="form-group">
                <label for="project_name">Nom du Projet:</label>
                <input type="text" id="project_name" name="project_name" value="Nom du Projet" required>
            </div>
            <div class="form-group">
                <label for="client_name">Nom du Client:</label>
                <input type="text" id="client_name" name="client_name" value="Nom du Client" required>
            </div>
            <div class="form-group">
                <label for="start_date">Date de Début:</label>
                <input type="date" id="start_date" name="start_date" value="2023-01-01" required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de Fin:</label>
                <input type="date" id="end_date" name="end_date" value="2023-12-31">
            </div>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
<?php
class TacheVue {
    public function afficherTaches($taches) {
        echo '<ul>';
        foreach ($taches as $tache) {
            echo '<li>';
            echo '<strong>' . htmlspecialchars($tache['nom']) . '</strong>: ' . htmlspecialchars($tache['description']);
            echo ' <a href="index.php?action=supprimer&id=' . $tache['id'] . '">Supprimer</a>';
            echo ' <a href="index.php?action=editer&id=' . $tache['id'] . '">Éditer</a>';
            echo '</li>';
        }
        echo '</ul>';
    }

    public function afficherFormulaireAjout() {
        echo '<form method="post" action="index.php?action=ajouter">';
        echo '<label for="nom">Nom de la tâche :</label>';
        echo '<input type="text" id="nom" name="nom" required>';
        echo '<label for="description">Description :</label>';
        echo '<textarea id="description" name="description" required></textarea>';
        echo '<button type="submit">Ajouter</button>';
        echo '</form>';
    }

    // Nouvelle méthode pour afficher le formulaire d'édition
    public function afficherFormulaireEdition($tache) {
        echo '<form method="post" action="index.php?action=editer">';
        echo '<input type="hidden" name="id" value="' . $tache['id'] . '">';
        echo '<label for="nom">Nom de la tâche :</label>';
        echo '<input type="text" id="nom" name="nom" value="' . htmlspecialchars($tache['nom']) . '" required>';
        echo '<label for="description">Description :</label>';
        echo '<textarea id="description" name="description" required>' . htmlspecialchars($tache['description']) . '</textarea>';
        echo '<button type="submit">Mettre à jour</button>';
        echo '</form>';
    }
}
?>

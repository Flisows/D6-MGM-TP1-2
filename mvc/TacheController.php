<?php
class TacheController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['taches'])) {
            $_SESSION['taches'] = array();
        }
    }

    public function ajouterTache($nom, $description) {
        if (empty($nom) || empty($description)) {
            throw new Exception("Le nom et la description de la tâche ne peuvent pas être vides.");
        }
        $tache = array(
            'id' => uniqid(),
            'nom' => $nom,
            'description' => $description
        );
        $_SESSION['taches'][] = $tache;
    }

    public function getTaches() {
        return $_SESSION['taches'];
    }

    public function supprimerTache($id) {
        $_SESSION['taches'] = array_filter($_SESSION['taches'], function($tache) use ($id) {
            return $tache['id'] != $id;
        });
    }

    // Nouvelle méthode pour éditer une tâche
    public function editerTache($id, $nom, $description) {
        if (empty($nom) || empty($description)) {
            throw new Exception("Le nom et la description de la tâche ne peuvent pas être vides.");
        }
        foreach ($_SESSION['taches'] as &$tache) {
            if ($tache['id'] == $id) {
                $tache['nom'] = $nom;
                $tache['description'] = $description;
                return;
            }
        }
        throw new Exception("Aucune tâche trouvée avec l'ID spécifié.");
    }
}
?>

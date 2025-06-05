<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Chiens</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateForm(form) {
            const ageInput = form.querySelector('input[name="age"]');
            if (ageInput.value < 0) {
                alert("L'âge ne peut pas être négatif.");
                ageInput.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Liste des Chiens</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        
        <form action="index.php?action=rechercher" method="POST">
            <div class="form-group">
                <input type="text" name="nom" placeholder="Rechercher par nom">
                <button type="submit">Rechercher</button>
            </div>
        </form>

        <h2>Ajouter un chien</h2>
        <form action="index.php?action=ajouter" method="POST" onsubmit="return validateForm(this)">
            <div class="form-group">
                <input type="text" name="nom" placeholder="Nom" value="<?= isset($formData['nom']) ? htmlspecialchars($formData['nom']) : '' ?>" required>
                <input type="number" name="age" placeholder="Âge" min="0" value="<?= isset($formData['age']) ? htmlspecialchars($formData['age']) : '' ?>" required>
                <input type="text" name="race" placeholder="Race" value="<?= isset($formData['race']) ? htmlspecialchars($formData['race']) : '' ?>" required>
                <input type="text" name="couleur" placeholder="Couleur" value="<?= isset($formData['couleur']) ? htmlspecialchars($formData['couleur']) : '' ?>" required>
                <select name="sexe" required>
                    <option value="Mâle" <?= isset($formData['sexe']) && $formData['sexe'] == 'Mâle' ? 'selected' : '' ?>>Mâle</option>
                    <option value="Femelle" <?= isset($formData['sexe']) && $formData['sexe'] == 'Femelle' ? 'selected' : '' ?>>Femelle</option>
                    <option value="Non Binaire" <?= isset($formData['sexe']) && $formData['sexe'] == 'Mâle' ? 'selected' : '' ?>>Non Binaire</option>
                </select>
                <input type="number" name="poids" placeholder="Poids (kg)" value="<?= isset($formData['poids']) ? htmlspecialchars($formData['poids']) : '' ?>" required>
                <select name="type">
                    <option value="normal" <?= isset($formData['type']) && $formData['type'] == 'normal' ? 'selected' : '' ?>>Chien Normal</option>
                    <option value="chasse" <?= isset($formData['type']) && $formData['type'] == 'chasse' ? 'selected' : '' ?>>Chien de Chasse</option>
                </select>
                <button type="submit">Ajouter</button>
            </div>
        </form>

        <?php if (empty($chiens)): ?>
            <p>Aucun chien trouvé.</p>
        <?php else: ?>
            <?php foreach ($chiens as $chien): ?>
                <div class="chien-card">
                    <h3><?= htmlspecialchars($chien->getNom()) ?></h3>
                    <p><?= htmlspecialchars($chien->afficherDetails()) ?></p>
                    <p>Aboiement: <?= htmlspecialchars($chien->crier()) ?></p>
                    <p>Âge humain: <?= $chien->ageHumain() ?> ans</p>
                    <p><?= $chien->estEnSurpoids() ? "En surpoids" : "Poids normal" ?></p>
                    <a href="index.php?action=afficher&nom=<?= urlencode($chien->getNom()) ?>">Détails</a>
                    <form action="index.php?action=supprimer" method="POST" style="display: inline;">
                        <input type="hidden" name="nom" value="<?= htmlspecialchars($chien->getNom()) ?>">
                        <button type="submit" class="btn-danger">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
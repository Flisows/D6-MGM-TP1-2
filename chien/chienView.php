<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Chien</title>
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
        <h1>Détails de <?= htmlspecialchars($chien->getNom()) ?></h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <p><?= htmlspecialchars($chien->afficherDetails()) ?></p>
        <p>Aboiement: <?= htmlspecialchars($chien->crier()) ?></p>
        <p>Âge humain: <?= $chien->ageHumain() ?> ans</p>
        <p><?= $chien->estEnSurpoids() ? "En surpoids" : "Poids normal" ?></p>

        <h2>Modifier le chien</h2>
        <form action="index.php?action=modifier&nom=<?= urlencode($chien->getNom()) ?>" method="POST" onsubmit="return validateForm(this)">
            <div class="form-group">
                <input type="number" name="age" value="<?= isset($formData['age']) ? htmlspecialchars($formData['age']) : $chien->getAge() ?>" min="0" required>
                <input type="text" name="race" value="<?= isset($formData['race']) ? htmlspecialchars($formData['race']) : htmlspecialchars($chien->getRace()) ?>" required>
                <input type="text" name="couleur" value="<?= isset($formData['couleur']) ? htmlspecialchars($formData['couleur']) : htmlspecialchars($chien->getCouleur()) ?>" required>
                <select name="sexe" required>
                    <option value="Mâle" <?= (isset($formData['sexe']) && $formData['sexe'] == 'Mâle') || (!isset($formData['sexe']) && $chien->getSexe() == 'Mâle') ? 'selected' : '' ?>>Mâle</option>
                    <option value="Femelle" <?= (isset($formData['sexe']) && $formData['sexe'] == 'Femelle') || (!isset($formData['sexe']) && $chien->getSexe() == 'Femelle') ? 'selected' : '' ?>>Femelle</option>
                    <option value="Non Binaire" <?= (isset($formData['sexe']) && $formData['sexe'] == 'Non Binaire') || (!isset($formData['sexe']) && $chien->getSexe() == 'Non Binaire') ? 'selected' : '' ?>>Non Binaire</option>
                </select>
                <input type="number" name="poids" value="<?= isset($formData['poids']) ? htmlspecialchars($formData['poids']) : $chien->getPoids() ?>" required>
                <button type="submit">Mettre à jour</button>
            </div>
        </form>
        <a href="index.php">Retour à la liste</a>
    </div>
</body>
</html>
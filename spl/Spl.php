<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Effectuer un Paiement</h1>

<form method="post" action="">
    <div class="form-group">
        <label for="montant">Montant (en euros) :</label>
        <input type="number" step="0.01" id="montant" name="montant" required>
    </div>

    <div class="form-group">
        <label for="type_paiement">Type de Paiement :</label>
        <select id="type_paiement" name="type_paiement" required>
            <option value="">-- Sélectionnez un type de paiement --</option>
            <option value="cb">Carte Bancaire</option>
            <option value="paypal">PayPal</option>
            <option value="virement">Virement Bancaire</option>
        </select>
    </div>

    <button type="submit">Effectuer le Paiement</button>
</form>

<?php
// Classe abstraite Paiement
abstract class Paiement {
    protected $montant;

    public function __construct($montant) {
        $this->montant = $montant;
    }

    public function afficherMontant() {
        echo "<p>Montant à payer : " . $this->montant . " euros</p>";
    }

    abstract public function effectuerPaiement();
}

// Classe PaiementCB
class PaiementCB extends Paiement {
    public function effectuerPaiement() {
        echo "<p>Paiement par carte bancaire effectué.</p>";
    }
}

// Classe PaiementPaypal
class PaiementPaypal extends Paiement {
    public function effectuerPaiement() {
        echo "<p>Paiement via PayPal effectué.</p>";
    }
}

// Classe PaiementVirement
class PaiementVirement extends Paiement {
    public function effectuerPaiement() {
        echo "<p>Paiement par virement bancaire effectué.</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST['montant'];
    $typePaiement = $_POST['type_paiement'];

    switch ($typePaiement) {
        case 'cb':
            $paiement = new PaiementCB($montant);
            break;
        case 'paypal':
            $paiement = new PaiementPaypal($montant);
            break;
        case 'virement':
            $paiement = new PaiementVirement($montant);
            break;
        default:
            echo "<p>Type de paiement non valide.</p>";
            exit;
    }

    $paiement->afficherMontant();
    $paiement->effectuerPaiement();
}
?>

</body>
</html>

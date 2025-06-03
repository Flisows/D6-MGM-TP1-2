<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur d'Aire</title>
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
        input[type="number"], select {
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

<h1>Calculer l'Aire d'une Forme Géométrique</h1>

<form method="post" action="">
    <div class="form-group">
        <label for="forme">Forme Géométrique :</label>
        <select id="forme" name="forme" required>
            <option value="">-- Sélectionnez une forme --</option>
            <option value="cercle">Cercle</option>
            <option value="rectangle">Rectangle</option>
            <option value="triangle">Triangle</option>
            <option value="carre">Carré</option>
        </select>
    </div>

    <div class="form-group" id="dimensions">
        <!-- Les champs de dimensions seront ajoutés ici dynamiquement -->
    </div>

    <button type="submit">Calculer l'Aire</button>
</form>

<script>
    const formeSelect = document.getElementById('forme');
    const dimensionsDiv = document.getElementById('dimensions');

    formeSelect.addEventListener('change', function() {
        dimensionsDiv.innerHTML = '';

        const forme = this.value;
        let html = '';

        switch (forme) {
            case 'cercle':
                html = `
                    <label for="rayon">Rayon (cm) :</label>
                    <input type="number" step="any" id="rayon" name="rayon" required>
                `;
                break;
            case 'rectangle':
                html = `
                    <label for="longueur">Longueur (cm) :</label>
                    <input type="number" step="any" id="longueur" name="longueur" required>
                    <label for="largeur">Largeur (cm) :</label>
                    <input type="number" step="any" id="largeur" name="largeur" required>
                `;
                break;
            case 'triangle':
                html = `
                    <label for="cote1">Côté 1 (cm) :</label>
                    <input type="number" step="any" id="cote1" name="cote1" required>
                    <label for="cote2">Côté 2 (cm) :</label>
                    <input type="number" step="any" id="cote2" name="cote2" required>
                    <label for="cote3">Côté 3 (cm) :</label>
                    <input type="number" step="any" id="cote3" name="cote3" required>
                `;
                break;
            case 'carre':
                html = `
                    <label for="cote">Côté (cm) :</label>
                    <input type="number" step="any" id="cote" name="cote" required>
                `;
                break;
        }

        dimensionsDiv.innerHTML = html;
    });
</script>

<?php
abstract class FormeGeometrique {
    abstract public function calculerAire();
}

class Cercle extends FormeGeometrique {
    private $rayon;

    public function __construct($rayon) {
        $this->rayon = $rayon;
    }

    public function calculerAire() {
        return pi() * $this->rayon * $this->rayon;
    }
}

class Rectangle extends FormeGeometrique {
    private $longueur;
    private $largeur;

    public function __construct($longueur, $largeur) {
        $this->longueur = $longueur;
        $this->largeur = $largeur;
    }

    public function calculerAire() {
        return $this->longueur * $this->largeur;
    }
}

class Triangle extends FormeGeometrique {
    private $cote1;
    private $cote2;
    private $cote3;

    public function __construct($cote1, $cote2, $cote3) {
        $this->cote1 = $cote1;
        $this->cote2 = $cote2;
        $this->cote3 = $cote3;
    }

    public function calculerAire() {
        $s = ($this->cote1 + $this->cote2 + $this->cote3) / 2;
        return sqrt($s * ($s - $this->cote1) * ($s - $this->cote2) * ($s - $this->cote3));
    }
}

class Carre extends FormeGeometrique {
    private $cote;

    public function __construct($cote) {
        $this->cote = $cote;
    }

    public function calculerAire() {
        return $this->cote * $this->cote;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forme = $_POST['forme'];
    $aire = 0;
    $nomForme = "";

    switch ($forme) {
        case 'cercle':
            $rayon = $_POST['rayon'];
            $formeObj = new Cercle($rayon);
            $nomForme = "Cercle";
            break;
        case 'rectangle':
            $longueur = $_POST['longueur'];
            $largeur = $_POST['largeur'];
            $formeObj = new Rectangle($longueur, $largeur);
            $nomForme = "Rectangle";
            break;
        case 'triangle':
            $cote1 = $_POST['cote1'];
            $cote2 = $_POST['cote2'];
            $cote3 = $_POST['cote3'];
            $formeObj = new Triangle($cote1, $cote2, $cote3);
            $nomForme = "Triangle";
            break;
        case 'carre':
            $cote = $_POST['cote'];
            $formeObj = new Carre($cote);
            $nomForme = "Carré";
            break;
        default:
            echo "<p>Forme non valide.</p>";
            exit;
    }

    $aire = $formeObj->calculerAire();
    echo "<p>L'aire du " . $nomForme . " est : " . number_format($aire, 2) . " cm²</p>";
}
?>

</body>
</html>

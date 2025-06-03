<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Virtuel</title>
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
        .animal {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Zoo Virtuel</h1>

<form method="post" action="">
    <div class="form-group">
        <label for="type_animal">Type d'animal :</label>
        <select id="type_animal" name="type_animal" required>
            <option value="">-- Sélectionnez un type d'animal --</option>
            <option value="chien">Chien</option>
            <option value="chat">Chat</option>
            <option value="oiseau">Oiseau</option>
            <option value="tyrannosaure">Tyrannosaure</option>
        </select>
    </div>

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
    </div>

    <div class="form-group">
        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" required>
    </div>

    <div class="form-group" id="caracteristique">
        <!-- Les champs spécifiques seront ajoutés ici dynamiquement -->
    </div>

    <button type="submit">Créer l'animal</button>
</form>

<script>
    const typeAnimalSelect = document.getElementById('type_animal');
    const caracteristiqueDiv = document.getElementById('caracteristique');

    typeAnimalSelect.addEventListener('change', function() {
        const typeAnimal = this.value;
        let html = '';

        switch (typeAnimal) {
            case 'chien':
                html = `
                    <label for="race">Race :</label>
                    <input type="text" id="race" name="race" required>
                `;
                break;
            case 'chat':
                html = `
                    <label for="couleur">Couleur :</label>
                    <input type="text" id="couleur" name="couleur" required>
                `;
                break;
            case 'oiseau':
                html = `
                    <label for="espece">Espèce :</label>
                    <input type="text" id="espece" name="espece" required>
                `;
                break;
            case 'tyrannosaure':
                html = `
                    <label for="taille">Taille (en mètres) :</label>
                    <input type="number" step="any" id="taille" name="taille" required>
                `;
                break;
        }

        caracteristiqueDiv.innerHTML = html;
    });
</script>

<?php
class Animal {
    protected $nom;
    protected $age;

    public function __construct($nom, $age) {
        $this->nom = $nom;
        $this->age = $age;
    }

    public function decrire() {
        return "Je suis un animal nommé " . $this->nom . ", j'ai " . $this->age . " ans.";
    }
}

class Chien extends Animal {
    private $race;

    public function __construct($nom, $age, $race) {
        parent::__construct($nom, $age);
        $this->race = $race;
    }

    public function decrire() {
        return parent::decrire() . " Je suis un chien de race " . $this->race . ".";
    }

    public function crier() {
        return "Wouf!";
    }
}

class Chat extends Animal {
    private $couleur;

    public function __construct($nom, $age, $couleur) {
        parent::__construct($nom, $age);
        $this->couleur = $couleur;
    }

    public function decrire() {
        return parent::decrire() . " Je suis un chat de couleur " . $this->couleur . ".";
    }

    public function crier() {
        return "Miaou!";
    }
}

class Oiseau extends Animal {
    private $espece;

    public function __construct($nom, $age, $espece) {
        parent::__construct($nom, $age);
        $this->espece = $espece;
    }

    public function decrire() {
        return parent::decrire() . " Je suis un oiseau de l'espèce " . $this->espece . ".";
    }

    public function crier() {
        return "Cui-cui!";
    }
}

class Tyrannosaure extends Animal {
    private $taille;

    public function __construct($nom, $age, $taille) {
        parent::__construct($nom, $age);
        $this->taille = $taille;
    }

    public function decrire() {
        return parent::decrire() . " Je suis un Tyrannosaure de " . $this->taille . " mètres de long.";
    }

    public function crier() {
        return "Je n'aime pas les météorites !";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $typeAnimal = $_POST['type_animal'];

    switch ($typeAnimal) {
        case 'chien':
            $race = $_POST['race'];
            $animal = new Chien($nom, $age, $race);
            break;
        case 'chat':
            $couleur = $_POST['couleur'];
            $animal = new Chat($nom, $age, $couleur);
            break;
        case 'oiseau':
            $espece = $_POST['espece'];
            $animal = new Oiseau($nom, $age, $espece);
            break;
        case 'tyrannosaure':
            $taille = $_POST['taille'];
            $animal = new Tyrannosaure($nom, $age, $taille);
            break;
        default:
            echo "<p>Type d'animal non valide.</p>";
            exit;
    }

    echo "<div class='animal'><p>" . $animal->decrire() . "</p>";
    echo "<p>Il/Elle dit : " . $animal->crier() . "</p></div>";
}
?>

</body>
</html>

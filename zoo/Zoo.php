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

$animaux = [
    new Chien("Rex", 5, "Labrador"),
    new Chat("Misty", 3, "Noire"),
    new Oiseau("Piaf", 2, "Canari")
];

foreach ($animaux as $animal) {
    echo $animal->decrire() . "\n";
    echo $animal->crier() . "\n\n";
}

?>

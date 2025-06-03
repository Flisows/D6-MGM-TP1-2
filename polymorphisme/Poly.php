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

class CalculateurAire {
    public function calculerAireTotale($formes) {
        $aireTotale = 0;
        foreach ($formes as $forme) {
            $aireTotale += $forme->calculerAire();
        }
        return $aireTotale;
    }
}

$cercle = new Cercle(5);
$rectangle = new Rectangle(4, 6);
$triangle = new Triangle(3, 4, 5);
$carre = new Carre(4);

$formes = [$cercle, $rectangle, $triangle, $carre];

foreach ($formes as $forme) {
    echo "Aire: " . $forme->calculerAire() . "\n";
}

$calculateur = new CalculateurAire();
$aireTotale = $calculateur->calculerAireTotale($formes);
echo "Aire totale de toutes les formes: " . $aireTotale . "\n";

?>

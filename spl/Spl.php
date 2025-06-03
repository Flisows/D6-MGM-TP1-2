<?php

abstract class Paiement {
    protected $montant;

    public function __construct($montant) {
        $this->montant = $montant;
    }

    public function afficherMontant() {
        echo "Montant à payer : " . $this->montant . " euros\n";
    }

    abstract public function effectuerPaiement();
}

class PaiementCB extends Paiement {
    public function effectuerPaiement() {
        echo "Paiement par carte bancaire effectué.\n";
    }
}

class PaiementPaypal extends Paiement {
    public function effectuerPaiement() {
        echo "Paiement via PayPal effectué.\n";
    }
}

class PaiementVirement extends Paiement {
    public function effectuerPaiement() {
        echo "Paiement par virement bancaire effectué.\n";
    }
}

$paiements = [
    new PaiementCB(100.50),
    new PaiementPaypal(75.25),
    new PaiementVirement(200.00)
];

foreach ($paiements as $paiement) {
    $paiement->afficherMontant();
    $paiement->effectuerPaiement();
    echo "\n";
}

?>

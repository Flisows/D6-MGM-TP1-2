<?php
class CompteBancaire {
    private $solde;
    private $titulaire;

    public function __construct($titulaire, $soldeInitial) {
        $this->titulaire = $titulaire;
        $this->solde = $soldeInitial;
    }

    public function depot($montant) {
        if ($montant > 0) {
            $this->solde += $montant;
            return true;
        } else {
            return false;
        }
    }

    public function retrait($montant) {
        if ($montant > 0 && $montant <= $this->solde) {
            $this->solde -= $montant;
            return true;
        } else {
            return false;
        }
    }

    public function afficherSolde() {
        return $this->solde;
    }

    public function getTitulaire() {
        return $this->titulaire;
    }

    public function calculerInterets($tauxAnnuel) {
        $interets = $this->solde * ($tauxAnnuel / 100);
        return $interets;
    }
}
?>

<?php
require_once 'Chien.php';

class ChienDeChasse extends Chien implements Animal {
    public function crier() {
        return "{$this->getNom()} dit : La chasse à courre, c'est de la merde, et en plus ils m'affament avant de me faire traquer un cerf qu'ils vont meme pas bouffer ces connards ! Si vous voulez mon avis, c'est eux et leurs familles de consanguins qui se prennent pour des nobles qu'on devrait traquer et empailler.";
    }
}
?>
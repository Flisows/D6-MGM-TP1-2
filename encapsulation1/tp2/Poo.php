<?php
class Contact {
    private $nom;
    private $prenom;
    private $email;

    public function __construct($nom, $prenom, $email) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }
}

$contact1 = new Contact('Dupont', 'Alice', 'alice@example.com');
$contact2 = new Contact('Martin', 'Bob', 'bob@example.com');

echo "Nom: " . $contact1->getNom() . "\n";
echo "Prénom: " . $contact1->getPrenom() . "\n";
echo "Email: " . $contact1->getEmail() . "\n\n";

echo "Nom: " . $contact2->getNom() . "\n";
echo "Prénom: " . $contact2->getPrenom() . "\n";
echo "Email: " . $contact2->getEmail() . "\n";
?>

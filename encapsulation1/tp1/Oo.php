<?php
// Création des contacts sous forme de tableaux associatifs
$contact1 = [
    'Nom' => 'Dupont',
    'Prénom' => 'Alice',
    'Email' => 'alice@example.com'
];

$contact2 = [
    'Nom' => 'Martin',
    'Prénom' => 'Bob',
    'Email' => 'bob@example.com'
];

// Création d'un tableau pour stocker les contacts
$listeContacts = [$contact1, $contact2];

// Affichage des informations de chaque contact
foreach ($listeContacts as $contact) {
    echo "Nom: " . $contact['Nom'] . "\n";
    echo "Prénom: " . $contact['Prénom'] . "\n";
    echo "Email: " . $contact['Email'] . "\n\n";
}
?>

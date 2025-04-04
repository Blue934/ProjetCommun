<?php

require_once 'vendor/autoload.php';

use MongoDB\Client;
use Faker\Factory;

$faker = Factory::create();

// Connexion à MongoDB
$client = new Client("mongodb://localhost:27017");
$db = $client->selectDatabase("mydatabase");
$collection = $db->selectCollection("myCollection");

// Dossier contenant les images
$imageDirectory = __DIR__ . '/public/uploads'; // Dossier contenant les images
$imageFiles = array_values(array_diff(scandir($imageDirectory), ['.', '..'])); // Liste des fichiers images (sans '.' et '..')

// Vérification : Aucune image disponible dans le répertoire
if (empty($imageFiles)) {
    die("Aucune image disponible dans le dossier 'uploads'. Ajoutez des fichiers images avant de lancer ce script.\n");
}

$data = [];

// Générer plusieurs utilisateurs avec plusieurs images
for ($i = 0; $i < 100; $i++) { // Par exemple, créer 100 utilisateurs
    // Sélection aléatoire de photos pour l'utilisateur
    $userPhotos = [];
    $maxPhotos = rand(1, 5); // Chaque utilisateur peut avoir entre 1 et 5 photos
    for ($j = 0; $j < $maxPhotos; $j++) {
        $userPhotos[] = $imageFiles[array_rand($imageFiles)]; // Sélectionner une image aléatoire
    }

    // Génération des données utilisateur
    $data[] = [
        'name' => $faker->name, // Nom aléatoire
        'city' => $faker->city, // Ville aléatoire
        'images' => $userPhotos, // Tableau contenant les chemins des images
        'password' => password_hash($faker->password, PASSWORD_BCRYPT), // Mot de passe sécurisé avec hashage
        'likes' => 0, // Champ des likes initialisé à 0
        'comments' => [], // Champ pour les commentaires, initialisé comme tableau vide
        'createdAt' => date('Y-m-d H:i:s'), // Date actuelle formatée
    ];
}

// Insérer les données dans la base MongoDB
$collection->insertMany($data);

echo count($data) . " utilisateurs insérés avec succès dans MongoDB !\n";
<?php

namespace App\Service;

use MongoDB\Client;

class MongoDBManager {
    private $client;

    public function __construct() {
        $this->client = new Client("mongodb://127.0.0.1:27017"); // Connexion au serveur MongoDB
    }

    public function getDatabase(string $dbName) {
        return $this->client->selectDatabase($dbName); // Accéder à une base de données
    }
}
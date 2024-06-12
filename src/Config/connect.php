<?php
namespace App;

require 'vendor/autoload.php'; // Include Composer's autoloader

use MongoDB\Client;

// Create a MongoDB client instance
$client = new Client("mongodb://localhost:27017");

$db = $client->selectDatabase('game-db'); // Replace 'my_database' with your database name

$collection = $db->selectCollection('games'); // Replace 'my_collection' with your collection name
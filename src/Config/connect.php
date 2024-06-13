<?php
namespace App;

require __DIR__ . '/../../vendor/autoload.php'; // Include Composer's autoloader

use MongoDB\Client;
use Throwable;

class Database
{
    private static $db;

    public static function connect()
    {
        if (!self::$db) {
            try {
                // Create a MongoDB client instance
                $client = new Client("mongodb://localhost:27017");

                // Select the database and store it in the static property
                self::$db = $client->selectDatabase('game-db'); // Replace 'game-db' with your database name
            } catch (Throwable $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$db;
    }
}

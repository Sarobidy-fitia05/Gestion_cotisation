<?php

require_once __DIR__ . "/config/database.php";
Use config\Database;

$database = new Database();
$db = $database->connection();

if ($db) {
    echo "Connexion réussie ✅";
} else {
    echo "Connexion échouée ❌";
}
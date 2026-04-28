<?php

require_once "../config/database.php";

header("Content-Type: application/json");

$database = new Database();
$db = $database->connect();

$query = "SELECT * FROM members";
$stmt = $db->prepare($query);
$stmt->execute();

$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($members);
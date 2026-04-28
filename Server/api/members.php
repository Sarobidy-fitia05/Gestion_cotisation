<?php

require_once "../config/database.php";

header("Content-Type: application/json");

$database = new Database();
$db = $database->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $query = "SELECT * FROM members";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($members);

}
if ($method  === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (
        !isset($data->nom) || 
        !isset($data->prenom) ||
        !isset($data->telephone) ||
        !isset($data->adresse) ||
        !isset($data->poste)
    ) {
        echo json_encode([
            "message"=>"donnée incompètes"
        ]);
        exit;
    }
    $query = "INSERT INTO members (nom, prenom, telephone, adresse, poste) VALUES (:nom, :prenom, :telephone, :adresse, :poste)";

    $stmt = $db->prepare($query);

    $stmt->bindParam("nom", $data->nom);
    $stmt->bindParam("prenom", $data->prenom);
    $stmt->bindParam("telephone", $data->telephone);
    $stmt->bindParam("adresse", $data->adresse);
    $stmt->bindParam("poste", $data->poste);

    if ($stmt->execute()) {
        echo json_encode([
            "message" => "membre ajouté avec succès"
        ]);
    } else{
        echo json_encode([
            "message" => "Erreur lors de l'ajout"
        ]);
    }
}
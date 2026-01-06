<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$user = "root";
$passwordDb = "";
$database = "db_hemat_energi";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $passwordDb);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo json_encode(
 [
            "success" => false,
            "message" => "Database Error : " . $e->getMessage()
        ]
    );
}

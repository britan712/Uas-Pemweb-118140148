<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connection.php';

// Menampilkan data by id dari database
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $dataFromDB = $database->getDataById($id);
    echo json_encode($dataFromDB);
    exit();
}

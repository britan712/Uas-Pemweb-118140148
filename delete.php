<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connection.php';

// Menghapus data dari database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if ($database->deleteData($id)) {
        echo "Data deleted successfully.";
    } else {
        echo "Error deleting data.";
    }
}

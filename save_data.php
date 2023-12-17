<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connection.php';

// Menampilkan semua data dari database
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $dataFromDB = $database->ambilData();
    echo json_encode($dataFromDB);
    exit();
}

// Menyimpan data ke database (insert)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $attendance = isset($_POST['attendance']) ? ($_POST['attendance'] == '1') : "0";
    $grade = $_POST['grade'];
    $userAgent = $_POST['userAgent'];
    $userIP = $_POST['userIP'];

    if ($database->insertData($name, $subject, $attendance, $grade, $userAgent, $userIP)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data.";
    }
}

<?php

// update_data.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connection.php';

// Menyimpan data ke database (update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $attendance = isset($_POST['attendance']) ? ($_POST['attendance'] == '1') : "0";
    $grade = $_POST['grade'];

    if ($database->updateData($id, $name, $subject, $attendance, $grade)) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data.";
    }
}

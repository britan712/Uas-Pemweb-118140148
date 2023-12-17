<?php
require_once '../db_connection.php';

$database = new Database();
$result = $database->logout();

header('Content-Type: application/json');
echo json_encode($result);

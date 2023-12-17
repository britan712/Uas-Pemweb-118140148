<?php
require_once "user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    $user = new User();
    $result = $user->register($data);

    echo json_encode($result);
}
?>

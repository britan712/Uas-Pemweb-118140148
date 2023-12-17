<?php
require_once "user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    $user = new User();
    $userId = $user->login($data->username, $data->password);

    if ($userId) {
        $token = md5(uniqid($userId, true));

        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $data->username;
        $_SESSION['token'] = $token;

        echo json_encode(['success' => true, 'token' => $token]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>

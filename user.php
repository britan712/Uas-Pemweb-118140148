<?php
require_once "../db_connection.php";

class User extends Database {
    public function login($username, $password) {
        $hashedPassword = sha1($password);
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user['id'];
        } else {
            return false;
        }
    }
}
?>

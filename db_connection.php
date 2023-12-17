<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "123123123";
    private $dbname = "uas_britan";

    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insertData($name, $subject, $attendance, $grade, $userAgent, $userIP) {
        $stmt = $this->conn->prepare("INSERT INTO education_data (name, subject, attendance, grade, user_agent, user_ip) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $subject, $attendance, $grade, $userAgent, $userIP);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }

    public function ambilData() {
        $result = $this->conn->query("SELECT * FROM education_data ORDER BY id DESC");
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function updateData($id, $name, $subject, $attendance, $grade) {
        $stmt = $this->conn->prepare("UPDATE education_data SET name=?, subject=?, attendance=?, grade=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $subject, $attendance, $grade, $id);

        return $stmt->execute();
    }

    public function getDataById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM education_data WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function deleteData($id) {
        $stmt = $this->conn->prepare("DELETE FROM education_data WHERE id=?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function register($data) {
        $username = $data->username;
        $password = sha1($data->password);

        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Registration successful.'];
        } else {
            return ['success' => false, 'message' => 'Registration failed.'];
        }
    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();

        return ['success' => true, 'message' => 'Logout successful.'];
    }
}

$database = new Database();

?>

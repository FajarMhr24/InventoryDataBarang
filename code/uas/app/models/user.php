<?php
class User {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && $password == $user['password']) {
            return $user;
        }
        return false;
    }
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFoto($id, $namaFile) {
        $sql = "UPDATE users SET foto = :foto WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':foto', $namaFile);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

} 
?>

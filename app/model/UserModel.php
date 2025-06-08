<?php
require_once "Database.php";

class UserModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getUserByUsername($username) {
        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
    public function getAllUsers() {
        $stmt = $this->pdo->prepare("SELECT id, username, email, role FROM users"); // Adaptez selon la structure de votre table.
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
}
?>

<?php
// classes/User.php

require_once 'Database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function register($naam, $email, $wachtwoord) {
        $hashed = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO gebruikers (naam, email, wachtwoord) VALUES (?, ?, ?)");
        return $stmt->execute([$naam, $email, $hashed]);
    }

    public function login($email, $wachtwoord) {
        $stmt = $this->pdo->prepare("SELECT * FROM gebruikers WHERE email = ?");
        $stmt->execute([$email]);
        $gebruiker = $stmt->fetch();

        if ($gebruiker && password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
            $_SESSION['user_id'] = $gebruiker['id'];
            return true;
        }

        return false;
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM gebruikers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}

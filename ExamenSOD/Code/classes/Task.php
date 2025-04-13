<?php
// classes/Task.php

require_once 'Database.php';

class Task {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM taken WHERE gebruiker_id = ? ORDER BY deadline ASC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function create($titel, $beschrijving, $deadline, $userId) {
        $stmt = $this->pdo->prepare("INSERT INTO taken (titel, beschrijving, deadline, gebruiker_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$titel, $beschrijving, $deadline, $userId]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM taken WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $titel, $beschrijving, $deadline, $status) {
        $stmt = $this->pdo->prepare("UPDATE taken SET titel = ?, beschrijving = ?, deadline = ?, status = ? WHERE id = ?");
        return $stmt->execute([$titel, $beschrijving, $deadline, $status, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM taken WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function toggleStatus($id, $nieuweStatus) {
        $stmt = $this->pdo->prepare("UPDATE taken SET status = ? WHERE id = ?");
        return $stmt->execute([$nieuweStatus, $id]);
    }

    public function DeadlineSort(){
        $stmt = $this->pdo->prepare("SELECT*From taken ORDER BY deadline");
    }

     public function getByStatus($userId, $status) {
        $stmt = $this->pdo->prepare("SELECT * FROM taken WHERE gebruiker_id = ? AND status = ? ORDER BY deadline ASC");
        $stmt->execute([$userId, $status]);
        return $stmt->fetchAll();
    }
    
}

<?php
require_once __DIR__ . "/Database.php";

class Service {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($title, $desc, $img) {
        $sql = "INSERT INTO services (title, description, image) VALUES (:title, :description, :image)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':description' => $desc,
            ':image' => $img
        ]);
    }

    public function readAll() {
        $sql = "SELECT * FROM services ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $sql = "SELECT * FROM services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($keyword) {
        $sql = "SELECT * FROM services 
                WHERE title LIKE :keyword OR description LIKE :keyword
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':keyword' => '%' . $keyword . '%'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $desc) {
        $sql = "UPDATE services SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $desc
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
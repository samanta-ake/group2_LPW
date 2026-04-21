<?php

class Database {

    private $host = "localhost";
    private $dbname = "webdev_project";
    private $username = "root";
    private $password = "";
    private $connection;

    public function connect() {
        if ($this->connection === null) {
            try {
                $this->connection = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname}",
                    $this->username,
                    $this->password
                );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("DB Error: " . $e->getMessage());
            }
        }

        return $this->connection;
    }
}
<?php

$host = "localhost";
$dbname = "webdev_project";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        description TEXT,
        image VARCHAR(255)
    )";

    $sql2 = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100),
        email VARCHAR(255),
        password VARCHAR(255)
    )";

    $pdo->exec($sql1);
    $pdo->exec($sql2);

    echo "Tables created!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
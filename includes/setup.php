<?php

require_once "includes/db.php";

try {

    $sql1 = "CREATE TABLE IF NOT EXISTS services (

        id INT AUTO_INCREMENT PRIMARY KEY,

        title VARCHAR(255) NOT NULL,

        description TEXT NOT NULL,

        image VARCHAR(255) NOT NULL

    )";

    $sql2 = "CREATE TABLE IF NOT EXISTS users (

        id INT AUTO_INCREMENT PRIMARY KEY,

        username VARCHAR(100) NOT NULL,

        email VARCHAR(255) UNIQUE NOT NULL,

        password VARCHAR(255) NOT NULL,

        role ENUM('user', 'admin') DEFAULT 'user',

        last_visit DATETIME NULL

    )";

    $sql3 = "CREATE TABLE IF NOT EXISTS messages (

        id INT AUTO_INCREMENT PRIMARY KEY,

        name VARCHAR(100) NOT NULL,

        email VARCHAR(255) NOT NULL,

        message TEXT NOT NULL,

        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    )";

    $pdo->exec($sql1);
    $pdo->exec($sql2);
    $pdo->exec($sql3);

    echo "Tables created successfully!";

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
}
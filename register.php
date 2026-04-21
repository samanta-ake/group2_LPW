<?php
require_once "includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($email) && !empty($password)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ":username" => $username,
                ":email" => $email,
                ":password" => $hashedPassword
            ]);

            $message = "Registration successful!";
        } catch (PDOException $e) {
            $message = "Error: email already exists.";
        }

    } else {
        $message = "All fields required.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Register</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    Username:<br>
    <input type="text" name="username"><br><br>

    Email:<br>
    <input type="email" name="email"><br><br>

    Password:<br>
    <input type="password" name="password"><br><br>

    <button type="submit">Register</button>
</form>

<a href="login.php">Go to Login</a>

</body>
</html>
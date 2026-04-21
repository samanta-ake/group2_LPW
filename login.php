<?php
session_start();
require_once "includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["username"] = $user["username"];

        setcookie("username", $user["username"], time() + 86400, "/");

        header("Location: index.php");
        exit();

    } else {
        $message = "Wrong login!";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    Email:<br>
    <input type="email" name="email"><br><br>

    Password:<br>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>

<a href="register.php">Go to Register</a>

</body>
</html>
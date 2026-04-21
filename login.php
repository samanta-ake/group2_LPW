<?php
session_start();
require_once "includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["welcome_message"] = "Welcome back, " . $user["username"] . "!";

        if (!empty($user["last_visit"])) {
            $_SESSION["previous_visit"] = $user["last_visit"];
        }

        $currentTime = date("Y-m-d H:i:s");

        $updateSql = "UPDATE users SET last_visit = :last_visit WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ":last_visit" => $currentTime,
            ":id" => $user["id"]
        ]);

        setcookie("username", $user["username"], time() + (86400 * 30), "/");

        header("Location: index.php");
        exit();
    } else {
        $message = "Wrong login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST">
    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<a href="register.php">Go to Register</a>

</body>
</html>
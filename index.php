<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    <?php if (isset($_COOKIE["username"])): ?>
        <p>Welcome back, <?php echo htmlspecialchars($_COOKIE["username"]); ?>!</p>
    <?php endif; ?>

    <?php if (isset($_SESSION["username"])): ?>
        <p>You are logged in as <?php echo htmlspecialchars($_SESSION["username"]); ?></p>

        <a href="dashboard.php">Dashboard</a><br>
        <a href="services.php">Services</a><br>
        <a href="contact.php">Contact</a><br>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a><br>
        <a href="login.php">Login</a><br>
        <a href="contact.php">Contact</a>
    <?php endif; ?>
</body>
</html>
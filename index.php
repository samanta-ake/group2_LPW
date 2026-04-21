<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    <?php if (isset($_SESSION["welcome_message"])): ?>
        <p><?php echo htmlspecialchars($_SESSION["welcome_message"]); ?></p>
        <?php unset($_SESSION["welcome_message"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["username"])): ?>
        <?php if (isset($_SESSION["previous_visit"])): ?>
            <p>
                Welcome back, <?php echo htmlspecialchars($_SESSION["username"]); ?>!<br>
                Last visit: <?php echo htmlspecialchars($_SESSION["previous_visit"]); ?>
            </p>
            <?php unset($_SESSION["previous_visit"]); ?>
        <?php elseif (isset($_COOKIE["username"])): ?>
            <p>Welcome back, <?php echo htmlspecialchars($_COOKIE["username"]); ?>!</p>
        <?php endif; ?>

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
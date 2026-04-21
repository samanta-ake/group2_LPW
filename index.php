<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<h1>Home</h1>

<?php if (isset($_COOKIE["username"])): ?>
    <p>Welcome back, <?php echo $_COOKIE["username"]; ?>!</p>
<?php endif; ?>

<?php if (isset($_SESSION["username"])): ?>
    <p>You are logged in as <?php echo $_SESSION["username"]; ?></p>
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="register.php">Register</a><br>
    <a href="login.php">Login</a>
<?php endif; ?>

</body>
</html>
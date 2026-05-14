<?php
require_once "includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

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


require_once "includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow p-4">

            <h2 class="mb-4">Register</h2>

            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <button type="submit"
                        class="btn btn-success w-100">
                    Register
                </button>

            </form>

            <div class="mt-3 text-center">
                <a href="login.php">
                    Go to Login
                </a>
            </div>

        </div>

    </div>
</div>

<?php require_once "includes/footer.php"; ?>
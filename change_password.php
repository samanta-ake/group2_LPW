<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $current = trim($_POST["current_password"]);
    $new = trim($_POST["new_password"]);
    $confirm = trim($_POST["confirm_password"]);

    if ($new !== $confirm) {
        $message = "Passwords do not match.";
    } else {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u");
        $stmt->execute([":u" => $_SESSION["username"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($current, $user["password"])) {

            $hash = password_hash($new, PASSWORD_DEFAULT);

            $update = $pdo->prepare("
                UPDATE users 
                SET password = :p 
                WHERE id = :id
            ");

            $update->execute([
                ":p" => $hash,
                ":id" => $user["id"]
            ]);

            $message = "Password successfully changed!";
        } else {
            $message = "Current password is incorrect.";
        }
    }
}

require_once "includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow p-4">

            <h3 class="mb-3">Change Password</h3>

            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <input type="password" name="current_password" class="form-control mb-2" placeholder="Current password" required>
                <input type="password" name="new_password" class="form-control mb-2" placeholder="New password" required>
                <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm password" required>

                <button class="btn btn-primary w-100">
                    Change Password
                </button>

            </form>

        </div>

    </div>
</div>

<?php require_once "includes/footer.php"; ?>
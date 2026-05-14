<?php
session_start();
require_once "includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":email" => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        // 🔥 IMPORTANT FIX (ID + ROLE + USERNAME)
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        $_SESSION["welcome_message"] =
            "Welcome back, " . $user["username"] . "!";

        if (!empty($user["last_visit"])) {
            $_SESSION["previous_visit"] = $user["last_visit"];
        }

        $currentTime = date("Y-m-d H:i:s");

        $updateSql = "
            UPDATE users
            SET last_visit = :last_visit
            WHERE id = :id
        ";

        $updateStmt = $pdo->prepare($updateSql);

        $updateStmt->execute([
            ":last_visit" => $currentTime,
            ":id" => $user["id"]
        ]);

        setcookie(
            "username",
            $user["username"],
            time() + (86400 * 30),
            "/"
        );

        header("Location: index.php");
        exit();

    } else {
        $message = "Wrong login!";
    }
}

require_once "includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow p-4">

            <h2 class="mb-4">Login</h2>

            <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Login</button>

            </form>

        </div>
    </div>
</div>

<?php require_once "includes/footer.php"; ?>
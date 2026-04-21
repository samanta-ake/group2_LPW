<?php
session_start();
require_once "classes/Service.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $image = trim($_POST["image"]);

    if (!empty($title) && !empty($description) && !empty($image)) {
        $service = new Service();

        if ($service->create($title, $description, $image)) {
            $message = "Service added successfully!";
        } else {
            $message = "Error adding service.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Add Service</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Service</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
<?php
session_start();
require_once "classes/Service.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$service = new Service();
$services = $service->readAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Dashboard</h2>

    <a href="add_service.php" class="btn btn-success mb-3">Add New Service</a>
    <a href="index.php" class="btn btn-secondary mb-3">Home</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($services as $row): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo htmlspecialchars($row["title"]); ?></td>
                <td><?php echo htmlspecialchars($row["description"]); ?></td>
                <td><?php echo htmlspecialchars($row["image"]); ?></td>
                <td>
                    <a href="edit_service.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_service.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
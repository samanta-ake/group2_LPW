<?php
session_start();
require_once "classes/Service.php";

if (
    !isset($_SESSION["username"]) ||
    $_SESSION["role"] !== "admin"
) {
    header("Location: index.php");
    exit();
}

$service = new Service();
$message = "";

if (!isset($_GET["id"])) {
    die("Service ID is missing.");
}

$id = (int)$_GET["id"];
$currentService = $service->readById($id);

if (!$currentService) {
    die("Service not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if (!empty($title) && !empty($description)) {
        if ($service->update($id, $title, $description)) {
            $message = "Service updated successfully!";
            $currentService = $service->readById($id);
        } else {
            $message = "Error updating service.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
require_once "includes/header.php";
?>

<h2 class="mb-4">Edit Service</h2>
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">


    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($currentService['title']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($currentService['description']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update Service</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
<?php require_once "includes/footer.php"; ?>
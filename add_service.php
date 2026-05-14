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

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $image = trim($_POST["image"]);

    if (!empty($title) &&
        !empty($description) &&
        !empty($image)) {

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

require_once "includes/header.php";
?>

<h2 class="mb-4">Add Service</h2>

<?php if ($message): ?>

    <div class="alert alert-info">
        <?php echo $message; ?>
    </div>

<?php endif; ?>

<form method="POST">

    <div class="mb-3">

        <label class="form-label">
            Title
        </label>

        <input type="text"
               name="title"
               class="form-control">

    </div>

    <div class="mb-3">

        <label class="form-label">
            Description
        </label>

        <textarea name="description"
                  class="form-control"></textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Image URL
        </label>

        <input type="text"
               name="image"
               class="form-control">

    </div>

    <button type="submit"
            class="btn btn-primary">

        Add Service

    </button>

</form>

<?php require_once "includes/footer.php"; ?>
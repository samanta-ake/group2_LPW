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
$services = $service->readAll();

require_once "includes/header.php";
?>

<h2 class="mb-4">Dashboard</h2>

<a href="add_service.php"
   class="btn btn-success mb-3">

    Add New Service

</a>

<div class="table-responsive">

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

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

                <td>
                    <?php echo $row["id"]; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["title"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["description"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["image"]); ?>
                </td>

                <td>

                    <a href="edit_service.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <a href="delete_service.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure?');">

                        Delete

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php require_once "includes/footer.php"; ?>
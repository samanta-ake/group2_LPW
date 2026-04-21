<?php
require_once "classes/Service.php";

$service = new Service();

$search = "";
if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}

if (!empty($search)) {
    $services = $service->search($search);
} else {
    $services = $service->readAll();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Our Services</h2>

    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search services..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="row">
        <?php if (!empty($services)): ?>
            <?php foreach ($services as $row): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Service image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No services found.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
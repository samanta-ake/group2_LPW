<?php
require_once "classes/Service.php";

$service = new Service();

$search = $_GET["search"] ?? "";

$services = !empty($search)
    ? $service->search($search)
    : $service->readAll();

if (!empty($services)) {

    foreach ($services as $row) {

        echo '
        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img src="' . htmlspecialchars($row['image']) . '"
                     class="card-img-top"
                     alt="service image">

                <div class="card-body">

                    <h5 class="card-title">
                        ' . htmlspecialchars($row["title"]) . '
                    </h5>

                    <p class="card-text text-muted">
                        ' . htmlspecialchars($row["description"]) . '
                    </p>

                    <a href="contact.php"
                       class="btn btn-outline-primary btn-sm">

                        Request this service

                    </a>

                </div>

            </div>

        </div>
        ';
    }

} else {

    echo '
    <div class="col-12">
        <div class="alert alert-warning">
            No services found.
        </div>
    </div>
    ';
}
?>
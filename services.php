<?php
require_once "classes/Service.php";

$service = new Service();
$services = $service->readAll();

require_once "includes/header.php";
?>

<!-- PAGE HEADER -->
<div class="mb-4">

    <h1 class="fw-bold">
        Our Services
    </h1>

    <p class="text-muted">

        Below you will find all available services provided by our platform.
        Each service is designed to help clients improve their online presence,
        business workflow, and digital solutions.

        Browse the services below and contact us if you would like
        to request one of them for your own project or business.

    </p>

</div>

<!-- LIVE SEARCH -->
<div class="mb-4">

    <input type="text"
           id="searchInput"
           class="form-control"
           placeholder="Search services...">

</div>

<!-- SERVICES -->
<div class="row" id="servicesContainer">

    <?php foreach ($services as $row): ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img src="<?= htmlspecialchars($row['image']) ?>"
                     class="card-img-top"
                     alt="service image">

                <div class="card-body">

                    <h5 class="card-title">
                        <?= htmlspecialchars($row["title"]) ?>
                    </h5>

                    <p class="card-text text-muted">
                        <?= htmlspecialchars($row["description"]) ?>
                    </p>

                    <a href="contact.php"
                       class="btn btn-outline-primary btn-sm">

                        Request this service

                    </a>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>

<!-- INFO SECTION -->
<div class="mt-4 p-4 bg-light rounded shadow-sm">

    <p class="mb-0 text-muted">

        Our goal is to provide modern and reliable digital services
        for individuals, businesses, and organizations.
        If you are unsure which service best fits your needs,
        feel free to contact us for guidance and recommendations.

    </p>

</div>

<!-- AJAX SEARCH -->
<script>

document.getElementById("searchInput")
.addEventListener("keyup", function () {

    const search = this.value;

    fetch("search_services.php?search=" + search)

        .then(response => response.text())

        .then(data => {

            document.getElementById("servicesContainer")
                .innerHTML = data;

        });

});

</script>

<?php require_once "includes/footer.php"; ?>
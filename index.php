<?php
session_start();
require_once "includes/header.php";
?>

<!-- HERO SECTION -->
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">

    <div class="container py-4">

        <h1 class="display-5 fw-bold">
            Professional Web Services Platform
        </h1>

        <p class="col-md-8 fs-5 text-muted mt-3">

            We provide modern web-based services, user account management,
            and interactive tools for clients and visitors.
            Our platform is built with security, performance, and usability in mind.

        </p>

        <div class="mt-4">

            <a href="services.php" class="btn btn-primary btn-lg me-2">
                Explore Services
            </a>

            <?php if (!isset($_SESSION["username"])): ?>

                <a href="register.php" class="btn btn-success btn-lg">
                    Create Account
                </a>

            <?php else: ?>

                <a href="contact.php" class="btn btn-outline-dark btn-lg">
                    Contact Us
                </a>

            <?php endif; ?>

        </div>

    </div>

</div>

<!-- FEATURES -->
<div class="row g-4">

    <div class="col-md-4">

        <div class="card h-100 shadow-sm border-0">

            <div class="card-body">

                <h4 class="card-title">
                    Web Services
                </h4>

                <p class="card-text text-muted">

                    Browse available services stored in the database.
                    Each service contains detailed information and images.

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card h-100 shadow-sm border-0">

            <div class="card-body">

                <h4 class="card-title">
                    Secure Accounts
                </h4>

                <p class="card-text text-muted">

                    Users can register, log in, and manage their account securely.
                    Passwords are encrypted and protected.

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card h-100 shadow-sm border-0">

            <div class="card-body">

                <h4 class="card-title">
                    Contact System
                </h4>

                <p class="card-text text-muted">

                    Send messages directly through our contact form.
                    All messages are stored securely in the database.

                </p>

            </div>

        </div>

    </div>

</div>

<!-- CALL TO ACTION -->
<div class="mt-5 p-5 bg-dark text-white rounded-3 text-center shadow">

    <h2 class="fw-bold">
        Ready to get started?
    </h2>

    <p class="mt-2 text-light">
        Join our platform and explore modern web functionality today.
    </p>

    <?php if (!isset($_SESSION["username"])): ?>

        <a href="login.php" class="btn btn-light btn-lg mt-3">
            Login Now
        </a>

    <?php else: ?>

        <a href="services.php" class="btn btn-light btn-lg mt-3">
            Go to Services
        </a>

    <?php endif; ?>

</div>

<?php require_once "includes/footer.php"; ?>
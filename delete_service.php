<?php
session_start();
require_once "classes/Service.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
    $service = new Service();
    $service->delete($id);
}

header("Location: dashboard.php");
exit();
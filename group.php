<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");

session_start();

    $user_data = check_login();
    $isAdmin = check_admin();
    $SeriesEdit = edit_series($_POST);

    $HTML = new SiteGenerator("Video Group Edit","background5");
    $HTML->generateSiteStart();
?>
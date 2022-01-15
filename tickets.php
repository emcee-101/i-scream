<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");

session_start();

    $user_data = check_login();
    $isAdmin = check_admin();

$HTML = new SiteGenerator("Tickets Page","background5");
$HTML->generateSiteStart();
$TicketShower = new TicketShower();

$HTML->generateSiteEnd();

?>
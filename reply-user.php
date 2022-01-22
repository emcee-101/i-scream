<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
include_once("includes/connection.php");

session_start();
$user_data = check_login();
$isAdmin = check_admin();

$ticketID = $_GET["id"];
$ticketReply = replyTicket($ticketID, $_POST);

$con = establish_connection_db();
$HTML = new SiteGenerator("Tickets Page","background4");
$HTML->generateSiteStart();
echo "<div class ='ticketParent'>";
$ticketTable = "ticket";


$result = mysqli_query($con,"SELECT user_id ,topic ,description from ticket where id = '$ticketID'");
$array = mysqli_fetch_array($result);
$userID = $array[0];
$ticketTopic = $array[1];
$ticketDescription = $array[2];

$ticketDisplayer = new ticketDisplayer($con, $ticketTable, $ticketID, $userID, $ticketTopic, $ticketDescription);
$ticketDisplayer->setUsername($con, $userID);
$ticketDisplayer->printTicketForm();

echo "</div>";
require_once("includes/header.php");
require_once("includes/footer.php");
$HTML->generateSiteEnd();
?>
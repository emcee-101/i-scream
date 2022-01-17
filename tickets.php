<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");
include_once("includes/connection.php");

session_start();

    $user_data = check_login();
    $isAdmin = check_admin();

$con = establish_connection_db();
$HTML = new SiteGenerator("Tickets Page","background5");
$HTML->generateSiteStart();
?><div class ="ticketParent">
<?
$ticketTable = "ticket";
$result = mysqli_query($con,"SELECT id, user_id ,topic ,description from ticket");

while ($row = mysqli_fetch_array($result))
{
    $ticketID = $row[0];
    $userID = $row[1];
    $ticketTopic = $row[2];
    $ticketDescription = $row[3];

    $ticketDisplayer = new ticketDisplayer($con, $ticketTable, $ticketID, $userID, $ticketTopic, $ticketDescription);
    $ticketDisplayer->setUsername($con, $userID);
    $ticketDisplayer->printTicket();
}

?></div><?
$HTML->generateSiteEnd();

?>
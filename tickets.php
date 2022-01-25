<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
include_once("includes/connection.php");

session_start();

$user_data = check_login();
$isAdmin = check_admin();

$con = establish_connection_db();
$HTML = new SiteGenerator("Tickets Page","background4");
$HTML->generateSiteStart();
echo "<div class ='ticketParent'>";
$ticketTable = "ticket";
$result = mysqli_query($con,"SELECT id, user_id ,topic ,description from ticket where reply IS NULL");

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

if(isset($_GET["ticketID"]))
{
    $ticketID = $_GET["ticketID"];
    $message = "You successfully replied to ticket with the ID:".$ticketID."";
    echo "<div class='fade-in'><p class='button'>".$message."</p></div>";
}

echo "</div>";
require_once("includes/header.php");
require_once("includes/footer.php");
$HTML->generateSiteEnd();
?>
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

$ticketDisplayer = new ticketDisplayer($con,"ticket");

/* foreach(// Row in ticket table)
{
    // Set all the parameters in the ticketDisplayer instance to the current entry columns of the table
    // Get Username of the associated id
    // Print the ticket with the altered values
}
*/
$HTML->generateSiteEnd();

?>
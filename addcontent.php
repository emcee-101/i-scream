<?php
include("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

session_start();

    $user_data = check_login($con);
    $isAdmin = check_admin($con);
?>
<
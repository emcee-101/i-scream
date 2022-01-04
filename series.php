<?php

include("includes/connection.php");
include("includes/functions.php");

session_start();

    $user_data = check_login($con);

        header('Location: movies.php?site=series');


?>


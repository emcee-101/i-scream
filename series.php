<?php

include_once("includes/functions.php");

session_start();

    $user_data = check_login();

        header('Location: movies.php?site=series');


?>


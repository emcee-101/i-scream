<?php
require_once("includes/header.php");
include("connection.php");
include("functions.php");
/* Check whether user is logged in and redirect to login page if not */

session_start();

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Welcome to IScream</title>

</head>
<body>

    <a href="logout.php">Logout</a>
    <h1> This is the index page </h1>

    <br>
    Hello, <?php echo $user_data['username']; ?>
    <br>

</body>
</html>
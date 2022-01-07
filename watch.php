<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/connection.php");
include("includes/functions.php");

session_start();

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Watch a Video</title>
    <link rel="stylesheet" href="assets/css/style.css">



</head>
<body class="background5">

    <br>

    <?php

        if (empty($_GET)){
            header('Location: index.php');
        }
        else{

                    // included in $data: title,description,picture
            $data = getWatchScreen($_GET["id"]);

                    // Test if Data is accessible correctly:
             echo "<h3 id='whitefont' style='margin:5px;'>".$_GET["id"].$data["title"]."</h3>";

        }


    ?>




</body>
</html>

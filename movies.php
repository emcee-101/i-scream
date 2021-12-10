<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("connection.php");
include("functions.php");

session_start();

    $user_data = check_login($con);
?>

<html lang="de">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/css/js/script.js"></script>

  </head>
  <body class="background3">
   
    <p>This is the movies site</p>
     
  </body>
</html>
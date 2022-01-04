<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/connection.php");
include("includes/functions.php");
session_start();

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class = "background4">

    <div class="fade-in">
        <h3 id ="whitefont">My Watchlist</h3>

        <div class="videowrapper">
          <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
          <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div> 
          <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
          <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
          <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
        </div>
        
    </div>
</body>
</html>

<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
</head>
<body class="background5">
    
    <div class="fade-in">
        <div class="box" id="cent">

            <h2 id="redfont">Get in Contact</h2>

            <form method="POST">

            <p>Topic</p><input type="text" name ="topic" required><br><br>

            <p>State your Issue</p><textarea class="inputbox" type="text" maxlength="100" name="Explanation" required></textarea><br><br>

            <input type="submit" class="button button1" value="Send"><br><br>
    </div>
</form>

        
        

    </div>

</body>
</html>
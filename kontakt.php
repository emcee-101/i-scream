<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include_once("includes/connection.php");
include("includes/functions.php");

session_start();

    $user_data = check_login();

    // if posted run newTicket()
if (isset($_POST['topic']) && isset($_POST["Explanation"])){

    newTicket($con, $_POST["topic"], $_POST["Explanation"], $_SESSION["usr_id"]);

        echo "<h3 id='whitefont'>You sucessfully sent your Ticket:'".$_POST["topic"]."'</h3>";

}




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

            <form action="kontakt.php" method="POST">

            <p>Topic</p><input type="text" name ="topic" style="width:220px" required><br><br>

            <p>State your Issue</p><textarea class="inputbox" type="text" style="width:220px"; maxlength="100" name="Explanation" required></textarea><br><br>

            <input type="submit" class="button button1" value="Send"><br><br>
    </div>
</form>

        
        

    </div>

</body>
</html>

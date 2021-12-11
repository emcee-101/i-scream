
<?php
require_once("includes/header.php");
require_once("includes/footer.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/css/js/script.js"></script>

    <title>Account</title>
 
</head>

<body class= "background1" >
                <div id="logo" >
                        <img class ="headerlogo" src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" style="height:100px; width:100px;"></img></a>
                    </div>
                    <div class = "box" id="cent">
        <h2 style="text-align:center" id="redfont">Account</h2><br>
        <form method="POST">

        <p class="center">Email</p><br><input type="text" name="email"><br><br>
            <p>Password</p><br><input type="password" name="password"><br><br><br>
            <p>Date of birth</p><br><input type="date" name="Date of birth"><br><br><br>
            <p>Sex</p><br><input type="radio" name="sex"><br><br><br>
            <p>Membership</p><br><input type="text" name="membership"><br><br><br>

            <input type="button" class="button button1" value="Account"><br><br><br>
            <input type="button" class="button button1" value="edit profile"><br><br><br>
          
        </form>
    </div>


</body>

</html>

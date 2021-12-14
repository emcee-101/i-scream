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

    <title>Account </title>
 
</head>

<body class= "background2" >
                <div id="logo" >
                        <img class ="headerlogo" src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" style="height:100px; width:100px;"></img></a>
                    </div>
                   
                    
        <h2 style="text-align:center" id="redfont">Account</h2>
        <form method="POST">

        <p class="center">Email</p><input type="text" name="email">
            <p>Password</p><input type="password" name="password">
            <p>Date of birth</p><input type="date" name="Date of birth">
            
            <p>Sex</p><input type="radio" name="sex" value="female" >female 
            <input type="radio" name="sex" value="male">male 

            <p>Membership</p><input type="text" name="membership"><br>

            <input type="button" class="button4" value="Account"><br>
            <input type="button" class="button5" value="edit profile"><br>
          
        </form>
    


</body>

</html>


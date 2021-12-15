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
                
                   
                    
        <h2 style="text-align:center" id="redfont">Account</h2>
        <form method="POST">

        <p class="center">Email <input type="text" name="email"><br> <br br>  </p>
            <p>Password<input type="password" name="password"><br><br> <br> </p>
            <p>Date of birth<input type="date" name="Date of birth"><br><br> <br ></p>
            
            <p>Sex<input type="radio" name="sex" value="female" >female 
            <input type="radio" name="sex" value="male">male <br><br><br>  </p>

            <p>Membership<input type="text" name="membership"><br><br> <br ></p>

            
            <p><input type="button" class="button5" value="Edit profile"><br>
          
        </form>
    


</body>

</html>

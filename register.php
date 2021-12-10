<?php
/* weird stuff shows up on screen

require_once('includes/config.php');
require_once('includes/classes/FormSanitizer.php');
require_once('includes/classes/Constants.php');
require_once('includes/classes/Account.php');
require_once('assets/css/style.css');
*/
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    //
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $mail_address = $_POST['mail_address'];
    $age = $_POST['age'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //save to database
        $query = "insert into user (username,password,mail_address,age) values('$user_name','$password','$mail_mail_address','$age')";

        mysqli_query($con, $query);
        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/css/js/script.js"></script>

    <title>Register</title>
</head>

<body class="background1">
    <div class ="box" id="cent">
        <h2 style="text-align:center">Register</h2><br>

        <form method="POST">

            <p>Username</p><input type="text" name="username" required><br><br>
            <p>Password</p><input type="password" name="password" required><br><br>
            <p>E-Mail</p><input type="email" name="mail_address" required><br><br>
            <p>Age</p><input type="number" name="age" min="18" , max="100" required><br><br>

            <input type="submit" class="button button1" value="Register"><br><br>
            <a href="login.php" class="button button1" style="text-decoration: none">Login</a></button><br><br>
        </form>
    </div>
</body>

</html>
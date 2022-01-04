<?php
session_start();
include("connection.php");
include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // something was posted
        $user_name = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password,  PASSWORD_DEFAULT);


    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //read from database & find user with the matching username
        $query = "select * from user where username = '$user_name' limit 1";

        $result = mysqli_query($con, $query);

        //if user was found check if password is correct
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $hashed_password) {
                    $_SESSION['username'] = $user_data['username'];
                    header("Location: index.php");
                    die;
                }
            }
        }
    } else {
        echo "please enter some valid information";
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

    <title>Login</title>


</head>


<body class="background1">

<div class= "fade-in">
    <div id="logo" >
        <img id= "startlogo" src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" style="height:100px; width:100px;"></img></a>
    </div>

    <h1 id= "redfont">Welcome to I-Scream</h1>

    <div class = "box" id="cent">
        <h2 style="text-align:center" id="redfont">Login</h2><br>
        <form method="POST">

            <p>Username</p><input type="text" name="username"><br><br>
            <p>Password</p><input type="password" name="password"><br><br>


            <input type="submit" class="button button1" value="Login"><br><br>
            <a href="register.php" class="button button1">Register</a><br><br>
        </form>
    </div>
</div>

</body>

</html>

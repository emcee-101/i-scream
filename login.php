<?php
session_start();
include_once("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // something was posted
        $user_name = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password,  PASSWORD_DEFAULT);


    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //read from database & find user with the matching username
        $query = "select * from user where username = '$user_name' limit 1";

        $con = establish_connection_db();

        $result = mysqli_query($con, $query);

        abolish_connection_db($con);

        //if user was found check if password is correct
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['username'] = $user_data['username'];
                    $_SESSION['usr_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
    } else {
        echo "please enter some valid information";
    }

$HTML = new SiteGenerator("Login Page","background1");
$HTML->generateSiteStart();

}
?>
<div class= "fade-in">
    <p class = "alignment">
        <img src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" style="height:100px; width:100px;"></img></a>
    </p>

    <h1 class="alignment" id= "redfont">Welcome to I-Scream</h1>


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

<? $HTML->generateSiteStart(); ?>

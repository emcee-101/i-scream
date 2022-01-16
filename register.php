<?php

session_start();
include_once("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    //

    $user_name = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password,  PASSWORD_DEFAULT);

    $mail_address = $_POST['mail_address'];
    $age = $_POST['age'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name) && !empty($mail_address)) {
        //save to database
        $query = "insert into user (username,password,mail_address,age) values('".$user_name."','".$hashed_password."','".$mail_address."','".$age."')";


        $con = establish_connection_db();

        mysqli_query($con, $query);

        abolish_connection_db($con);

        header("Location: login.php");

        die;
    } else {
        echo "Please enter some valid information!";
    }
}

$HTML = new SiteGenerator("Register Page","background1");
$HTML->generateSiteStart();
?>
    <div class="fade-in">
         <p class = "alignment">
            <img id="startlogo" src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" style="height:100px; width:100px;"></img></a>
         </p>
        <h1 id= "redfont">Let's get started!</h1>
    
        <div class ="box" id="cent">
            <h2 style="text-align:center" id="redfont">Register</h2><br>
    
            <form method="POST">
    
                <p>Username</p><input type="text" name="username" required><br><br>
                <p>Password</p><input type="password" name="password" required><br><br>
                <p>E-Mail</p><input type="email" name="mail_address" required><br><br>
                <p>Age</p><input type="number" name="age" min="18" , max="100" required><br><br>
    
                <input type="submit" class="button button1" value="Register"><br><br>
                <a href="login.php" class="button button1" style="text-decoration: none">Login</a></button><br><br>
            </form>
        </div>
    </div>

<?$HTML->generateSiteEnd();?>

<?php
session_start();
include_once("includes/connection.php");
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/classes/DisplayElements.php");


$con = establish_connection_db();
$user_id = $_SESSION['usr_id'];


$email = mysqli_query($con, "select mail_address from user where user_id='$user_id' ");
$email=mysqli_fetch_assoc($email);
var_dump($email);
$email=$email["mail_address"];

$password= mysqli_query($con, "select password from user where user_id='$user_id' ");
$password=mysqli_fetch_assoc($password);
var_dump($password);
$password=$password["password"];

$age= mysqli_query($con, "select age from user where user_id='$user_id' ");
$age=mysqli_fetch_assoc($age);
var_dump($age);
$age=$age["age"];

$membership= mysqli_query($con, "select isSubscribed from user where user_id='$user_id' ");
$membership=mysqli_fetch_assoc($membership);
var_dump($membership);
$membership=$membership["isSubscribed"];


$HTML = new SiteGenerator("Account","background2");
$HTML->generateSiteStart();
?>
        <div class="box" id="cent">
        <h2 id="redfont">Account</h2>
        <form method="POST">

        <p>Email:<br>  <p type="text" name="email"> <?php echo $email; ?>  </p>  <br></p>
        <p>Password:<br> <p type="password" name="password"><?php echo $password; ?>  </p> <br></p>
        <p>Age: <br> <p type="date" name="Age"> <?php echo $age; ?> </p> <br> </p>
        <p>Membership: <p type="text" name="membership"> <?php echo $membership; ?>  </p> <br><br></p>

            
        <p><input class="button button2" style="padding:10px 0px" value="Edit profile"><br>
        
        </div>
          
        </form>

<?$HTML->generateSiteEnd();?>


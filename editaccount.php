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

$HTML = new SiteGenerator("Account","background2");
$HTML->generateSiteStart();

?>
    <div class="box" id="cent">
        <h2 id="redfont">Account</h2>
        <form method="POST">

        <p>Your current Email: <p type="text" name="email"> <?php echo $email; ?> </p> </p>
        
        <br> <p>New Email:</p>
        <input></input> <br> <br> 
        <p>Enter your current Password:</p>
        <input></input> 
        <p>New Password:</p>
        <input></input>
        <p><a href="account-management.php" input class="button button1" style="padding:10px 0px">Submit Edit</a><br>

        </div>

        </form>
<?
$HTML->generateSiteEnd();?>

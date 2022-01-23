<?php
session_start();
include_once("includes/connection.php");
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
$HTML = new SiteGenerator("Account","background2");
$HTML->generateSiteStart();

$user_id = $_SESSION['usr_id'];

$PasswordEdit = edit_password($user_id, $_POST);
?>

<div class="box">

        <h2 id="redfont">Account</h2><br>
        <form method="POST">
        <p>Enter new password<br><br>
        <input name="password1" type="password" minlength = "8" required><br><br>
        <input name="password2" type = "password" minlength = "8" required><br><br>
        <input type = submit class ="button button1" name="pwEdit" value = "Edit Password">
        </p>
        </form>
        <br>
</div>



<?php
$HTML->generateSiteEnd() ?>
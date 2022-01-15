<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/classes/DisplayElements.php");

$HTML = new SiteGenerator("Account Page","background5");
$HTML->generateSiteStart();
?>
        <div class="box" id="cent">
        <h2 id="redfont">Account</h2>
        <form method="POST">

        <p>Email<br> <input type="text" name="email"><br><br></p>
        <p>Password<br> <input type="password" name="password"><br><br></p>
        <p>Date of birth <br> <input type="date" name="Date of birth"><br><br>
        <p>Membership<br><input type="text" name="membership"><br><br></p>

            
        <p><input class="button button2" style="padding:10px 0px" value="Edit profile"><br>
        
        </div>
        </form>
    


<? $HTML->generateSiteStart("Account Page","background2"); ?>
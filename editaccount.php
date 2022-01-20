<?php
session_start();
include_once("includes/connection.php");
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/classes/DisplayElements.php");

$HTML = new SiteGenerator("Account","background2");
$HTML->generateSiteStart();

?>
        <div class="box" id="cent">
        <h2 id="redfont">Account</h2>
        <form method="POST">

        <p>Enter Password:</p>
        <input></input>
        <p>New Password:</p>
        <input></input>
        <p><a href="editaccount.php" input class="button button1" style="padding:10px 0px">Submit Edit</a><br>

        </div>

        </form>
<?
$HTML->generateSiteEnd();?>
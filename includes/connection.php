<?php

$dbhost = "localhost"; /* change later to the host we are using*/
$dbuser = "usr1";
$dbpass = "pass";
$dbname = "iscream";

/*establish connection with database*/
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
};

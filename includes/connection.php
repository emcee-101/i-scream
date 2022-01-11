<?php

function establish_connection_db(){

    $dbhost = "localhost"; /* change later to the host we are using*/
    $dbuser = "usr1";
    $dbpass = "pass";
    $dbname = "iscream";

    /*establish connection with database*/
    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    {
        die("failed to connect!");
    };

    return $con;
}

function abolish_connection_db($con){

    // closing connection
    mysqli_close($con);

}

?>

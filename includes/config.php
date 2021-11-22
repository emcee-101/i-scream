<?php
ob_start(); // turn on output buffering
session_start();

date_default_timezone_set("Europe/Berlin");

/**
 * connect to database and set error warning mode
 */
try {
    $con = new PDO("mysql:dbname=iscreamdb;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}

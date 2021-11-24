<?php
ob_start();
session_start();

date_default_timezone_set("Europe/Berlin");

try {
    $con = new PDO("mysql:dbname=iscream;host=localhost", "root", "");
} catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}

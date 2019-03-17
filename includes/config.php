<?php
ob_start();
session_start();

date_default_timezone_set("Europe/Istanbul");

try{
    $con = new PDO("mysql:host=127.0.0.1:4848;dbname=videotube", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

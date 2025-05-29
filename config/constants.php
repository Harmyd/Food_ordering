<?php 
//Start Session
session_start();
define('SITEURL','http://localhost/restaurant2/');
define ('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food_order');

$connection =mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
if(!$connection){
    die("db connection failed");
}
?>
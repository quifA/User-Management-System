<?php
error_reporting(E_ALL); 
ini_set('display_errors',1);

$conn = new mysqli('localhost','root','','info');
if ($conn->connect_error) {
    die('DB Connection Failed: '.$conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
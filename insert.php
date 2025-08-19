<?php
require 'db.php';

if(isset($_POST['name']) && isset($_POST['age'])){
    $name = $conn->real_escape_string($_POST['name']);
    $age  = (int) $_POST['age'];
    $conn->query("INSERT INTO users (name, age, status) VALUES ('$name', $age, 0)");
}
header("Location: index.php");
exit;
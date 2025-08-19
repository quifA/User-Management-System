<?php
require 'db.php';

if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $conn->query("UPDATE users SET status = 1 - status WHERE id = $id");
}
header("Location: index.php");
exit;
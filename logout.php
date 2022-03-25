<?php
$mysqli = new mysqli("localhost","root","","livraria");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
} else {
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    session_destroy();
    header("refresh:0;url=index.php");
}

$mysqli->close();
?>
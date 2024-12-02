<?php
$mysqli =new mysqli("localhost","root", "","desarrollotarea1");

if ($mysqli->connect_error) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
?>
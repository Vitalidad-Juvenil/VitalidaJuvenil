<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mi_base";

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
    die("❌ Error de conexión: " . $con->connect_error);
}

$con->set_charset("utf8");
?>

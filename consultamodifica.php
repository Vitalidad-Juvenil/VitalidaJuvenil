<?php
session_start();

// ✅ RESTRICCIÓN DE ACCESO: Solo admin y psicologia
$allowed_roles = ['admin', 'psicologia'];
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
    die("❌ Acceso denegado");
}

include("conexion.php");

$idenviar=$_POST["idenviar"];
$consulta="select * from alumnos where id='".mysqli_real_escape_string($con, $idenviar)."'"; 

$ejecute=mysqli_query($con,$consulta);
$registros=mysqli_fetch_array($ejecute);

header('Content-Type: application/json');
echo json_encode($registros);
?>
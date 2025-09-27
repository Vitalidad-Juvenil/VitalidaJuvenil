<?php
include("conexion.php");

$identificacion = $_POST["identificacion"];
$institucion = $_POST["institucion"];
$idalumno = $_POST["idalumno"];

// Usando mysqli_real_escape_string para seguridad mínima
$identificacion = mysqli_real_escape_string($con, $identificacion);
$institucion = mysqli_real_escape_string($con, $institucion);
$idalumno = mysqli_real_escape_string($con, $idalumno);

if ($idalumno > 0) {
    $sql = "UPDATE alumnos 
            SET numeroidentificacion = '".$identificacion."', 
                colegio = '".$institucion."' 
            WHERE id = '".$idalumno."'";
} else {
    $sql = "INSERT INTO alumnos (numeroidentificacion, colegio) 
            VALUES ('".$identificacion."', '".$institucion."')";
}

if (!mysqli_query($con, $sql)) {
    die("❌ Error al guardar datos de alumno: " . mysqli_error($con));
}
?>
<script>
window.location.href = "index.php";
</script>
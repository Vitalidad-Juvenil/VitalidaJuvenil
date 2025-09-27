<?php
session_start();
include("conexion.php");

// ✅ RESTRICCIÓN DE ACCESO: Solo admin y psicologia
$allowed_roles = ['admin', 'psicologia'];
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
    die("❌ Acceso denegado. Solo para Administradores y Psicología.");
}

$consulta="select * from alumnos";
$ejecute=mysqli_query($con,$consulta);

echo " <table class='table'>
            <thead>
                <tr>
                    <th># Identificación</th>
                    <th>Institucion Educativa</th>
                    <th>Eliminar</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>";

while($registros=mysqli_fetch_array($ejecute))
{
    echo "<tr><td>";
    echo htmlspecialchars($registros["numeroidentificacion"]);
    echo "</td>";
    echo "<td>";
    echo htmlspecialchars($registros["colegio"]);
    echo "</td>";
    echo "<td><a href='eliminar.php?dato=".$registros["id"]."' class='delete' onclick='return confirm(\"¿Deseas eliminar este registro?\")'>Eliminar</a></td>"; 
    echo "<td><button onclick='dato (".$registros["id"].");'>Editar</button></td>";
    echo "</tr>";
}

echo "
</tbody>
</table>";
?>
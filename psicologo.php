<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "conexion.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'psicologia') {
    die("❌ Acceso denegado. Solo para Psicología.");
}

$sql = "SELECT id, name, email, role FROM users";
$result = $con->query($sql);

if (!$result) {
    die("❌ Error Fatal en la consulta a la base de datos: " . $con->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Psicología</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>🧠 Panel de Psicología</h1>
        <a href="logout.php">Cerrar sesión</a>
        <p>Bienvenido, <?= htmlspecialchars($_SESSION['name']) ?>. Tienes acceso a la gestión de alumnos.</p>
        
       
        
        <h2>Lista de Usuarios del Sistema</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("❌ Acceso denegado.");
}

$sql = "SELECT id, name, email, role FROM users";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>👨‍💻 Panel de Administración</h1>
        <a href="logout.php">Cerrar sesión</a>
        <hr>
        <a href="consultadatos.php" style="background-color: #28a745;">Gestionar Fichas de Alumnos</a>
        <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>">✏ Editar</a>
                    <a href="eliminar.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">🗑 Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
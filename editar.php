<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "conexion.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("❌ Acceso denegado.");
}

if (!isset($_GET['id'])) {
    die("❌ ID de usuario inválido.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("❌ Error al preparar la consulta SELECT: " . $con->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("❌ Usuario no encontrado.");
}
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role  = trim($_POST['role']);

    $sql_update = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
    $stmt_update = $con->prepare($sql_update);
    
    if (!$stmt_update) {
        die("❌ Error al preparar la actualización (UPDATE): " . $con->error);
    }
    
    $stmt_update->bind_param("sssi", $name, $email, $role, $id);
    
    if ($stmt_update->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        // Muestra el error de base de datos si falla
        die("❌ Error al ejecutar la actualización (UPDATE): " . $stmt_update->error);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>✏ Editar Usuario</h2>
        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label>Rol:</label>
            <select name="role" required>
                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>Usuario</option>
                <option value="psicologia" <?= $user['role']=='psicologia'?'selected':'' ?>>Psicología</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Administrador</option>
            </select>
            <br>
            <button type="submit">Guardar Cambios</button>
            <a href="admin.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
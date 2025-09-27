<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido <?= htmlspecialchars($_SESSION['name']) ?> 👋</h1>
        <p>Tu rol es: <?= htmlspecialchars($_SESSION['role']) ?></p>
        <a href="logout.php">Cerrar sesión</a>
        <hr>
        <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'psicologia'): ?>
            <p>Acceso a datos de alumnos:</p>
            <a href="consultadatos.php">Gestionar Alumnos</a>
        <?php endif; ?>
    </div>
</body>
</html>
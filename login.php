<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        $error = "❌ Error en prepare: " . $con->error;
    } else {
        $stmt->bind_param("s", $email);

        if (!$stmt->execute()) {
            $error = "❌ Error en execute: " . $stmt->error;
        } else {
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if ($password === $user['password']) {
                    $_SESSION['id']   = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['role'] = $user['role'];
                    
                    // ✅ LÓGICA DE REDIRECCIÓN
                    $role = trim($user['role']); // Limpiar el rol por si tiene espacios

                    if ($role === 'admin') {
                        header("Location: admin.php"); 
                        exit;
                    } elseif ($role === 'psicologia') {
                        header("Location: psicologo.php"); 
                        exit;
                    } else {
                        header("Location: perfil.php");
                        exit;
                    }
                } else {
                    $error = "❌ Contraseña incorrecta";
                }
            } else {
                $error = "❌ Usuario no encontrado";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>🔐 Iniciar Sesión</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Contraseña:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
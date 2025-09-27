<?php
session_start();
require_once "conexion.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$allowed_roles_data = ['admin', 'psicologia'];

// Lógica de eliminación de registros de alumno (dato)
if (isset($_GET['dato'])) {
    // Permite eliminar alumnos a ambos roles
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles_data)) {
        die("❌ Acceso denegado para eliminar registros de alumnos.");
    }
    
    $id_to_delete = intval($_GET['dato']);
    $sql = "DELETE FROM alumnos WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);
    
    if ($stmt->execute()) {
        header("Location: consultadatos.php");
        exit;
    } else {
        die("❌ Error al eliminar registro de alumno: " . $stmt->error);
    }

} 
// Lógica de eliminación de usuarios del sistema (id)
else if (isset($_GET['id'])) {
    // Restringe la eliminación de USUARIOS solo al rol 'admin'
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
         die("❌ Acceso denegado para eliminar usuarios.");
    }
    
    $id = intval($_GET['id']);
    
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        die("❌ Error al eliminar usuario: " . $stmt->error);
    }
} else {
    die("❌ ID o Dato inválido.");
}
?>
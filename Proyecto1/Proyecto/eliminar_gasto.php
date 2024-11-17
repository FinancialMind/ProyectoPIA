<?php
// Incluir el archivo de conexión
require 'modelo/conexion.php';
session_start();

// Verificar si se ha pasado un ID de gasto a eliminar
if (isset($_GET['id'])) {
    $idGasto = $_GET['id'];
    $idUsuario = $_SESSION['id_usuario'];  // Asumimos que el ID del usuario está en la sesión

    // Eliminar el gasto de la base de datos
    $query = "DELETE FROM gastos WHERE id_gasto = ? AND id_usuario = ?";
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $idGasto, $idUsuario);
        if (mysqli_stmt_execute($stmt)) {
            // Si la eliminación es exitosa, establecer un mensaje de éxito
            $_SESSION['mensaje'] = "Gasto eliminado exitosamente.";
        } else {
            // Si algo sale mal al eliminar, establecer un mensaje de error
            $_SESSION['mensaje_error'] = "Error al eliminar el gasto. Intenta nuevamente.";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    // Si no se pasó un ID, redirigir a gastos.php sin hacer nada
    $_SESSION['mensaje_error'] = "No se proporcionó un ID de gasto.";
}

// Redirigir de nuevo a ingreso.php
header('Location: gasto.php');
exit();
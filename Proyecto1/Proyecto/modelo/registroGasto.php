<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

global $connection;
$id_usu = $_SESSION['id_usuario'];

// Verificar que se haya enviado el ID del gasto a editar
if (isset($_POST['id_gasto'])) {
    $id_gasto = $_POST['id_gasto'];
    $monto = $_POST['monto'];
    $forma_pago = $_POST['forma_pago'];
    $categoria = $_POST['categoria'];
    $nota = $_POST['nota'];
    $fecha = date("Y-m-d");

    // Seleccionamos la base de datos
    $datab = 'db_finanzas';
    $db = mysqli_select_db($connection, $datab);

    if (!$db) {
        echo 'No se encontró la base de datos';
    } else {
        // Crear la consulta SQL para actualizar el gasto
        $mensaje_SQL = "UPDATE gastos 
                        SET monto = '$monto', 
                            forma_pago = '$forma_pago', 
                            fecha = '$fecha', 
                            id_categoria = '$categoria', 
                            nota = '$nota' 
                        WHERE id_gasto = '$id_gasto' AND id_usuario = '$id_usu'";

        $resultado = mysqli_query($connection, $mensaje_SQL);

        if ($resultado) {
            // Si la actualización fue exitosa, redirigimos al listado de gastos
            header('Location: ../gasto.php');
            exit;
        } else {
            echo 'Error al actualizar el gasto: ' . mysqli_error($connection);
        }
    }
} else {
    echo 'Faltan datos para actualizar el gasto.';
}
?>


<?php
require 'modelo/conexion.php';
session_start();

// Verificar si el formulario ha sido enviado (si es POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegurarse de que el ID esté en el formulario
    if (isset($_POST['id_ingreso'])) {
        $idIngreso = $_POST['id_ingreso'];  // Obtener el ID del formulario
        $monto = $_POST['monto'];
        $formaPago = $_POST['forma_pago'];
        $fecha = $_POST['fecha'];
        $nota = $_POST['nota'];

        // Actualizamos el ingreso
        $query = "UPDATE ingresos SET monto = '$monto', forma_pago = '$formaPago', fecha = '$fecha', nota = '$nota' WHERE id_ingreso = '$idIngreso' AND id_usuario = '{$_SESSION['id_usuario']}'";
        
        if (mysqli_query($connection, $query)) {
            // Si la actualización es exitosa, redirigir al listado de ingresos
            header('Location: ingreso.php');
            exit;
        } else {
            echo "Error al actualizar: " . mysqli_error($connection);
        }
    } else {
        echo "No se ha recibido el ID del ingreso.";
    }
} else {
    // Si no es un POST, y está vacía la variable GET['id'], redirigir
    if (!isset($_GET['id'])) {
        header('Location: ingreso.php');
        exit;
    }
    
    $idIngreso = $_GET['id'];
    
    // Obtenemos el ingreso a editar
    $query = "SELECT monto, forma_pago, fecha, nota FROM ingresos WHERE id_ingreso = '$idIngreso' AND id_usuario = '{$_SESSION['id_usuario']}'";
    $resultado = mysqli_query($connection, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if (!$fila) {
        header('Location: ingreso.php');
        exit;
    }

    $monto = $fila['monto'];
    $formaPago = $fila['forma_pago'];
    $fecha = $fila['fecha'];
    $nota = $fila['nota'];
}
?>

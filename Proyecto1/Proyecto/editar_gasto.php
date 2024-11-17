<?php
require 'modelo/conexion.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos los datos del formulario
    $idGasto = $_POST['id_gasto'];
    $monto = $_POST['monto'];
    $formaPago = $_POST['forma_pago'];
    $fecha = $_POST['fecha'];
    $categoriaId = $_POST['categoria'];
    $nota = $_POST['nota'];

    // Actualizamos el gasto en la base de datos
    $query = "UPDATE gastos SET monto = ?, forma_pago = ?, fecha = ?, id_categoria = ?, nota = ?
              WHERE id_gasto = ? AND id_usuario = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $monto, $formaPago, $fecha, $categoriaId, $nota, $idGasto, $_SESSION['id_usuario']);
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        // Si la actualización es exitosa, redirigimos al listado de gastos
        header('Location: gasto.php');
        exit();
    } else {
        echo "Error al actualizar el gasto: " . mysqli_error($connection);
    }
}

// Obtener los datos del gasto para editar
$idGasto = $_GET['id_gasto'];  // Obtener el ID del gasto desde la URL

$query = "SELECT g.monto, g.forma_pago, g.fecha, g.id_categoria, c.categoria, g.nota 
          FROM gastos AS g
          JOIN categorias AS c ON g.id_categoria = c.id_categoria
          WHERE g.id_gasto = ? AND g.id_usuario = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 'ii', $idGasto, $_SESSION['id_usuario']);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 0) {
    echo "Gasto no encontrado.";
    exit();
}

$fila = mysqli_fetch_assoc($resultado);
$monto = $fila['monto'];
$formaPago = $fila['forma_pago'];
$fecha = $fila['fecha'];
$categoriaId = $fila['id_categoria'];
$categoria = $fila['categoria'];
$nota = $fila['nota'];

mysqli_free_result($resultado);
?>

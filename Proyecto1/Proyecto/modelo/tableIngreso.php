<?php
require 'conexion.php';
global $connection;
$id_usu = $_SESSION['id_usuario'];

$query = "SELECT i.id_ingreso, i.monto, i.forma_pago, i.fecha, i.nota 
          FROM ingresos AS i
          JOIN usuarios AS u ON i.id_usuario = u.id_usuario
          WHERE i.id_usuario = '$id_usu'";
          
// Mostrar mensaje de éxito si existe uno en la sesión
if (isset($_SESSION['mensaje'])) {
    echo '<div class="alert alert-success" role="alert">';
    echo $_SESSION['mensaje'];
    echo '</div>';
    unset($_SESSION['mensaje']);  // Limpiar el mensaje después de mostrarlo
}

// Mostrar mensaje de error si existe uno en la sesión
if (isset($_SESSION['mensaje_error'])) {
    echo '<div class="alert alert-danger" role="alert">';
    echo $_SESSION['mensaje_error'];
    echo '</div>';
    unset($_SESSION['mensaje_error']);  // Limpiar el mensaje después de mostrarlo
}
$resultado = mysqli_query($connection, $query);
while ($fila = mysqli_fetch_assoc($resultado)) {
    $idIngreso = $fila['id_ingreso'];  // Asignamos el ID del ingreso
    $monto = $fila['monto'];
    $formaPago = $fila['forma_pago'];
    $fecha = $fila['fecha'];
    $nota = $fila['nota'];

    // Formateo de la fecha
    $fechaDateTime = new DateTime($fecha);
    $locale = Locale::getDefault();
    $formatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $fechaFormateada = $formatter->format($fechaDateTime);
    ?>
    <tr>
        <td>$<?php echo $monto; ?></td>
        <td><?php echo $formaPago; ?></td>
        <td><?php echo $fechaFormateada; ?></td>
        <td><?php echo $nota; ?></td>
        <td>
        <div class="d-flex">
            <!-- Botón para editar -->
            <button class="btn btn-success me-2" onclick="editIngreso('<?php echo $idIngreso; ?>', '<?php echo $monto; ?>', '<?php echo $formaPago; ?>', '<?php echo $fecha; ?>', '<?php echo $nota; ?>')">
                Editar
            </button>

            <!-- Botón para eliminar -->
            <a href="eliminar_ingreso.php?id=<?php echo $idIngreso; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este ingreso?')">
                Eliminar
            </a>
        </div>
        
    </td>
</tr>
<?php
}
mysqli_free_result($resultado);
?>
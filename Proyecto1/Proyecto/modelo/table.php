<?php
require 'conexion.php';
global $connection;
$id_usu = $_SESSION['id_usuario'];

$query = "SELECT g.id_gasto, g.monto, g.forma_pago, g.fecha, c.categoria, g.nota 
          FROM gastos AS g
          JOIN categorias AS c ON g.id_categoria = c.id_categoria
          WHERE g.id_usuario = $id_usu";

$resultado = mysqli_query($connection, $query);
while ($fila = mysqli_fetch_assoc($resultado)) {
    $idGasto = $fila['id_gasto'];
    $monto = $fila['monto'];
    $formaPago = $fila['forma_pago'];
    $fecha = $fila['fecha'];
    $categoria = $fila['categoria'];
    $nota = $fila['nota'];

    // Formatear la fecha
    $fechaDateTime = new DateTime($fecha);
    $locale = Locale::getDefault();
    $formatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $fechaFormateada = $formatter->format($fechaDateTime);

    ?>
    <tr>
        <td>$<?php echo $monto; ?></td>
        <td><?php echo $formaPago; ?></td>
        <td><?php echo $fechaFormateada; ?></td>
        <td><?php echo $categoria; ?></td>
        <td><?php echo $nota; ?></td>
        <td>
            <div class="d-flex">
                <!-- Botón de editar -->
                <button class="btn btn-success me-2" onclick="editIngreso('<?php echo $idGasto; ?>', '<?php echo $monto; ?>', '<?php echo $formaPago; ?>', '<?php echo $categoria; ?>', '<?php echo $nota; ?>')">Editar</button>
                <!-- Botón de eliminar -->
                <a href="eliminar_ingreso.php?id=<?php echo $idGasto; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este gasto?')">
                    Eliminar
                </a>
            </div>
        </td>
    </tr>
<?php
}
mysqli_free_result($resultado);
?>

<?php
    // Iniciar sesión y verificar si el usuario está logueado
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("Location:index.php");
    }
    // Obtener los datos del usuario desde la sesión
    $nombre = $_SESSION['nombre'];
    $fotoPerfil = $_SESSION['foto_perfil']; 
    $rutaFotoPerfil = "fotos/" . $fotoPerfil;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="fotos/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="css/gasto/mobile.css">
    <link rel="stylesheet" href="css/gasto/style.css">
    <!-- font icons -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-straight/css/uicons-thin-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=B612&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=B612:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=B612:wght@700&display=swap" rel="stylesheet">
   <!-- Título de la página -->
    <title>Gasto</title>
</head>
<body>
     <!-- Barra de navegación -->
    <header>
        <nav class="navcontainer">
            <div class="logo">
                <figure class="logo__icon">
                <img src="logo.png" alt="Logo" class="logo__img">
                </figure>
                <p class="logo__text">Control de Datos</p>
            </div>
            <span class="navcontainer__line"></span>
            <ul class="list">
                <span class="list__title">Home</span>
                <li class="list__item">
                    <a href="./inicio.php" class="list__link">
                        <i class="fi fi-sr-dashboard list__img"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <span class="list__title">Finanzas</span>
                <li class="list__item">
                    <a href="./ingreso.php" class="list__link">
                        <i class="fi fi-sr-coins list__img"></i>
                        <p>ingresos</p>
                    </a>
                </li>
                <li class="list__item">
                    <a href="./gasto.php" class="list__link">
                        <i class="fi fi-sr-hand-holding-usd list__img"></i>
                        <p>Gastos</p>
                    </a>
                </li>
                <li class="list__item">
                    <a href="./balance.php" class="list__link">
                        <i class="fi fi-rr-chart-histogram list__img"></i>
                        <p>Balance</p>
                    </a>
                </li>
                <span class="list__title">Otros</span>
                <li class="list__item">
                    <a href="configuracion.php" class="list__link">
                        <i class="fi fi-br-gears list__img"></i>
                        <p>Configuracion</p>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
          <!-- Información del usuario -->
        <div class="head-container">
            <div class="user">
                <p class="user__name"><?php echo $nombre;?></p>
                <div class="user__img">
                    <img src="<?php echo $rutaFotoPerfil;?>" alt="" class="image">
                </div>
                <a href="modelo/logout.php" class="user__link"><i class="fi fi-rr-sign-out-alt exit"></i></a>
            </div>
        </div>
        <section class="spend">
            <p class="spend__title">GASTOS</p>
            <div class="btn-container">
                <button class="btn-container__btn" id="openModalBtn">
                    <i class="fi fi-rr-plus btn-add"></i>
                    <p>Agregar nuevo gasto</p>
                </button>
                <!-- modal añadir gastos-->
                <div id="Modal" class="modal">
                    <div class="modal-content">
                      <span class="close">&times;</span>
                      <h2 class="modal__title">Agregar nuevo Gasto</h2>
                      <form class="modal__form" onsubmit="return validateForm()" action="./modelo/registroGasto.php" method="POST">
                            <div class="input">
                            <span>s/</span>
                            <input type="text" id="montoInput" placeholder="Monto" required name="monto">
                            </div>
                            <div class="input">
                            <span><i class="fi fi-rr-handshake"></i></span>
                            <input type="text" id="formaPagoInput" placeholder="Forma de pago" name="forma_pago" required>
                            </div>
                            <div class="input">
                            <span><i class="fi fi-sr-tags"></i></span>
                            <select id="select" class="input-select" name="categoria" required>
                                <option selected disabled>Elige una categoría</option>
                                <option value="1">Comida</option>
                                <option value="2">Transporte</option>
                                <option value="3">Vivienda</option>
                                <option value="4">Entretenimiento</option>
                                <option value="5">Otros</option>
                            </select>
                            </div>
                            <div class="input-note">
                            <label for="note">Nota</label>
                            <textarea id="note" cols="30" rows="10" class="textarea" name="nota" required></textarea>
                            </div>
                            <input type="submit" value="Añadir" class="modal-btn-add">
                      </form>
                    </div>
                </div>
            </div>
                <!-- Modal for Editing a Gasto -->
                <div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h2 class="modal__title">Editar Gasto</h2>
                    <form class="modal__form" action="editar_gasto.php" method="POST">
                    <form action="gasto.php" method="POST" id="editGastoForm">
                        <input type="hidden" id="editIdGasto" name="id_gasto">
                        <div class="input">
                            <span>s/</span>
                            <input type="text" id="editMonto" name="monto" required>
                        </div>
                        <div class="input">
                            <span><i class="fi fi-rr-handshake"></i></span>
                            <input type="text" id="editFormaPago" name="forma_pago" required>
                        </div>
                        <div class="input">
                            <span><i class="fi fi-sr-tags"></i></span>
                            <select id="editCategoria" name="categoria" required>
                                <option selected disabled>Elige una categoría</option>
                                <option value="1">Comida</option>
                                <option value="2">Transporte</option>
                                <option value="3">Vivienda</option>
                                <option value="4">Entretenimiento</option>
                                <option value="5">Otros</option>
                            </select>
                        </div>
                        <div class="input-note">
                            <label for="editNota">Nota</label>
                            <textarea id="editNota" name="nota" required></textarea>
                        </div>
                        <input type="submit" value="Guardar cambios" class="modal-btn-add">
                    </form>
                </div>
            </div>
             <!-- Tabla para mostrar los gastos registrados -->
            <div class="table-container">
                <div class="container">
                    <div class="table-container__information">
                        <i class="fi fi-sr-hand-holding-usd table-container__gast-img"></i>
                        <div class="table-container__texts">
                            <p>Total de Gastos</p>
                            <p class="text">-<span>S/</span><?php require 'modelo/total.php' ?></p>
                        </div>
                    </div>
                    <div class="table-container__cta">
                        <p>Filtrar</p>
                        <select class="select-container" id="input-select">
                            <option selected disabled>Categoría</option>
                            <option value="1">Comida</option>
                            <option value="2">Transporte</option>
                            <option value="3">Vivienda</option>
                            <option value="4">Entretenimiento</option>
                            <option value="5">Otros</option>
                        </select>
                    </div>
                </div>
                <div class="table-container__table">
                    <table class="table table-dark table-striped">
                        <thead>
                            <th>Monto</th>
                            <th>Forma de pago</th>
                            <th>Fecha</th>
                            <th>Categoria</th>
                            <th>Nota</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody id="gastos-table-body">
                            <?php
                                require 'modelo/table.php';
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <script>
        // Función para abrir el modal de edición y cargar los datos del gasto
        function editIngreso(id_gasto, monto, forma_pago, categoria, nota) {
            // Mostrar el modal
            document.getElementById("editModal").style.display ="block";

            // Rellenar el formulario con los datos del gasto
            document.getElementById("editIdGasto").value = id_gasto;
            document.getElementById("editMonto").value = monto;
            document.getElementById("editFormaPago").value = forma_pago;
            document.getElementById("editNota").value = nota;

            // Aquí asignamos la categoría seleccionada en el select
            let categoriaSelect = document.getElementById("editCategoria");
            // Establecer la opción seleccionada en el select
            categoriaSelect.value = categoria; // Esto debe coincidir con el valor de las opciones en el select
        }
        // Función para cerrar el modal
        function closeEditModal() {
            document.getElementById("editModal").style.display = "none";
        }
    </script>

</body>
</html>
<script type="module" src="./js/gasto/modal.js"></script>
<!-- <script src="./js/gasto/listModal.js"></script> -->
<script src="./js/gasto/mobile.js"></script>
<script type="module" src="./js/gasto/validate.js"></script>

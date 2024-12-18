<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("Location:index.php");
    }
  // Recupera el nombre del usuario y la foto de perfil desde la sesión
    $nombre = $_SESSION['nombre'];
    require_once 'modelo/config.php';
  // Recupera el nombre del archivo de la foto de perfil desde la sesión y construye la ruta completa
    $fotoPerfil = $_SESSION['foto_perfil']; 
    $rutaFotoPerfil = "fotos/" . $fotoPerfil;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon para la página -->
    <link rel="shortcut icon" href="fotos/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="css/gasto/mobile.css">
    <link rel="stylesheet" href="css/gasto/style.css">
    <link rel="stylesheet" href="css/configuracion/configuracion.css">
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

    <title>Gasto</title>
</head>
<body>
    <header>
         <!-- Barra de navegación superior con enlaces a distintas secciones -->
        <nav class="navcontainer">
            <div class="logo">
                <figure class="logo__icon">
                <img src="logo.png" alt="Logo" class="logo__img">
                </figure>
                <p class="logo__text">Control de Datos</p>
            </div>
            <span class="navcontainer__line"></span>
            <ul class="list">
                 <!-- Menú de navegación con enlaces a diferentes secciones del sistema -->
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
                    <a href="#" class="list__link">
                        <i class="fi fi-br-gears list__img"></i>
                        <p>Configuracion</p>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        
    <div class="configuracion">
        <div class="configuracion__title">
            <p>Editar Perfil</p>
            <figure class="img-container">
                <!-- Tu imagen de perfil -->
                <img src="<?php echo $rutaFotoPerfil;?>" alt="foto del perfil">
                <div class="configuracion__icon">
                    <i class="fi fi-sr-camera"></i>
                </div>
            </figure>
        </div>
        <form  class="form" method="POST">
            <div class="form__data">
                <div class="form__input">
                    <label for="nombre">Nombre de usuario</label>
                    <!-- Rellena el campo de entrada con el nombre actual del usuario -->
                    <input type="text" name="nombre" id="name"value="<?php echo $datosUsuario['nombre']; ?>"required readonly>
                </div>
                <div class="form__input">
                    <label for="correo">Correo</label>
                    <!-- Rellena el campo de entrada con el correo electrónico actual del usuario -->
                    <input type="email" name="correo" id="email" value="<?php echo $datosUsuario['correo']; ?>"required readonly>
                </div>
            </div>
            <div class="passwor">
                <div class="form__pass">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="pass" value="<?php echo $datosUsuario['password'];?>" required readonly>
                </div>
                <div class="form__pass">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" name="confirm_password" id="confirm_pass" required readonly>
                </div>
                <div class="form__cta">
                    <input type="checkbox" id="showPassword">
                    <label for="showPassword">Mostrar contraseñas</label>
                </div>
                <div id="error-message"></div>
            </div>
            <div class="form__btns">
                <input type="button" id="editButton" value="Editar">
                <input type="submit" value="Guardar" id="submitButton" style="display: none;">
            </div>
        </form>
    </div>
</main>
</body>
</html>
<!-- Script que maneja la visibilidad de las contraseñas al hacer clic en el checkbox "Mostrar contraseñas" -->
<script src="./js/configuracion/showpass.js"></script>
<?php
 // Inicia una sesión para gestionar datos del usuario en todas las páginas
    session_start();
// Verifica si el usuario no ha iniciado sesión. Si no es así, redirige al login (index.php)
    if(!isset($_SESSION['id_usuario'])){
        header("Location:index.php");
    }
 // Recupera el nombre y foto de perfil del usuario desde la sesión
    $nombre = $_SESSION['nombre'];
    $fotoPerfil = $_SESSION['foto_perfil']; 
    $rutaFotoPerfil = "fotos/" . $fotoPerfil;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadatos esenciales para la página (código de caracteres, vista móvil y favicon) -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="fotos/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="css/gasto/mobile.css">
    <link rel="stylesheet" href="css/inicio/inicio.css">
    <link rel="stylesheet" href="css/inicio/style.css">
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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Inicio</title><!-- Título de la página en la pestaña del navegador -->
</head>
<body>
    <header>
         <!-- Barra de navegación superior con acceso a distintas secciones -->
        <nav class="navcontainer">
            <div class="logo">
                <figure class="logo__icon">
                <img src="logo.png" alt="Logo" class="logo__img">
                </figure>
                <p class="logo__text">Control de Datos</p>
            </div>
            <span class="navcontainer__line"></span>
            <ul class="list">
                  <!-- Menú de navegación con enlaces a otras secciones del sistema -->
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
          <!-- Contenedor principal del cuerpo de la página -->
        <div class="head-container">
            <div class="user">
                <!-- Muestra el nombre del usuario y su foto de perfil -->
                <p class="user__name"><?php echo $nombre;?></p>
                <div class="user__img">
                    <img src="<?php echo $rutaFotoPerfil;?>" alt="" class="image">
                </div>
                 <!-- Enlace para cerrar sesión -->
                <a href="modelo/logout.php" class="user__link"><i class="fi fi-rr-sign-out-alt exit"></i></a>
            </div>
        </div>
        <section class="spend">
              <!-- Título principal de la sección -->
            <p class="spend__title">INICIO</p>
            <div class="bienvenida">
                <i class="fi fi-rr-hand-wave"></i>
                <p>Bienvenido de nuevo! <span><?php echo $nombre;?></span></p>
            </div>
            <div class="card-container">
                <div class="card green">
                    <div class="card__text">
                        <p class="card__green">Ingreso Total</p>
                        <span>S/<?php require 'modelo/totalIngreso.php' ?></span>
                    </div>
                    
                    <div class="icon">
                        <i class="fi fi-br-dollar"></i>
                    </div>
                </div>
                <div class="card red">
                    <div class="card__text">
                        <p class="card__red">Gasto Total</p>
                        <span>S/<?php require 'modelo/total.php' ?></span>
                    </div>
                    <div class="icon">
                        <i class="fi fi-sr-piggy-bank"></i>
                    </div>
                </div>
                <div class="card blue">
                    <div class="card__text">
                        <p class="card__blue">Presupuesto total</p>
                        <span>S/500,00</span>
                    </div>
                    <div class="icon">
                        <i class="fi fi-sr-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
            <div class="circle-table">
                <div class="info-container">
                     <!-- Gráfico circular con datos financieros -->
                    <p>Grafico circular Finanziero</p>
                    <div class="circle-table__text">
                        <ul>
                            <li><div class="circle circle__green"></div>Ingreso Total</li>
                            <li><div class="circle circle__red"></div>Gasto Total</li>
                            <li><div class="circle circle__blue"></div>Presupuesto Total</li>
                        </ul>
                    </div>
                </div>
                <div class="circle-container">
                    <!-- grafico circular -->
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
<script src="js/inicio/circ.js"></script>


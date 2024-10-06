-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2023 a las 22:46:07
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_finanzas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Alimentos'),
(2, 'Transporte'),
(3, 'Vivienda'),
(4, 'Entretenimiento'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id_gasto` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `forma_pago` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nota` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id_gasto`, `id_usuario`, `monto`, `forma_pago`, `fecha`, `id_categoria`, `nota`) VALUES


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_ingreso` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `forma_pago` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `nota` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingreso`, `id_usuario`, `monto`, `forma_pago`, `fecha`, `nota`) VALUES
(1, 1, '50.00', 'checke', '2024-07-19', 'bono por hijo de mi trabajo'),
(2, 1, '100.000', 'giro', '2024-07-20', 'deuda de un prestamos celular'),
(3, 1, '300.000', 'paypal', '2024-07-20', 'saldo prestado a un familiar'),
(4, 2, '150.000', 'transferencia bancaria', '2024-07-20', 'deuda entre amigos'),
(5, 2, '165.000', 'giro', '2024-07-20', 'subsidio de transporte'),
(6, 1, '8.50', 'recarga', '2024-07-20', ' hicimos una recarga'),
(7, 2, '60.000', 'al contado', '2024-07-20', 'venta de licuadora'),


--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `foto_perfil`) VALUES
(1, 'laura Saavedra', 'laura@gmail.com', 'Lucas23%.com', 'usuario1.jpg'),
(2, 'Paula', 'Paula@gmail.com', 'Paula50%.rd', 'usuario1.jpg'),
(3, 'riko', 'riko@gmail.com', 'Rikos20@', 'usuario1.jpg'),
(4 'carlos', 'carlitos@gmail.com', 'Carlos23@', 'usuario1.jpg'),
(5, 'carla', 'carla@gmail.com', 'Luxor45@', 'usuario1.jpg'),
(6, 'maximo', 'maximo23@gmail.com', 'Maximo99@', 'usuario1.jpg'),
(7, 'rocio', 'rocio@gmail.com', 'Rocio12@', 'usuario1.jpg'),
(8, 'margot roci', 'margot@gmail.com', 'Margot20@', 'usuario1.jpg'),

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id_gasto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `gastos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

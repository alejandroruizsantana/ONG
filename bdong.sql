-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2026 a las 17:51:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdong`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_donante` varchar(100) DEFAULT NULL,
  `email_donante` varchar(150) DEFAULT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `fecha_donacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `metodo_pago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`id`, `id_usuario`, `nombre_donante`, `email_donante`, `cantidad`, `fecha_donacion`, `metodo_pago`) VALUES
(1, 1, 'alejandro', '', 10.00, '2026-06-08 11:28:06', 'tarjeta'),
(2, 1, 'alejandro', '', 50.00, '2026-06-08 11:32:06', 'tarjeta'),
(3, 1, 'alejandro', '', 10.00, '2026-06-08 11:41:28', 'tarjeta'),
(4, NULL, 'pepito1', 'pepito1@gmail.com', 25.00, '2026-06-08 11:42:32', 'tarjeta'),
(5, 2, 'pepito', '', 50.00, '2026-06-08 11:43:08', 'tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_quedada` int(11) NOT NULL,
  `fecha_inscripcion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `id_usuario`, `id_quedada`, `fecha_inscripcion`) VALUES
(2, 2, 2, '2026-05-06 09:57:06'),
(6, 2, 3, '2026-05-06 10:18:11'),
(8, 2, 6, '2026-05-06 10:19:38'),
(9, 2, 4, '2026-05-06 10:19:41'),
(14, 2, 1, '2026-06-08 10:16:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos`
--

CREATE TABLE `objetivos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `monto_objetivo` decimal(10,2) NOT NULL,
  `monto_conseguido` decimal(10,2) DEFAULT 0.00,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `objetivos`
--

INSERT INTO `objetivos` (`id`, `titulo`, `descripcion`, `monto_objetivo`, `monto_conseguido`, `fecha_inicio`, `fecha_fin`, `activo`, `fecha_creacion`) VALUES
(1, 'Campamento de Cría Seguro 2026', 'Financiación para el vallado térmico y suministros médicos del nuevo centro de Doñana.', 5000.00, 145.00, '2026-01-01', '2026-12-31', 1, '2026-06-08 15:11:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quedadas`
--

CREATE TABLE `quedadas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `plazas_totales` int(11) NOT NULL,
  `plazas_ocupadas` int(11) DEFAULT 0,
  `estado` varchar(50) NOT NULL DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `quedadas`
--

INSERT INTO `quedadas` (`id`, `titulo`, `descripcion`, `fecha`, `hora_inicio`, `hora_fin`, `ubicacion`, `provincia`, `plazas_totales`, `plazas_ocupadas`, `estado`) VALUES
(1, 'Limpieza Sierra de Andújar', 'Jornada de limpieza en el corazón del hábitat del lince. .', '2026-07-27', '09:00:00', '14:00:00', 'Sierra de Andújar', '0', 60, 1, 'disponible'),
(2, 'Reforestación Doñana', 'Plantaremos especies autóctonas para ampliar las zonas de refugio del lince ibérico.', '2026-08-12', '08:30:00', '13:00:00', 'Parque Nacional de Doñana', 'Huelva', 30, 2, 'disponible'),
(3, 'Limpieza Sierra Morena', 'Retiraremos plásticos y residuos de las riberas que atraviesan el territorio lincero.', '2026-10-10', '07:00:00', '12:00:00', 'Sierra Morena', '0', 35, 1, 'disponible'),
(4, 'Jornada Familiar Montes de Toledo', 'Actividad para toda la familia con talleres educativos sobre el lince y limpieza de senderos.', '2026-11-08', '08:00:00', '14:00:00', 'Montes de Toledo', 'Toledo', 10, 2, 'disponible'),
(5, 'Limpieza Nocturna Extremadura', 'Experiencia única: limpieza al atardecer con posibilidad de avistamiento de fauna.', '2026-12-11', '18:00:00', '22:00:00', 'Monfragüe', 'Cáceres', 20, 1, 'archivada'),
(6, 'Maratón de Limpieza Portugal', 'Gran evento transfronterizo para limpiar el corredor ecológico España-Portugal', '2026-10-11', '08:00:00', '18:00:00', 'Vale do Guadiana', 'Portugal', 25, 1, 'disponible'),
(7, 'Limpieza Sierra Morena', 'Limpieza hábitat de Sierra Morena , linces  ibéricos.', '2027-02-05', '01:00:00', '12:00:00', 'Sierra Morena', 'Jaén', 30, 0, 'archivada'),
(8, 'Conservación y Limpieza Montes de Toledo', 'Ayúdanos a retirar residuos y mantener libres de contaminación los senderos clave de la sierra.', '2026-11-14', '08:00:00', '13:30:00', 'Los Navalucillos', '0', 42, 0, 'archivada'),
(9, 'Limpieza y Conservación del Entorno Natural en Sierra Morena', 'Jornada activa orientada a la recogida de residuos plásticos.', '2026-10-10', '08:00:00', '14:00:00', 'Sierra Morena', '0', 40, 0, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto_perfil` varchar(255) DEFAULT 'avatar_fefault.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `contrasena`, `rol`, `fecha_registro`, `foto_perfil`) VALUES
(1, 'alejandro', 'alejandro.ars300@gmail.com', '$2y$10$84oqCqclkbG9sVdFUxeUCeX1J4CUmV6bOMuAed9UlUk/4iCcePoGa', 'admin', '2026-05-05 16:41:11', 'avatar_default.jpg'),
(2, 'pepito', 'pepito1234@gmail.com', '$2y$10$SpHGENB13UqpWCt99YzyCOc2UrKb19.qJttUumM8JlQ/KkxpDdrRq', 'usuario', '2026-05-05 16:42:03', 'perfil_2_1780913242.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`id_quedada`),
  ADD KEY `id_quedada` (`id_quedada`);

--
-- Indices de la tabla `objetivos`
--
ALTER TABLE `objetivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `quedadas`
--
ALTER TABLE `quedadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `objetivos`
--
ALTER TABLE `objetivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quedadas`
--
ALTER TABLE `quedadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`id_quedada`) REFERENCES `quedadas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-03-2026 a las 05:42:13
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ips_alma_vida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `numero_documento` varchar(50) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(11) NOT NULL,
  `eps` varchar(100) NOT NULL,
  `contacto_adicional` varchar(150) DEFAULT NULL,
  `parentesco` varchar(50) DEFAULT NULL,
  `tipo_examen` varchar(50) NOT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `empresa_solicita` varchar(150) NOT NULL,
  `fecha_examen` date NOT NULL,
  `hora_examen` time DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'Pendiente',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre_completo`, `tipo_documento`, `numero_documento`, `direccion`, `telefono`, `celular`, `fecha_nacimiento`, `edad`, `eps`, `contacto_adicional`, `parentesco`, `tipo_examen`, `doctor`, `empresa_solicita`, `fecha_examen`, `hora_examen`, `estado`, `fecha_registro`) VALUES
(2, 'prueba', 'CC', '1234', '', '', '30000', '2026-03-09', 28, 'ss', '', '', 'Ingreso', NULL, 'ss', '2026-03-10', NULL, 'Anulado', '2026-03-10 02:46:37'),
(3, 'prueba', 'CC', '1234', '', '', '3000', '2026-03-14', 23, 'sura', '', '', 'Egreso', 'Pedro', 'sura', '2026-03-15', '08:00:00', 'Anulado', '2026-03-13 23:02:04'),
(4, 'prueba 2', 'CC', '4321', '', '', '3000', '2026-03-05', 24, 'sura', '', '', 'Ingreso', 'Pedro', 'sura', '2026-03-15', '09:00:00', 'Pendiente', '2026-03-13 23:03:15'),
(5, 'prueba 3', 'CC', '4321', '', '', '3000', '2026-03-12', 24, 'sura', '', '', 'Periodico', 'Samanta', 'sura', '2026-03-14', '08:00:00', 'Hecho', '2026-03-13 23:04:29'),
(6, 'prueba 4', 'CC', '1234', '', '', '3000', '2026-02-26', 23, 'sura', '', '', 'Ingreso', 'Pedro', 'sura', '2026-03-15', '10:00:00', 'Pendiente', '2026-03-13 23:18:50'),
(7, 'prueba 5', 'CC', '1234', '', '', '3000', '2026-03-05', 23, 'sura', '', '', 'Periodico', 'Pedro', 'sura', '2026-03-14', '15:00:00', 'Pendiente', '2026-03-13 23:19:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES
(1, 'Administrador', 'admin@almavida.com', 'admin123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

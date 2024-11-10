-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2024 a las 22:06:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `erazo_valencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprobaciones`
--

CREATE TABLE `aprobaciones` (
  `id` int(11) NOT NULL,
  `reporte_id` int(11) NOT NULL,
  `aprobado_por` int(11) DEFAULT NULL,
  `status` enum('aprobado','corregir') NOT NULL,
  `comentario` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprobaciones`
--

INSERT INTO `aprobaciones` (`id`, `reporte_id`, `aprobado_por`, `status`, `comentario`, `observaciones`, `fecha`) VALUES
(1, 1, 3, 'aprobado', 'Datos correctos', NULL, '2024-11-10 15:49:06'),
(2, 2, 3, 'corregir', 'Ajustar los bonos', NULL, '2024-11-10 15:49:06'),
(3, 3, 3, 'corregir', 'Por favor, realiza las correcciones necesarias.', NULL, '2024-11-10 18:38:05'),
(4, 4, 3, 'aprobado', '', NULL, '2024-11-10 18:38:28'),
(5, 5, 3, 'aprobado', '', NULL, '2024-11-10 18:38:31'),
(6, 6, 3, 'aprobado', '', NULL, '2024-11-10 18:38:33'),
(7, 7, 3, 'corregir', 'Por favor, realiza las correcciones necesarias.', NULL, '2024-11-10 20:03:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`) VALUES
(1, 'Ventas'),
(2, 'Producción'),
(3, 'Recursos Humanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biometrico`
--

CREATE TABLE `biometrico` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `biometrico`
--

INSERT INTO `biometrico` (`id`, `empleado_id`, `fecha_ingreso`, `fecha_salida`, `fecha_registro`) VALUES
(1, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 15:49:06'),
(2, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 15:49:06'),
(3, 3, '2024-11-10 07:30:00', '2024-11-10 16:30:00', '2024-11-10 15:49:06'),
(4, 4, '2024-11-10 08:15:00', '2024-11-10 17:15:00', '2024-11-10 15:49:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biometrico_historial`
--

CREATE TABLE `biometrico_historial` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `biometrico_historial`
--

INSERT INTO `biometrico_historial` (`id`, `empleado_id`, `fecha_ingreso`, `fecha_salida`, `fecha_registro`) VALUES
(1, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 17:30:00'),
(2, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 18:30:00'),
(3, 3, '2024-11-10 07:30:00', '2024-11-10 16:30:00', '2024-11-10 17:00:00'),
(4, 4, '2024-11-10 08:15:00', '2024-11-10 17:15:00', '2024-11-10 17:45:00'),
(5, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(6, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(7, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(8, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(9, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(10, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(11, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(12, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(13, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(14, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(15, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(16, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(17, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(18, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(19, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(20, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(21, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(22, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(23, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(24, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(25, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(26, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(27, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(28, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(29, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(30, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(31, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(32, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(33, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(34, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06'),
(35, 1, '2024-11-10 08:00:00', '2024-11-10 17:00:00', '2024-11-10 10:49:06'),
(36, 2, '2024-11-10 09:00:00', '2024-11-10 18:00:00', '2024-11-10 10:49:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `area_id`) VALUES
(1, 'Juan López', 1),
(2, 'Ana Méndez', 1),
(3, 'Pedro Ramírez', 2),
(4, 'Luisa Ortega', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `lider_id` int(11) NOT NULL,
  `fecha` date DEFAULT curdate(),
  `status` enum('borrador','enviado','aprobado','corregir') DEFAULT 'borrador',
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `lider_id`, `fecha`, `status`, `observacion`) VALUES
(1, 1, '2024-11-10', 'borrador', NULL),
(2, 2, '2024-11-10', 'enviado', NULL),
(3, 1, '2024-11-10', 'enviado', NULL),
(4, 1, '2024-11-10', 'aprobado', NULL),
(5, 1, '2024-11-10', 'aprobado', NULL),
(6, 1, '2024-11-10', 'aprobado', NULL),
(7, 1, '2024-11-10', 'enviado', NULL),
(8, 1, '2024-11-10', 'borrador', NULL),
(9, 1, '2024-11-10', 'borrador', NULL),
(10, 1, '2024-11-10', 'borrador', NULL),
(11, 1, '2024-11-10', 'borrador', NULL),
(12, 1, '2024-11-10', 'borrador', NULL),
(13, 1, '2024-11-10', 'borrador', NULL),
(14, 1, '2024-11-10', 'borrador', NULL),
(15, 1, '2024-11-10', 'borrador', NULL),
(16, 1, '2024-11-10', 'borrador', NULL),
(17, 1, '2024-11-10', 'borrador', NULL),
(18, 1, '2024-11-10', 'borrador', NULL),
(19, 1, '2024-11-10', 'borrador', NULL),
(20, 1, '2024-11-10', 'borrador', NULL),
(21, 1, '2024-11-10', 'borrador', NULL),
(22, 1, '2024-11-10', 'enviado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_detalle`
--

CREATE TABLE `reportes_detalle` (
  `id` int(11) NOT NULL,
  `reporte_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `turno` varchar(50) DEFAULT NULL,
  `bono` decimal(10,2) DEFAULT NULL,
  `proyecto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_detalle`
--

INSERT INTO `reportes_detalle` (`id`, `reporte_id`, `empleado_id`, `turno`, `bono`, `proyecto`) VALUES
(1, 1, 1, 'Mañana', 100.00, 'Proyecto A'),
(2, 1, 2, 'Tarde', 150.00, 'Proyecto A'),
(3, 2, 3, 'Noche', 120.00, 'Proyecto B'),
(4, 2, 4, 'Mañana', 130.00, 'Proyecto B'),
(5, 3, 1, 'diurno', 5000000.00, 'SAP0001'),
(6, 3, 2, 'diurno', 6000000.00, 'SAP0002'),
(7, 4, 1, '', 0.00, ''),
(8, 4, 2, '', 0.00, ''),
(9, 5, 1, '', 0.00, ''),
(10, 5, 2, '', 0.00, ''),
(11, 6, 1, '', 0.00, ''),
(12, 6, 2, '', 0.00, ''),
(13, 7, 1, '', 0.00, ''),
(14, 7, 2, '', 0.00, ''),
(15, 8, 1, '', 0.00, ''),
(16, 8, 2, '', 0.00, ''),
(17, 9, 1, '', 0.00, ''),
(18, 9, 2, '', 0.00, ''),
(19, 10, 1, '', 0.00, ''),
(20, 10, 2, '', 0.00, ''),
(21, 11, 1, '', 0.00, ''),
(22, 11, 2, '', 0.00, ''),
(23, 12, 1, '', 0.00, ''),
(24, 12, 2, '', 0.00, ''),
(25, 13, 1, '', 0.00, ''),
(26, 13, 2, '', 0.00, ''),
(27, 14, 1, '', 0.00, ''),
(28, 14, 2, '', 0.00, ''),
(29, 15, 1, '', 0.00, ''),
(30, 15, 2, '', 0.00, ''),
(31, 16, 1, '', 0.00, ''),
(32, 16, 2, '', 0.00, ''),
(33, 17, 1, '', 0.00, ''),
(34, 17, 2, '', 0.00, ''),
(35, 18, 1, '', 0.00, ''),
(36, 18, 2, '', 0.00, ''),
(37, 19, 1, '', 0.00, ''),
(38, 19, 2, '', 0.00, ''),
(39, 20, 1, '', 0.00, ''),
(40, 20, 2, '', 0.00, ''),
(41, 21, 1, 'diurno', 4500000.00, 'SAP Controller'),
(42, 21, 2, 'nocturno', 6000000.00, 'SAP Compras'),
(43, 22, 1, 'nocturno', 2500000.00, 'SAP1'),
(44, 22, 2, 'diurno', 3000000.00, 'SAP2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('lider','jefe_rh') NOT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `username`, `password`, `rol`, `area_id`) VALUES
(1, 'Carlos Pérez', 'cperez', '123456', 'lider', 1),
(2, 'María García', 'mgarcia', '482c811da5d5b4bc6d497ffa98491e38', 'lider', 2),
(3, 'Laura Fernández', 'lfernandez', '123456', 'jefe_rh', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprobaciones`
--
ALTER TABLE `aprobaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporte_id` (`reporte_id`),
  ADD KEY `aprobado_por` (`aprobado_por`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `biometrico`
--
ALTER TABLE `biometrico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `biometrico_historial`
--
ALTER TABLE `biometrico_historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lider_id` (`lider_id`);

--
-- Indices de la tabla `reportes_detalle`
--
ALTER TABLE `reportes_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporte_id` (`reporte_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `area_id` (`area_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprobaciones`
--
ALTER TABLE `aprobaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `biometrico`
--
ALTER TABLE `biometrico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `biometrico_historial`
--
ALTER TABLE `biometrico_historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `reportes_detalle`
--
ALTER TABLE `reportes_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprobaciones`
--
ALTER TABLE `aprobaciones`
  ADD CONSTRAINT `aprobaciones_ibfk_1` FOREIGN KEY (`reporte_id`) REFERENCES `reportes` (`id`),
  ADD CONSTRAINT `aprobaciones_ibfk_2` FOREIGN KEY (`aprobado_por`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `biometrico`
--
ALTER TABLE `biometrico`
  ADD CONSTRAINT `biometrico_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `biometrico_historial`
--
ALTER TABLE `biometrico_historial`
  ADD CONSTRAINT `biometrico_historial_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`lider_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `reportes_detalle`
--
ALTER TABLE `reportes_detalle`
  ADD CONSTRAINT `reportes_detalle_ibfk_1` FOREIGN KEY (`reporte_id`) REFERENCES `reportes` (`id`),
  ADD CONSTRAINT `reportes_detalle_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

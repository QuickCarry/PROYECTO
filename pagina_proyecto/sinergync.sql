-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2023 a las 01:04:49
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sinergync`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacencarry`
--

CREATE TABLE `almacencarry` (
  `IDCarry` int(11) NOT NULL,
  `Departamento` varchar(255) DEFAULT NULL,
  `Ruta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacencarry`
--

INSERT INTO `almacencarry` (`IDCarry`, `Departamento`, `Ruta`) VALUES
(1, 'Cerro Largo', 8),
(4, 'Lavalleja', 5),
(6, 'Salto', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `Matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camion`
--

INSERT INTO `camion` (`Matricula`) VALUES
('camion'),
('Camion1'),
('CamionPrue'),
('M1'),
('prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camioneta`
--

CREATE TABLE `camioneta` (
  `Matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camioneta`
--

INSERT INTO `camioneta` (`Matricula`) VALUES
('Camioneta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `Ci` int(11) NOT NULL,
  `NombreCompleto` varchar(255) DEFAULT NULL,
  `Horarios` varchar(255) DEFAULT NULL,
  `correo` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `cargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`Ci`, `NombreCompleto`, `Horarios`, `correo`, `contraseña`, `cargo`) VALUES
(58, 'Pintura Negra', '123', 'admin@gmail.com', 'asd', 'Chofer'),
(59, 'Cafe', '123', 'Matias@gmail.com', 'asd', 'Chofer'),
(69, 'Chofer', 'asdf', 'Chofer1@gmail.com', 'Chofer', 'Chofer'),
(70, 'Chofer ', 'Matutino', 'ChoferP@gmail.com', 'Chofer2', 'Chofer'),
(71, 'Camionero', 'Matutino', 'Chofer@gmail.com', 'Chofer', 'Chofer'),
(72, 'Camionero2', 'Matutino', 'Chofer2@gmail.com', 'Chofer2', 'Chofer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferdiashabiles`
--

CREATE TABLE `choferdiashabiles` (
  `DiasHabiles` varchar(255) DEFAULT NULL,
  `Ci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conduce`
--

CREATE TABLE `conduce` (
  `Ci` int(11) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `Estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `conduce`
--

INSERT INTO `conduce` (`Ci`, `Matricula`, `Estado`) VALUES
(58, 'CamionPrue', NULL),
(69, 'prueba', NULL),
(70, 'Camion1', 'En rumbo'),
(71, 'camion', 'Fuera de servicio'),
(72, 'Camioneta', 'En rumbo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarda`
--

CREATE TABLE `guarda` (
  `IdLote` int(11) NOT NULL,
  `IDCarry` int(11) NOT NULL,
  `IdRuta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llevaa`
--

CREATE TABLE `llevaa` (
  `IdRuta` int(11) NOT NULL,
  `IdCarry` int(11) NOT NULL,
  `FechaLLegada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `IdLote` int(11) NOT NULL,
  `EstadoLote` varchar(255) DEFAULT NULL,
  `fechaEstimada` date DEFAULT NULL,
  `DestinoLote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`IdLote`, `EstadoLote`, `fechaEstimada`, `DestinoLote`) VALUES
(16, 'En Camion', NULL, 'Colonia'),
(17, 'Cerrado', NULL, 'Treinta y Tres'),
(18, 'Cerrado', NULL, 'Florida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `IdPaquete` int(11) NOT NULL,
  `Peso` decimal(10,2) DEFAULT NULL,
  `Tipo` varchar(255) DEFAULT NULL,
  `Cliente` varchar(255) DEFAULT NULL,
  `Ubicacion` varchar(255) DEFAULT NULL,
  `FechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `Estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`IdPaquete`, `Peso`, `Tipo`, `Cliente`, `Ubicacion`, `FechaRegistro`, `Estado`) VALUES
(3, '12.00', 'Frágil', 'Pepe', 'Treinta y tres', '2023-09-22 18:01:00', 'En preparacion'),
(4, '10.00', 'Frágil', 'Agustin', 'Florida', '2023-09-22 18:01:00', 'En preparacion'),
(6, '12.00', 'Frágil', 'Pepe', 'Lavalleja', '2023-09-22 18:01:00', 'En preparacion'),
(7, '100.00', 'Frágil', 'Diego', 'Entregado', '0000-00-00 00:00:00', 'En camioneta'),
(8, '11.00', 'Frágil', 'Pablo', 'Melo', '2023-09-22 18:01:00', 'En preparacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenecen`
--

CREATE TABLE `pertenecen` (
  `IdPaquete` int(11) NOT NULL,
  `IdLote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pertenecen`
--

INSERT INTO `pertenecen` (`IdPaquete`, `IdLote`) VALUES
(3, 16),
(6, 17),
(4, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoge`
--

CREATE TABLE `recoge` (
  `FechaCarga` datetime NOT NULL,
  `FechaDescarga` datetime NOT NULL,
  `IdPaquete` int(11) NOT NULL,
  `Matricula` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `IdRuta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutanumero`
--

CREATE TABLE `rutanumero` (
  `IdRuta` int(11) NOT NULL,
  `nmrRuta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporta`
--

CREATE TABLE `transporta` (
  `IdLote` int(11) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `FechaEntrega` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transporta`
--

INSERT INTO `transporta` (`IdLote`, `Matricula`, `FechaEntrega`) VALUES
(16, 'camion', '2023-11-06 16:47:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `horario` varchar(13) NOT NULL,
  `dias_habiles` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contraseña`, `cargo`, `horario`, `dias_habiles`) VALUES
(60, 'Admin', 'istrador', 'Admin@gmail.com', 'root', 'Administrador', 'Matutino', 'Lunes - Viernes'),
(61, 'Funqui', 'Funchi', 'Funcionario@gmail.com', 'Funci123', 'Funcionario', 'Vespertino', 'Lunes - Viernes'),
(70, 'Chofer ', 'Prueba', 'ChoferP@gmail.com', 'Chofer2', 'Chofer', 'Matutino', 'Lunes - Jueves'),
(71, 'Camionero', '2', 'Chofer@gmail.com', 'Chofer', 'Chofer', 'Matutino', 'Lunes-viernes'),
(72, 'Camionero2', 'Cami', 'Chofer2@gmail.com', 'Chofer2', 'Chofer', 'Matutino', 'Lunes-viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vahacia`
--

CREATE TABLE `vahacia` (
  `IdPaquete` int(11) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `FechaEntrega` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vahacia`
--

INSERT INTO `vahacia` (`IdPaquete`, `Matricula`, `FechaEntrega`) VALUES
(8, '69', '2023-05-22 21:03:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `Matricula` varchar(10) NOT NULL,
  `Servicio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`Matricula`, `Servicio`) VALUES
('camion', 'En funcionamiento'),
('Camion1', 'En funcionamiento'),
('Camioneta', 'En 2do QuickCarry'),
('CamionPrue', 'En funcionamiento'),
('M1', 'Buen estado'),
('prueba', 'En funcionamiento');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacencarry`
--
ALTER TABLE `almacencarry`
  ADD PRIMARY KEY (`IDCarry`);

--
-- Indices de la tabla `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`Matricula`);

--
-- Indices de la tabla `camioneta`
--
ALTER TABLE `camioneta`
  ADD PRIMARY KEY (`Matricula`);

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD PRIMARY KEY (`Ci`);

--
-- Indices de la tabla `choferdiashabiles`
--
ALTER TABLE `choferdiashabiles`
  ADD PRIMARY KEY (`Ci`);

--
-- Indices de la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD PRIMARY KEY (`Ci`),
  ADD KEY `conduce_ibfk_2` (`Matricula`);

--
-- Indices de la tabla `guarda`
--
ALTER TABLE `guarda`
  ADD PRIMARY KEY (`IdLote`),
  ADD KEY `guarda_ibfk_2` (`IDCarry`);

--
-- Indices de la tabla `llevaa`
--
ALTER TABLE `llevaa`
  ADD PRIMARY KEY (`IdRuta`,`IdCarry`),
  ADD KEY `llevaa_ibfk_2` (`IdCarry`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`IdLote`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`IdPaquete`);

--
-- Indices de la tabla `pertenecen`
--
ALTER TABLE `pertenecen`
  ADD PRIMARY KEY (`IdPaquete`),
  ADD KEY `pertenecen_ibfk_2` (`IdLote`);

--
-- Indices de la tabla `recoge`
--
ALTER TABLE `recoge`
  ADD PRIMARY KEY (`IdPaquete`),
  ADD KEY `FK_MatriculaCamion` (`Matricula`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`IdRuta`);

--
-- Indices de la tabla `rutanumero`
--
ALTER TABLE `rutanumero`
  ADD PRIMARY KEY (`IdRuta`,`nmrRuta`);

--
-- Indices de la tabla `transporta`
--
ALTER TABLE `transporta`
  ADD PRIMARY KEY (`IdLote`),
  ADD KEY `transporta_ibfk_2` (`Matricula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vahacia`
--
ALTER TABLE `vahacia`
  ADD PRIMARY KEY (`IdPaquete`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`Matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `IdLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `choferdiashabiles`
--
ALTER TABLE `choferdiashabiles`
  ADD CONSTRAINT `choferdiashabiles_ibfk_1` FOREIGN KEY (`Ci`) REFERENCES `chofer` (`Ci`);

--
-- Filtros para la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD CONSTRAINT `conduce_ibfk_1` FOREIGN KEY (`Ci`) REFERENCES `chofer` (`Ci`),
  ADD CONSTRAINT `conduce_ibfk_2` FOREIGN KEY (`Matricula`) REFERENCES `vehiculo` (`Matricula`);

--
-- Filtros para la tabla `guarda`
--
ALTER TABLE `guarda`
  ADD CONSTRAINT `guarda_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `paquete` (`IdPaquete`),
  ADD CONSTRAINT `guarda_ibfk_2` FOREIGN KEY (`IDCarry`) REFERENCES `almacencarry` (`IDCarry`);

--
-- Filtros para la tabla `llevaa`
--
ALTER TABLE `llevaa`
  ADD CONSTRAINT `llevaa_ibfk_1` FOREIGN KEY (`IdRuta`) REFERENCES `ruta` (`IdRuta`),
  ADD CONSTRAINT `llevaa_ibfk_2` FOREIGN KEY (`IdCarry`) REFERENCES `almacencarry` (`IDCarry`);

--
-- Filtros para la tabla `pertenecen`
--
ALTER TABLE `pertenecen`
  ADD CONSTRAINT `pertenecen_ibfk_1` FOREIGN KEY (`IdPaquete`) REFERENCES `paquete` (`IdPaquete`),
  ADD CONSTRAINT `pertenecen_ibfk_2` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`IdLote`);

--
-- Filtros para la tabla `recoge`
--
ALTER TABLE `recoge`
  ADD CONSTRAINT `FK_MatriculaCamion` FOREIGN KEY (`Matricula`) REFERENCES `camion` (`Matricula`);

--
-- Filtros para la tabla `transporta`
--
ALTER TABLE `transporta`
  ADD CONSTRAINT `transporta_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`IdLote`),
  ADD CONSTRAINT `transporta_ibfk_2` FOREIGN KEY (`Matricula`) REFERENCES `vehiculo` (`Matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

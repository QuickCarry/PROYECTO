-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2023 a las 18:03:29
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
-- Base de datos: `sinergync`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenescarry`
--

CREATE TABLE `almacenescarry` (
  `IDCarry` int(11) NOT NULL,
  `Departamento` varchar(255) DEFAULT NULL,
  `Ruta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacenescarry`
--

INSERT INTO `almacenescarry` (`IDCarry`, `Departamento`, `Ruta`) VALUES
(0, 'Rocha', 8),
(2, 'Montevideo', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `Matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camioneta`
--

CREATE TABLE `camioneta` (
  `Matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferdiashabiles`
--

CREATE TABLE `choferdiashabiles` (
  `DiasHabiles` varchar(255) DEFAULT NULL,
  `Ci` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conduce`
--

CREATE TABLE `conduce` (
  `Ci` int(11) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `Estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarda`
--

CREATE TABLE `guarda` (
  `IdPaquete` int(11) NOT NULL,
  `IDCarry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llevaa`
--

CREATE TABLE `llevaa` (
  `IdRuta` int(11) NOT NULL,
  `IdCarry` int(11) NOT NULL,
  `FechaLLegada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `IdLote` int(11) NOT NULL,
  `EstadoLote` varchar(255) DEFAULT NULL,
  `DestinoLote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`IdLote`, `EstadoLote`, `DestinoLote`) VALUES
(2, 'En preparacion', 'Florida'),
(4, 'En preparacion', 'Florida'),
(5, 'En preparacion', 'Su casa'),
(6, 'En camino', 'Rocha');

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
  `FechaRegistro` varchar(20) NOT NULL DEFAULT current_timestamp(),
  `Estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`IdPaquete`, `Peso`, `Tipo`, `Cliente`, `Ubicacion`, `FechaRegistro`, `Estado`) VALUES
(2, '10.01', 'Peligroso', 'Pepito', 'Tacuarembo', '10/09', 'En preparacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenecen`
--

CREATE TABLE `pertenecen` (
  `IdPaquete` int(11) NOT NULL,
  `IdLote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `IdRuta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutanumero`
--

CREATE TABLE `rutanumero` (
  `IdRuta` int(11) NOT NULL,
  `nmrRuta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seleasigna`
--

CREATE TABLE `seleasigna` (
  `Matricula` varchar(10) NOT NULL,
  `IdRuta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contraseña`, `cargo`, `horario`, `dias_habiles`) VALUES
(60, 'Admin', 'istrador', 'Admin@gmail.com', 'root', 'Administrador', 'Matutino', 'Lunes - Viernes'),
(61, 'Funqui', 'Funchi', 'Funcionario@gmail.com', 'Funci123', 'Funcionario', 'Vespertino', 'Lunes - Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `Matricula` varchar(10) NOT NULL,
  `Servicio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenescarry`
--
ALTER TABLE `almacenescarry`
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
  ADD KEY `Ci` (`Ci`);

--
-- Indices de la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD PRIMARY KEY (`Ci`,`Matricula`),
  ADD KEY `Matricula` (`Matricula`);

--
-- Indices de la tabla `guarda`
--
ALTER TABLE `guarda`
  ADD PRIMARY KEY (`IdPaquete`,`IDCarry`),
  ADD KEY `IDCarry` (`IDCarry`);

--
-- Indices de la tabla `llevaa`
--
ALTER TABLE `llevaa`
  ADD PRIMARY KEY (`IdRuta`,`IdCarry`),
  ADD KEY `IdCarry` (`IdCarry`);

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
  ADD PRIMARY KEY (`IdPaquete`,`IdLote`),
  ADD KEY `IdLote` (`IdLote`);

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
-- Indices de la tabla `seleasigna`
--
ALTER TABLE `seleasigna`
  ADD PRIMARY KEY (`Matricula`,`IdRuta`),
  ADD KEY `IdRuta` (`IdRuta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `IdLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `IdPaquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
  ADD CONSTRAINT `guarda_ibfk_1` FOREIGN KEY (`IdPaquete`) REFERENCES `paquete` (`IdPaquete`),
  ADD CONSTRAINT `guarda_ibfk_2` FOREIGN KEY (`IDCarry`) REFERENCES `almacenescarry` (`IDCarry`);

--
-- Filtros para la tabla `llevaa`
--
ALTER TABLE `llevaa`
  ADD CONSTRAINT `llevaa_ibfk_1` FOREIGN KEY (`IdRuta`) REFERENCES `ruta` (`IdRuta`),
  ADD CONSTRAINT `llevaa_ibfk_2` FOREIGN KEY (`IdCarry`) REFERENCES `almacenescarry` (`IDCarry`);

--
-- Filtros para la tabla `pertenecen`
--
ALTER TABLE `pertenecen`
  ADD CONSTRAINT `pertenecen_ibfk_1` FOREIGN KEY (`IdPaquete`) REFERENCES `paquete` (`IdPaquete`),
  ADD CONSTRAINT `pertenecen_ibfk_2` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`IdLote`);

--
-- Filtros para la tabla `seleasigna`
--
ALTER TABLE `seleasigna`
  ADD CONSTRAINT `seleasigna_ibfk_1` FOREIGN KEY (`Matricula`) REFERENCES `vehiculo` (`Matricula`),
  ADD CONSTRAINT `seleasigna_ibfk_2` FOREIGN KEY (`IdRuta`) REFERENCES `ruta` (`IdRuta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

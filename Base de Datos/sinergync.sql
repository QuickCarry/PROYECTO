drop database sinergyncConsultas;
create database sinergyncConsultas;
use sinergyncConsulta;



-- Estructura de tabla para la tabla `almacencarry`
--

CREATE TABLE `almacencarry` (
  `IDCarry` int(11) NOT NULL primary key,
  `Departamento` varchar(255) NOT NULL,
  `Ruta` int(11) NOT NULL
) ;

ALTER TABLE `almacencarry` ADD CONSTRAINT chk_Idalmacencarry CHECK (`IDCarry`>0 );
ALTER TABLE `almacencarry` ADD CONSTRAINT chk_Depalmacen CHECK (`Departamento`<> '');
ALTER TABLE `almacencarry` ADD CONSTRAINT chk_Rutaalmacen CHECK (`Ruta`<> '');
--

-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `Matricula` varchar(10) NOT NULL primary key
) ;

--
ALTER TABLE `camion` ADD CONSTRAINT chk_Mcamion CHECK (`Matricula`<> '');

--
-- Estructura de tabla para la tabla `camioneta`
--

CREATE TABLE `camioneta` (
  `Matricula` varchar(10) NOT NULL primary key
) ;

ALTER TABLE `camioneta` ADD CONSTRAINT chk_Mcamioneta CHECK (`Matricula`<> '');


-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `Ci` int(11) NOT NULL primary key,
  `NombreCompleto` varchar(255) DEFAULT NULL,
  `Horarios` varchar(255) DEFAULT NULL,
  `correo` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `DiasHabiles` varchar(255) DEFAULT NULL
) ;

--
ALTER TABLE `chofer` ADD CONSTRAINT chk_CiChofer CHECK (`Ci`>0 );
ALTER TABLE `chofer` ADD CONSTRAINT chk_Nombrechofer CHECK (`NombreCompleto`<> '');
ALTER TABLE `chofer` ADD CONSTRAINT chk_Horarioschofer CHECK (`Horarios`<> '');
ALTER TABLE `chofer` ADD CONSTRAINT chk_Correochofer CHECK (`correo`<> '');
ALTER TABLE `chofer` ADD CONSTRAINT chk_ContraseñaChofer CHECK (`contraseña`<> '');
ALTER TABLE `chofer` ADD CONSTRAINT chk_Cargochofer CHECK (`cargo`<> '');
ALTER TABLE `chofer` ADD CONSTRAINT chk_DatosDiasHabiles CHECK (`DiasHabiles` IN('Lunes-Martes','Lunes-Miercoles','Lunes-Jueves','Lunes-Viernes','Lunes-Sabado',
'Martes-Miercoles','Martes-Jueves','Martes-Viernes','Martes-Sabado','Martes-Domingo',
'Miercoles-Jueves','Miercoles-Viernes','Miercoles-Sabado','Miercoles-Domingos','Miercoles-Lunes','Miercoles-Martes',
'Jueves-Viernes','Jueves-Sabado-','Jueves-Domingo','Jueves-Lunes','Jueves-Martes','Jueves-Miercoles',
'Viernes-Sabado','Viernes-Domingo','Viernes-Lunes','Viernes-Martes','Viernes-Miercoles','Viernes-Jueves',
'Sabado-Domingo','Sabado-Lunes','Sabado-Martes','Sabado-Miercoles','Sabado-Jueves','Sabado-Viernes',
'Domingo-Lunes','Domingo-Martes','Domingo-Miercoles','Domingo-Jueves','Domingo-Viernes','Domingo-Sabado'));

-- Estructura de tabla para la tabla `conduce`
--

CREATE TABLE `conduce` (
  `Ci` int(11) NOT NULL primary key,
  `Matricula` varchar(10) NOT NULL,
  `Estado` varchar(255) NOT NULL
) ;

--
ALTER TABLE `conduce` ADD CONSTRAINT chk_Ciconduce CHECK (`Ci`<> '');
ALTER TABLE `conduce` ADD CONSTRAINT chk_Cinotnullconduce CHECK (`Ci`>0);
ALTER TABLE `conduce` ADD CONSTRAINT chk_Estadoconduce CHECK (`Estado`<> '');
-- Volcado de datos para la tabla `conduce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarda`
--

CREATE TABLE `guarda` (
  `IdLote` int(11) NOT NULL primary key,
  `IDCarry` int(11) NOT NULL,
  `IdRuta` int(11) NOT NULL
) ;
--
ALTER TABLE `guarda` ADD CONSTRAINT chk_Idloteguarda CHECK (`IdLote`<> '');
ALTER TABLE `guarda` ADD CONSTRAINT chk_IDCarryguarda CHECK (`IDCarry`<> '');
ALTER TABLE `guarda` ADD CONSTRAINT chk_IdRutaguarda CHECK (`IdRuta`<> '');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llevaa`
--

CREATE TABLE `llevaa` (
  `IdRuta` int(11) NOT NULL,
  `IDCarry` int(11) NOT NULL,
  `FechaLLegada` timestamp NOT NULL DEFAULT current_timestamp()
) ;


-- --------------------------------------------------------
ALTER TABLE `llevaa` ADD CONSTRAINT chk_IdRutallevaa CHECK (`IdRuta`<> '');
ALTER TABLE `llevaa` ADD CONSTRAINT chk_IdCarryllevaa CHECK (`IDCarry`<> '');

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `IdLote` int(11) NOT NULL primary key,
  `EstadoLote` varchar(255) NOT NULL,
  `fechaEstimada` date DEFAULT NULL,
  `DestinoLote` varchar(255) NOT NULL
) ;

ALTER TABLE `lote` ADD CONSTRAINT chk_DestinoLote CHECK (`DestinoLote`<> '');
ALTER TABLE `lote` ADD CONSTRAINT chk_loteEstado CHECK (`EstadoLote` IN ('En Central','Cerrado','En camion','Entregado'));
--
-- Volcado de datos para la tabla `lote`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `IdPaquete` int(11) NOT NULL primary key,
  `Peso` decimal(10,2) NOT NULL,
  `Tipo` varchar(255) NOT NULL,
  `Cliente` varchar(255) NOT NULL,
  `Departamento` varchar(255) NOT NULL,
  `Ciudad` varchar(255) NOT NULL,
  `DestinoExacto` varchar(255) NOT NULL,
  `FechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `Estado` varchar(255) NOT NULL
) ;

ALTER TABLE `paquete` ADD CONSTRAINT chk_IdPaquete CHECK (`IdPaquete`<>(''));
ALTER TABLE `paquete` ADD CONSTRAINT chk_PesoPaquete CHECK (`Peso`>0);
ALTER TABLE `paquete` ADD CONSTRAINT chk_TipoPaquete CHECK (`Tipo`<>(''));
ALTER TABLE `paquete` ADD CONSTRAINT chk_ClientePaquete CHECK (`Cliente`<>(''));
ALTER TABLE `paquete` ADD CONSTRAINT chk_DepartamentoPaquete CHECK (`Departamento`<>(''));
ALTER TABLE `paquete` ADD CONSTRAINT chk_DestinoExactoPaquete CHECK (`DestinoExacto`<>(''));
ALTER TABLE `paquete` ADD CONSTRAINT chk_PaqueteEstado CHECK (`Estado` IN ('En lote','En QuickCarry','En Camioneta','Entregado'));
ALTER TABLE `paquete` ADD CONSTRAINT chk_NotNullEstadoPaquete CHECK (`Estado`<>(''));

-- --------------------------------------------------------



-- Estructura de tabla para la tabla `pertenecen`
--

CREATE TABLE `pertenecen` (
  `IdPaquete` int(11) NOT NULL primary key,
  `IdLote` int(11) NOT NULL
);

--
ALTER TABLE `pertenecen` ADD CONSTRAINT chk_pertenecenidpaquete CHECK (`IdPaquete`<>(''));
ALTER TABLE `pertenecen` ADD CONSTRAINT chk_pertenecenidlote CHECK (`IdLote`<>(''));
-- Volcado de datos para la tabla `pertenecen`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoge`
--

CREATE TABLE `recoge` (
  `FechaCarga` datetime NOT NULL,
  `FechaDescarga` datetime NOT NULL,
  `IdPaquete` int(11) NOT NULL primary key,
  `Matricula` varchar(11) NOT NULL
) ;

-- --------------------------------------------------------
ALTER TABLE `recoge` ADD CONSTRAINT chk_recogeIdPaquete CHECK (`IdPaquete`<>(''));
ALTER TABLE `recoge` ADD CONSTRAINT chk_recogeMatricula CHECK (`Matricula`<>(''));
--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `IdRuta` int(11) NOT NULL primary key
) ;
ALTER TABLE `ruta` ADD CONSTRAINT chk_rutaIdRuta CHECK (`IdRuta`<>(''));
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutanumero`
--

CREATE TABLE `rutanumero` (
  `IdRuta` int(11) NOT NULL,
  `nmrRuta` int(11) NOT NULL,
  PRIMARY KEY (`IdRuta`,`nmrRuta`)
);


-- --------------------------------------------------------
ALTER TABLE `rutanumero` ADD CONSTRAINT chk_Idrutanumero CHECK (`IdRuta`<>(''));
ALTER TABLE `rutanumero` ADD CONSTRAINT chk_rutanumero CHECK (`nmrRuta`<>(''));
--
-- Estructura de tabla para la tabla `transporta`
--

CREATE TABLE `transporta` (
  `IdLote` int(11) NOT NULL primary key,
  `Matricula` varchar(10) NOT NULL,
  `FechaEntrega` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
ALTER TABLE `transporta` ADD CONSTRAINT chk_IdLotetransporta CHECK (`IdLote`<>(''));
ALTER TABLE `transporta` ADD CONSTRAINT chk_Matriculatransporta CHECK (`Matricula`<>(''));

-- Volcado de datos para la tabla `transporta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL primary key,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `horario` varchar(13) NOT NULL,
  `dias_habiles` varchar(20) NOT NULL
) ;


ALTER TABLE `usuarios` ADD CONSTRAINT chk_nombreUsuario CHECK (`nombre`<>(''));
ALTER TABLE `usuarios` ADD CONSTRAINT chk_apellidoUsuario CHECK (`apellido`<>(''));
ALTER TABLE `usuarios` ADD CONSTRAINT chk_correoUsuario CHECK (`correo`<>(''));
ALTER TABLE `usuarios` ADD CONSTRAINT chk_contraseñaUsuario CHECK (`contraseña`<>(''));
ALTER TABLE `usuarios` ADD CONSTRAINT chk_cargoUsuario CHECK (`cargo`<>(''));
ALTER TABLE `usuarios` ADD CONSTRAINT chk_horarioUsuario CHECK (`horario`<>(''));
ALTER TABLE `usuarios` ADD CONSTRAINT chk_dias_habilesUsuario CHECK (`dias_habiles`<>(''));
-- Volcado de datos para la tabla `usuarios`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vahacia`
--

CREATE TABLE `vahacia` (
  `IdPaquete` int(11) NOT NULL primary key,
  `Matricula` varchar(10) NOT NULL,
  `FechaEntrega` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
ALTER TABLE `vahacia` ADD CONSTRAINT chk_IdPaquetevahacia CHECK (`IdPaquete`<>(''));
ALTER TABLE `vahacia` ADD CONSTRAINT chk_Matriculavahacia CHECK (`Matricula`<>(''));
-- Volcado de datos para la tabla `vahacia`
--


-- --------------------------------------------------------
-- creacion de la tabla de vehiculo
CREATE TABLE `vehiculo` (
  `Matricula` varchar(10) NOT NULL primary key,
  `Servicio` varchar(255) DEFAULT NULL
) ;

--
ALTER TABLE `vehiculo` ADD CONSTRAINT chk_Matriculavehiculo CHECK (`Matricula`<>(''));
ALTER TABLE `vehiculo` ADD CONSTRAINT chk_Serviciovehiculo CHECK (`Servicio`<>(''));
-- Volcado de datos para la tabla `vehiculo`
--

-- ----------------------------------------------------------------------------
-- no permita que un paquete pertenezca a un lote si tienen ubicacion de paquete y destino de lote distintos

DELIMITER //
CREATE TRIGGER antes_insertar_pertenecen
BEFORE INSERT ON pertenecen
FOR EACH ROW
BEGIN
    DECLARE Departamento_paquete varchar(255);
    DECLARE destino_lote varchar(255);

    -- Obtener la ubicación del paquete
    SELECT Departamento INTO Departamento_paquete
    FROM paquete
    WHERE IdPaquete = NEW.IdPaquete;

    -- Obtener el destino del lote
    SELECT DestinoLote INTO destino_lote
    FROM lote
    WHERE IdLote = NEW.IdLote;

    -- Verificar si la ubicación del paquete es igual al destino del lote
    IF Departamento_paquete <> destino_lote THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La ubicación del paquete no coincide con el destino del lote';
    END IF;
END;
//
DELIMITER ;
-- ----------------------------------------------------------------------------------------------
-- dos almacenes pertenezcan al mismo departamento. Aquí tienes un ejemplo de cómo podrías hacerlo:

DELIMITER //

CREATE TRIGGER antes_insertar_almacencarry
BEFORE INSERT ON almacencarry
FOR EACH ROW
BEGIN
    DECLARE existencia_departamento INT;

    -- Verificar si ya existe otro almacén en el mismo departamento
    SELECT COUNT(*) INTO existencia_departamento
    FROM almacencarry
    WHERE Departamento = NEW.Departamento AND IDCarry <> NEW.IDCarry;

    -- Si ya existe un almacén en el mismo departamento, lanzar una excepción
    IF existencia_departamento > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe un almacén en el mismo departamento';
    END IF;

END;
//

DELIMITER ;
-- --------------------------------------------------------------------------------------------------------------
-- un almacén no pueda tener un paquete y un lote si la ubicación del paquete y el destino del lote son distintos a la ubicación del almacén

DELIMITER //

CREATE TRIGGER antes_insertar_guarda
BEFORE INSERT ON guarda
FOR EACH ROW
BEGIN
    DECLARE ubicacion_almacen varchar(255);
    DECLARE destino_lote varchar(255);

    -- Obtener la ubicación del almacén
    SELECT Departamento INTO ubicacion_almacen
    FROM almacencarry
    WHERE IDCarry = NEW.IDCarry;

    -- Obtener el destino del lote
    SELECT DestinoLote INTO destino_lote
    FROM lote
    WHERE IdLote = NEW.IdLote;

    -- Verificar si la ubicación del paquete y el destino del lote son distintos a la ubicación del almacén
    IF destino_lote = ubicacion_almacen THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La ubicación del paquete o el destino del lote no coincide con la ubicación del almacén';
    END IF;
END;
//

DELIMITER ;
-- ------------------------------------------------------------------------------------------------------------
-- no permita que la fecha de entrega del lote sea mayor ni igual a la fecha de entrega del paquete

DELIMITER //

CREATE TRIGGER antes_insertar_fecha_pertenecen
BEFORE INSERT ON pertenecen
FOR EACH ROW
BEGIN
    DECLARE fecha_entrega_paquete datetime;
    DECLARE fecha_entrega_lote datetime;

    -- Obtener la fecha de entrega del paquete
    SELECT FechaEntrega INTO fecha_entrega_paquete
    FROM vahacia
    WHERE IdPaquete = NEW.IdPaquete;

    -- Obtener la fecha de entrega del lote
    SELECT fechaEstimada INTO fecha_entrega_lote
    FROM lote
    WHERE IdLote = NEW.IdLote;

    -- Verificar si la fecha de entrega del lote es mayor o igual a la fecha de entrega del paquete
    IF fecha_entrega_lote >= fecha_entrega_paquete THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La fecha de entrega del lote debe ser menor a la fecha de entrega del paquete';
    END IF;
END;
//

DELIMITER ;


ALTER TABLE `lote`
  MODIFY `IdLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

ALTER TABLE `conduce`
  ADD CONSTRAINT `conduce_ibfk_1` FOREIGN KEY (`Ci`) REFERENCES `chofer` (`Ci`),
  ADD CONSTRAINT `conduce_ibfk_2` FOREIGN KEY (`Matricula`) REFERENCES `vehiculo` (`Matricula`);

ALTER TABLE `guarda`
  ADD CONSTRAINT `guarda_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`IdLote`),
  ADD CONSTRAINT `guarda_ibfk_2` FOREIGN KEY (`IDCarry`) REFERENCES `almacencarry` (`IDCarry`);

ALTER TABLE `llevaa`
  ADD CONSTRAINT `llevaa_ibfk_1` FOREIGN KEY (`IdRuta`) REFERENCES `ruta` (`IdRuta`),
  ADD CONSTRAINT `llevaa_ibfk_2` FOREIGN KEY (`IdCarry`) REFERENCES `almacencarry` (`IDCarry`);


ALTER TABLE `pertenecen`
  ADD CONSTRAINT `pertenecen_ibfk_1` FOREIGN KEY (`IdPaquete`) REFERENCES `paquete` (`IdPaquete`),
  ADD CONSTRAINT `pertenecen_ibfk_2` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`IdLote`);

ALTER TABLE `recoge`
  ADD CONSTRAINT `FK_MatriculaCamion` FOREIGN KEY (`Matricula`) REFERENCES `camion` (`Matricula`);

ALTER TABLE `transporta`
  ADD CONSTRAINT `transporta_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`IdLote`),
  ADD CONSTRAINT `transporta_ibfk_2` FOREIGN KEY (`Matricula`) REFERENCES `vehiculo` (`Matricula`);
COMMIT;
                                                                                                                                                                                                                                        


INSERT INTO `almacencarry` (`IDCarry`, `Departamento`, `Ruta`) VALUES
(1, 'Cerro Largo', 8),
(3, 'Maldonado', 5),
(5, 'Trenta y tres', 4),
(2, 'Rivera', 3),
(4, 'Lavalleja', 2),
(6, 'Salto', 10),
(7, 'Colonia', 10);

INSERT INTO `ruta`(`IdRuta`) VALUES
(2);

INSERT INTO `vehiculo` (`Matricula`, `Servicio`) VALUES
('camion', 'En funcionamiento'),
('Camion1', 'En ruta'),
('XYZ', 'En ruta'),
('Camioneta', 'Entregado'),
('M2', 'Fuera de servicio'),
('M1', 'Buen estado');

INSERT INTO `camion` (`Matricula`) VALUES
('camion'),
('Camion1'),
('XYZ'),
('M2'),
('M1');

INSERT INTO `camioneta` (`Matricula`) VALUES
('Camioneta');

INSERT INTO `paquete` (`IdPaquete`, `Peso`, `Tipo`, `Cliente`, `Departamento`,`Ciudad`,`DestinoExacto`, `FechaRegistro`, `Estado`) VALUES
(3, '12.00', 'Frágil', 'Pepe', 'Colonia','Colonia del Sacramento','VillaHermosa-6DeEnero-14','2023-09-22 18:01:00', 'Entregado'),
(4, '10.00', 'Frágil', 'Agustin', 'Florida','Cardal','VillaHermosa-6DeEnero-14', '2023-09-22 18:01:00', 'Entregado'),
(6, '12.00', 'Frágil', 'Pepe', 'Treinta y tres','Vergara','VillaHermosa-6DeEnero-14', '2023-09-22 18:01:00', 'Entregado'),
(7, '100.00', 'Frágil', 'Diego', 'Tacuarembo','Tacuarembo','VillaHermosa-6DeEnero-14', '2023-09-22 18:01:00', 'En lote'),
(1, '110.00', 'Frágil', 'Juan', 'Maldonado','San carlos','VillaHermosa-6DeEnero-14', '2023-09-22 18:01:00', 'En Camioneta'),
(8, '11.00', 'Frágil', 'Pablo', 'Cerro largo','Melo','VillaHermosa-6DeEnero-14' ,'2023-05-22 18:01:00', 'Entregado'),
(12, '11.00', 'Frágil', 'Venus', 'Montevideo','Malvin','VillaHermosa-6DeEnero-14', '2023-09-22 18:01:00', 'En QuickCarry'),
(14, '18.00', 'Pesado', 'Samu', 'Colonia','Carmelo','VillaHermosa-6DeEnero-14', '2023-09-22 18:01:00', 'En QuickCarry'),
(2, '21.00', 'Pesado', 'Rodrigo', 'Rivera','Vichadero','VillaHermosa-6DeEnero-14', '2023-09-22 21:01:00', 'En QuickCarry');

INSERT INTO `chofer` (`Ci`, `NombreCompleto`, `Horarios`, `correo`, `contraseña`, `cargo`) VALUES
(58, 'Pintura Negra', '123', 'admin@gmail.com', 'asd', 'Chofer'),
(59, 'Cafe', '123', 'Matias@gmail.com', 'asd', 'Chofer'),
(69, 'Chofer', 'asdf', 'Chofer1@gmail.com', 'Chofer', 'Chofer'),
(70, 'Chofer ', 'Matutino', 'ChoferP@gmail.com', 'Chofer2', 'Chofer'),
(71, 'Camionero', 'Matutino', 'Chofer@gmail.com', 'Chofer', 'Chofer'),
(72, 'Camionero2', 'Matutino', 'Chofer2@gmail.com', 'Chofer2', 'Chofer');

INSERT INTO `conduce` (`Ci`, `Matricula`, `Estado`) VALUES
(70, 'Camion1', 'En ruta'),
(71, 'camion', 'En ruta'),
(59, 'XYZ', 'En ruta'),
(72, 'Camioneta', 'En ruta');

INSERT INTO  `llevaa`( `IdRuta`, `IDCarry`, `FechaLlegada`) VALUES
(2, 5, '2023-11-8 21:22:00'),
(2, 4, '2023-11-8 23:21:00');

INSERT INTO `lote` (`IdLote`, `EstadoLote`, `fechaEstimada`, `DestinoLote`) VALUES
(16, 'Entregado', NULL, 'Colonia'),
(17, 'Entregado', NULL, 'Treinta y Tres'),
(18, 'Cerrado', NULL, 'Florida');

INSERT INTO `pertenecen` (`IdPaquete`, `IdLote`) VALUES
(3, 16),
(6, 17),
(4, 18);

INSERT INTO `transporta` (`IdLote`, `Matricula`, `FechaEntrega`) VALUES
(17, 'camion1', '2023-06-06 16:47:21'),
(18, 'XYZ', '2023-11-11 16:47:21'),
(16, 'camion', '2023-08-06 16:47:21');

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contraseña`, `cargo`, `horario`, `dias_habiles`) VALUES
(60, 'Admin', 'istrador', 'Admin@gmail.com', 'root', 'Administrador', 'Matutino', 'Lunes - Viernes'),
(61, 'Funqui', 'Funchi', 'Funcionario@gmail.com', 'Funci123', 'Funcionario', 'Vespertino', 'Lunes - Viernes'),
(70, 'Chofer ', 'Prueba', 'ChoferP@gmail.com', 'Chofer2', 'Chofer', 'Matutino', 'Lunes - Jueves'),
(71, 'Camionero', '2', 'Chofer@gmail.com', 'Chofer', 'Chofer', 'Matutino', 'Lunes-viernes'),
(72, 'Camionero2', 'Cami', 'Chofer2@gmail.com', 'Chofer2', 'Chofer', 'Matutino', 'Lunes-viernes');

INSERT INTO `guarda`(`IdLote`,`IDCarry`,`IdRuta`) VALUES 
(16,5,2),
(17,7,3);

INSERT INTO `vahacia` (`IdPaquete`, `Matricula`, `FechaEntrega`) VALUES
(3, 'Camioneta', '2023-07-20 21:03:00'),
(6, 'Camioneta', '2023-07-22 22:03:00');

INSERT INTO `vahacia` (`IdPaquete`, `Matricula`, `FechaEntrega`) VALUES
(8, 'Camioneta', '2023-05-22 21:03:00');


-- 1) MOSTRAR LOS PAQUETES ENTREGADOS EN EL MES DE MAYO DEL 2023 CON DESTINO  A LA CIUDAD DE MELO
Select distinct paquete.* from paquete join vahacia where month(FechaEntrega)=5 and year(FechaEntrega)=2023 and Ciudad like 'Melo';

-- 2) MOSTRAR TODOS LOS ALMACENES Y LOS PAQUETES QUE FUERON ENTREGADOS EN LOS MISMOS DURANTE EL 2023, ORDENARLOS ADEMAS DE LOS QUE RECIBIERON MAS PAQUETES A LOS QUE RECIBIERON MENOS
SELECT almacencarry.Departamento AS Almacen, COUNT(pertenecen.IdPaquete) AS CantidadPaquetesEntregados FROM almacencarry  JOIN guarda  ON almacencarry.IDCarry = guarda.IDCarry
JOIN lote ON guarda.IdLote = lote.IdLote
JOIN pertenecen ON lote.IdLote = pertenecen.IdLote JOIN paquete on pertenecen.IdPaquete=paquete.IdPaquete
JOIN vahacia on paquete.IdPaquete=vahacia.IdPaquete WHERE (paquete.Estado='Entregado') AND YEAR(vahacia.FechaEntrega) = 2023
GROUP BY almacencarry.Departamento ORDER BY CantidadPaquetesEntregados DESC;

-- 3)MOSTRAR TODOS LOS CAMIONES REGISTRADOS Y QUE TEREA SE ENCUENTRAN REALIZANDO EN ESTE MOMENTO
Select vehiculo.* from vehiculo join camion on camion.Matricula=vehiculo.Matricula;

-- 4) MOSTRAR TODOS LOS CAMIONES QUE VISITARON DURANTE EL MES DE JUNIO UN ALMACEN DADO
Select transporta.Matricula from transporta join lote on lote.IdLote=transporta.IdLote join guarda on guarda.IdLote=lote.IdLote where guarda.IdCarry=7 and month(transporta.FechaEntrega)=6;

-- 5) MOSTRAR DESTINO, LOTE, ALMACEN DE DESTINO Y CAMIÓN QUE TRANSPORTA UN PAQUETE DADO.
Select paquete.Departamento, lote.IdLote, lote.DestinoLote, transporta.Matricula from paquete join pertenecen on pertenecen.IdPaquete=paquete.IdPaquete join lote on lote.IdLote=pertenecen.IdLote join transporta on transporta.IdLote=lote.IdLote where paquete.IdPaquete=3;

-- 6) MOSTRAR EL IDENTIFICADOR DEL PAQUETE, IDENTIFICADOR DE LOTE, MATRICULA DEL CAMION QUE LO TRANSPORTA, ALMACEN DE DESTINO, DIRECCIÓN FINAL Y EL ESTADO DEL ENVÍO, PARA LOS PAQUETES QUE SE RECIBIERON HACE MAS DE 3 DÍAS.
Select paquete.IdPaquete, lote.IdLote, transporta.Matricula, lote.DestinoLote, paquete.Departamento, paquete.Estado from paquete join pertenecen on pertenecen.IdPaquete=paquete.IdPaquete join lote on lote.IdLote=pertenecen.IdLote join transporta on transporta.IdLote=lote.IdLote where datediff(current_date(), paquete.FechaRegistro)>3;

-- 7) MOSTRAR TODOS LOS PAQUETES A LOS QUE AÚN NO SE LES HA ASIGNADO UN LOTE Y LA FECHA EN LA QUE FUERON RECIBIDOS.
Select IdPaquete, FechaRegistro from paquete where IdPaquete not in (Select IdPaquete from pertenecen);

-- 8) MOSTRAR MATRICULA DE LOS CAMIONES QUE SE ENCUENTRAN FUERA DE SERVICIO.
Select camion.Matricula from camion join vehiculo on vehiculo.Matricula=camion.Matricula where Servicio='Fuera de servicio';

-- 9)MOSTRAR TODOS LOS CAMIONES QUE NO TIENEN UN CONDUCTOR ASIGNADO Y SU ESTADO OPERATIVO.
Select vehiculo.Matricula, vehiculo.Servicio from vehiculo join camion on vehiculo.Matricula=camion.Matricula left join conduce on conduce.Matricula=camion.Matricula where conduce.Matricula is null;

-- 10)MOSTRAR TODOS LOS ALMACENES QUE SE ENCUENTRAN EN UN RECORRIDO DADO
Select almacencarry.* from almacencarry join llevaa on llevaa.IDCarry=almacencarry.IDCarry where llevaa.idRuta=2;

-- 11) MOSTRAR LA LISTA DE LOS PAQUETES Y SU ESTADO, QUE SE ENCUENTREN EN UN ALMACÉN ESPECÍFICO.
SELECT paquete.IdPaquete, paquete.Estado
FROM paquete 
JOIN pertenecen ON paquete.IdPaquete = pertenecen.IdPaquete 
JOIN lote ON pertenecen.IdLote = lote.IdLote 
JOIN guarda ON lote.IdLote = guarda.IdLote 
JOIN almacencarry ON guarda.IDCarry = almacencarry.IDCarry 
WHERE almacencarry.IDCarry = 7;

-- 12) MOSTRAR LOS LOTES QUE LLEGARON A UN ALMACÉN ESPECÍFICO DURANTE EL  MES DE AGOSTO DEL 2023.
SELECT lote.IdLote, lote.EstadoLote, lote.DestinoLote 
FROM lote 
join transporta on lote.IdLote = transporta.IdLote
WHERE YEAR(transporta.FechaEntrega) = 2023
AND MONTH(transporta.FechaEntrega) = 8
AND lote.IdLote IN (
    SELECT IdLote
    FROM guarda
    WHERE guarda.IdCarry = 5
);


-- 13) MUESTRA LA INFORMACIÓN DE LOS CAMIONES QUE ACTUALMENTE SE ENCUENTREN EN RUTA, JUNTO CON SU CARGA, DESTINO Y HORARIO 
-- ESTIMADO DE LLEGADA.
SELECT c.Matricula AS Camion_Matricula, l.IdLote, l.DestinoLote AS Destino, l.fechaEstimada
FROM camion c
join vehiculo on c.Matricula = vehiculo.Matricula
join transporta on c.Matricula = transporta.Matricula
JOIN lote l ON transporta.IdLote = l.IdLote
JOIN pertenecen ON l.IdLote = pertenecen.IdLote
JOIN paquete p ON pertenecen.IdPaquete = p.IdPaquete
WHERE vehiculo.servicio = 'En ruta';


-- 14) MUESTRE INFORMACIÓN DE UN PAQUETE ESPECÍFICO QUE YA HAYA SIDO ENTREGADO. ESTO IMPLICA, IDENTIFICADOR DE: LOTE, RECORRIDO, CAMIÓN 
-- QUE LO TRANSPORTÓ, ALMACÉN DONDE SE ALMACENÓ, CAMIONETA QUE HIZO EL ÚLTIMO TRAMO Y DIRECCIÓN FINAL.
SELECT
    p.IdPaquete AS IdentificadorPaquete,
    l.IdLote AS IdentificadorLote,
    lv.IdRuta AS IdentificadorRecorrido,
    t.Matricula AS CamionTransporte,
    l.DestinoLote AS AlmacenDestino,
    vh.Matricula AS CamionetaUltimoTramo,
    p.Departamento AS DireccionFinal
FROM paquete p
JOIN pertenecen pe ON p.IdPaquete = pe.IdPaquete
JOIN lote l ON pe.IdLote = l.IdLote
join guarda on l.IdLote = guarda.IdLote
JOIN transporta t ON guarda.IdLote = t.IdLote
JOIN vahacia vh ON p.IdPaquete = vh.IdPaquete
JOIN llevaa lv ON lv.IDCarry = guarda.IDCarry
WHERE p.IdPaquete = 3
  AND p.Estado = 'Entregado';


-- 15) DADO UN CAMIÓN, MOSTRAR LOS RECORRIDOS REALIZADOS Y LOS ALMACENES VISITADOS EN EL ÚLTIMO MES. 
SELECT
	guarda.IDCarry,
    guarda.IdRuta AS IdentificadorRecorrido
FROM transporta 
join guarda on transporta.IdLote = guarda.IdLote
WHERE transporta.Matricula = 'XYZ'
  AND transporta.FechaEntrega >= DATE_SUB(NOW(), INTERVAL 1 MONTH);


 

-- 16) MOSTRAR LOS PAQUETES ENTREGADOS EN EL MES DE JULIO DE 2023, ORDENADOS POR FECHA DE ENTREGA DE FORMA DESCENDENTE. 
SELECT *
FROM paquete p
join vahacia on p.IdPaquete = vahacia.IdPaquete
WHERE YEAR(vahacia.FechaEntrega) = 2023
  AND MONTH(vahacia.FechaEntrega) = 7
  AND p.Estado = 'Entregado'
ORDER BY p.FechaRegistro DESC;


-- 17) MOSTRAR LOS CAMIONES QUE NO HICIERON NINGÚN RECORRIDO ENTRE EL 10 Y 17 DE JULIO DE 2023.
    SELECT camion.Matricula AS MatriculaCamion 
    FROM camion 
	WHERE camion.Matricula NOT IN (
    SELECT DISTINCT c.Matricula
    FROM camion c
    JOIN transporta t ON c.Matricula = t.Matricula
    JOIN lote lo ON lo.IdLote = t.IdLote
    WHERE lo.fechaEstimada >= '2023-07-10 00:00:00' AND lo.fechaEstimada <= '2023-07-17 23:59:59'
);


-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2020 a las 16:04:15
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alfa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `actividad` varchar(30) DEFAULT NULL,
  `altaactividad` date DEFAULT NULL,
  `horaini` time DEFAULT NULL,
  `iduni` int(11) DEFAULT NULL,
  `horafin` time NOT NULL,
  `fechaini` date NOT NULL,
  `fechafin` date NOT NULL,
  `idserv` int(10) NOT NULL,
  `idclient` int(10) NOT NULL,
  `idscr` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id`, `actividad`, `altaactividad`, `horaini`, `iduni`, `horafin`, `fechaini`, `fechafin`, `idserv`, `idclient`, `idscr`) VALUES
(29, 'Flete', '2020-12-09', '14:21:00', 5, '14:20:00', '2020-12-10', '2020-12-11', 1, 7, 2),
(30, 'Renta', '2020-12-09', '14:23:00', 2, '14:24:00', '2020-12-10', '2020-12-10', 2, 7, 2),
(31, 'Mantenimiento', '2020-12-09', '00:00:00', 2, '00:00:00', '2020-12-10', '2020-12-10', 4, 0, 2),
(32, 'Renta', '2020-12-09', '16:18:00', 4, '16:19:00', '2020-12-08', '2020-12-09', 2, 7, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `contacto` varchar(60) NOT NULL,
  `correocont` varchar(60) NOT NULL,
  `nomcli` varchar(100) DEFAULT NULL,
  `telcli` varchar(30) DEFAULT NULL,
  `celular` varchar(15) NOT NULL,
  `ine` varchar(20) NOT NULL,
  `correocli` varchar(50) NOT NULL,
  `dircli` varchar(100) DEFAULT NULL,
  `razonsocial` varchar(50) NOT NULL,
  `dirsocial` varchar(40) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `cp` varchar(10) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `correofac` varchar(50) NOT NULL,
  `idsucur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `contacto`, `correocont`, `nomcli`, `telcli`, `celular`, `ine`, `correocli`, `dircli`, `razonsocial`, `dirsocial`, `colonia`, `ciudad`, `estado`, `cp`, `rfc`, `correofac`, `idsucur`) VALUES
(6, 'zzedit', 'a@gmail.com', 'asesit', 'asesitr', '2esdit', '2asesit', 'aedit@gmail.com', 'asedit', 'zxedir', 'asedit', 'as', 'asedt', 'asedit', 'asedit', 'asedit', 'aedit@gmail.com', 1),
(7, 'as', 'as@gmail.com', 'as', 'as', 'as', 'as', 'asas', 'sd', 'as', 'as', 'as', 'as', 'as', 'as', 'as', 'a@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `nomcol` varchar(100) DEFAULT NULL,
  `fechacol` date DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `cuenta` varchar(100) DEFAULT NULL,
  `contra` varchar(100) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nomcol`, `fechacol`, `correo`, `cuenta`, `contra`, `idrol`) VALUES
(1, 'ana', '2020-10-22', 'ana.palacios.lopez@outlook.com', 'ana', 'ana', 1),
(2, 'jose', '2020-10-19', 'jose', 'jose', '1234', 2),
(3, 'luis', '2020-10-16', 'luis', 'luis', '5678', 3),
(4, 'maria magdalena', '2020-10-10', 'x', 'maria', '5678', 3),
(5, 'Luis antonio ', '2020-09-03', 'antonio', 'antonio', '5678', 3),
(6, 'Misale ramirez', '2020-11-03', 'misael@gmail.com', 'misaralo', '1234', 2),
(7, 'artuto', '2020-12-09', 'arturo@gmail.com', 'arturo', '1234', 2),
(8, 'carlos', '2020-12-08', 'carlos@gmail.com', 'carlos', '1234', 2),
(9, 'andrea', '2020-12-09', 'andrea@gmail.com', 'andrea', '1234', 2),
(10, 'claudia', '2020-12-09', 'claudia@gmail.com', 'claudia', '1234', 2),
(11, 'jorge', '2020-12-09', 'jorge@gmail.com', 'jorge', '1234', 2),
(12, 'simon', '2020-12-09', 'simon@gmail.com', 'simon', '1234', 2),
(13, 'sandra', '2020-12-09', 'sandra@gmail.com', 'sandra', '1234', 2),
(14, 'tania', '2020-12-09', 'tania@gmail.com', 'tania', '1234', 2),
(15, 'pedro', '2020-12-10', 'pedro@gmail.com', 'pedro', '5678', 3),
(16, 'paloma', '2020-12-09', 'paloma@gmail.com', 'palona', '5678', 3),
(17, 'ane', '2020-12-09', 'ane@gmail.com', 'ane', '5678', 3),
(18, 'max', '2020-12-09', 'max@gmail.com', 'max', '5678', 3),
(19, 'ian', '2020-12-09', 'ian@gmail.com', 'ian', '5678', 3),
(20, 'francisco', '2020-12-09', 'francisco@gmail.com', 'francisco', '5678', 3),
(21, 'patricia', '2020-12-09', 'patricia@gmail.com', 'patricia', '5678', 3),
(22, 'dulce', '2020-12-10', 'dulce@gmail.com', 'dulce', '5678', 3),
(23, 'karen', '2020-12-10', 'karen@gmail.com', 'karen', '5678', 3),
(24, 'gabriel', '2020-12-09', 'gabriel@gmail.com', 'gabriel', '5678', 3),
(25, 'daniel', '2020-12-09', 'daniel@gmail.com', 'daniel', '5678', 3),
(26, 'adrian', '2020-12-10', 'adrian@gmail.com', 'adrian', '5678', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id` int(11) NOT NULL,
  `nomdispo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id`, `nomdispo`) VALUES
(1, 'disponible'),
(2, 'mantenimiento'),
(3, 'no disponible'),
(4, 'Apartado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `idcol` int(11) DEFAULT NULL,
  `idcalen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `afec_disponiilidad` varchar(5) DEFAULT NULL,
  `gastos` float DEFAULT NULL,
  `actividad` varchar(50) DEFAULT NULL,
  `idunid` int(11) DEFAULT NULL,
  `descripcion` varchar(50) NOT NULL,
  `idservi` int(10) NOT NULL,
  `idsucr` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id`, `tipo`, `fecha_inicio`, `fecha_final`, `afec_disponiilidad`, `gastos`, `actividad`, `idunid`, `descripcion`, `idservi`, `idsucr`) VALUES
(43, 'Mantenimiento programado', '2020-12-10', '2020-12-12', 'si', 0, 'Frenos', 2, '123asd', 4, 2),
(44, 'Mantenimiento No programado', '2020-12-10', '2020-12-10', 'si', 24, 'as', 2, '123asd', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicio`
--

CREATE TABLE `orden_servicio` (
  `id` int(11) NOT NULL,
  `idservi` int(11) DEFAULT NULL,
  `idcli` int(11) DEFAULT NULL,
  `iduni` int(11) DEFAULT NULL,
  `fecha_inicial` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `hora_inicial` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `kilometraje` varchar(20) DEFAULT NULL,
  `marcandia_transportar` varchar(100) DEFAULT NULL,
  `idsucur` int(11) NOT NULL,
  `idcol` int(11) NOT NULL,
  `dirrecoleccion` varchar(50) NOT NULL,
  `direntrega` varchar(50) NOT NULL,
  `hrecoleccion` time NOT NULL,
  `hrcita` time NOT NULL,
  `ciudaddestino` varchar(50) NOT NULL,
  `costo` double NOT NULL,
  `altaactivi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden_servicio`
--

INSERT INTO `orden_servicio` (`id`, `idservi`, `idcli`, `iduni`, `fecha_inicial`, `fecha_final`, `hora_inicial`, `hora_final`, `kilometraje`, `marcandia_transportar`, `idsucur`, `idcol`, `dirrecoleccion`, `direntrega`, `hrecoleccion`, `hrcita`, `ciudaddestino`, `costo`, `altaactivi`) VALUES
(114, 1, 7, 5, '2020-12-10', '2020-12-11', '14:21:00', '14:20:00', '23', 'Carga en general', 2, 4, 'as', 'as', '14:19:00', '14:19:00', 'as', 23, '0000-00-00'),
(115, 2, 7, 2, '2020-12-10', '2020-12-10', '14:23:00', '14:24:00', '12', 'Muebles en general', 2, 4, '', '', '00:00:00', '00:00:00', '', 32, '2020-12-09'),
(116, 2, 7, 4, '2020-12-08', '2020-12-09', '16:18:00', '16:19:00', '132', 'Frutas y verduras', 2, 4, '', '', '00:00:00', '00:00:00', '', 12, '2020-12-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `tipo_rol` varchar(100) DEFAULT NULL,
  `cambios` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `tipo_rol`, `cambios`) VALUES
(1, 'SuperAdministrador', 'si puede realizar cambios'),
(2, 'Administrador', 'debe solicitar autorizacion'),
(3, 'Colaboradores', 'no le aparece la opcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `tipo`, `color`) VALUES
(1, 'Flete', 'bg-danger'),
(2, 'Renta', 'bg-danger'),
(3, 'Apartado', 'bg-warning'),
(4, 'Mantenimiento', 'bg-primary');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL,
  `nomsuc` varchar(100) DEFAULT NULL,
  `dirsuc` varchar(100) DEFAULT NULL,
  `telsuc` varchar(50) DEFAULT NULL,
  `cp` varchar(20) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nomsuc`, `dirsuc`, `telsuc`, `cp`, `estado`) VALUES
(1, 'Los Reyes S.A DE C. edir', 'Av. Salvador Díaz  #325 edita', '971234', '70110', 'mexico'),
(2, 'Los Pinos la Paz  S.A DE C.V.1', 'Av. San German Díaz Mirón #327', '9711534993', '64370', 'MONTERREY N.L.'),
(3, 'la central de oacxa 123', 'los coan jefrona', '223487443', '3', '234'),
(4, 'x1asdasdasd', 'x1asdasdsad', '2234asdasd', '3', '234'),
(5, 'x3asd', 'x3adaasd', '23asdasd', '23', '23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_colaborador`
--

CREATE TABLE `sucursal_colaborador` (
  `idcol` int(11) DEFAULT NULL,
  `idsuc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursal_colaborador`
--

INSERT INTO `sucursal_colaborador` (`idcol`, `idsuc`) VALUES
(2, 1),
(1, 2),
(1, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 1),
(8, 2),
(9, 3),
(10, 3),
(11, 4),
(12, 4),
(13, 5),
(14, 5),
(15, 2),
(16, 1),
(17, 1),
(18, 3),
(19, 3),
(20, 3),
(21, 4),
(22, 4),
(23, 4),
(24, 5),
(25, 5),
(26, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `noserie` int(11) NOT NULL,
  `nomuni` varchar(50) NOT NULL,
  `serie` varchar(20) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `modelo` varchar(30) DEFAULT NULL,
  `placas` varchar(10) DEFAULT NULL,
  `caja` varchar(5) DEFAULT NULL,
  `refrigeracion` varchar(5) DEFAULT NULL,
  `capasidad_max` varchar(10) DEFAULT NULL,
  `costo_adquisicion` varchar(30) DEFAULT NULL,
  `descripuni` varchar(100) NOT NULL,
  `foto` varchar(80) NOT NULL,
  `iddispo` int(11) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `idsuc` int(11) DEFAULT NULL,
  `ultimaactividad` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`noserie`, `nomuni`, `serie`, `fecha_alta`, `marca`, `modelo`, `placas`, `caja`, `refrigeracion`, `capasidad_max`, `costo_adquisicion`, `descripuni`, `foto`, `iddispo`, `tipo`, `idsuc`, `ultimaactividad`) VALUES
(1, 'auto1edit', '123edit', '2020-10-29', 'BMWedit', 'BMW x3edit', 'AJS123edit', 'si', 'no', '6000edit', '32000edit', 'asdadsedit', '../content/unidad/IMGEDIT_123edit.jpg', 1, 'camion', 1, '2020-12-08'),
(2, 'auto2', '1928773662', '2020-10-28', 'Nissan', 'URVAN NV350', 'SLKD145', 'si', 'no', '30', '200000', '123asd', '../content/unidad/unidad.png', 1, 'camion', 2, '0000-00-00'),
(3, 'auto10eidt', '0283rdit', '2020-12-31', 'Volkswagen', 'Volkswagen GOLFedit', 'AJJS35edit', 'no', 'si', '30eodit', '42000edit', 'edit', '../content/unidad/IMGEDIT_0283rdit.jpg', 1, 'camion', 1, '2020-12-08'),
(4, 'auto4', '1231245', '2020-10-29', 'x', 'y', 'ad453', 'no', 'no', '300', '23000', '                \r\n              descprioas', '../content/unidad/unidad.png', 1, 'nissan', 2, '0000-00-00'),
(5, 'auto5', '1231245123', '2020-10-29', 'x2', 'y2', 'ad453123', 'si', 'si', '3002', '230003', '                \r\n              descprioas123123', '../content/unidad/unidad.png', 1, 'camion', 2, '0000-00-00'),
(6, 'auto3', '1231245123123', '2020-11-11', 'ford', 'EcoSport 2020', 'ad453123', 'no', 'no', '300', '36', '                \r\n              ', '../content/unidad/unidad.png', 1, 'camion', 1, '2020-12-08'),
(7, 'auto 9 editeaod', '1231245123ediots', '2020-12-31', 'fordeditdo', 'EcoSport 2020editos', 'ad453edior', 'no', 'no', '3002eidrf', '363,500eojd', '                \r\n              qewedicotr', '../content/unidad/IMGEDIT_1231245123ediots.jpg', 1, 'camion', 1, '2020-12-01'),
(8, 'unida carga v2', 'ad123', '2020-12-02', 'ass', '123', 'akksad0912', 'no', 'no', '234', '124', '                \r\n              logos de aividuana', '../content/unidad/IMG_unida ca', 1, 'tipo', 1, NULL),
(9, 'unidade de trnasport', '12344', '2020-12-02', 'asd', 'jakjse', 'pak324', 'si', 'no', '234', '5500', '                \r\n              asdasd', '../content/unidad/IMG_12344.jpg', 1, 'tipo', 1, NULL),
(10, 'nuevo', '12344', '2020-12-16', 'nuec', 'jakjse', '123', 'no', 'no', '3002eidrf', '123', '               nevo\r\n              ', '../content/unidad/IMG_12344.jpg', 1, 'tipo', 1, NULL),
(11, 'aEDITADO', 'asd', '2020-12-10', '123', 'ad', 'asd', 'si', 'no', 'asd', '234', '                \r\n              adasd', '../content/unidad/IMGEDIT_asd.jpg', 1, 'camion', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistacalendario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistacalendario` (
`idc` int(11)
,`idm` int(11)
,`idor` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistacalendario`
--
DROP TABLE IF EXISTS `vistacalendario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistacalendario`  AS  select `calendario`.`id` AS `idc`,`mantenimiento`.`id` AS `idm`,`orden_servicio`.`id` AS `idor` from ((`calendario` join `mantenimiento` on(`mantenimiento`.`idunid` = `calendario`.`iduni` and `mantenimiento`.`idservi` = `calendario`.`idserv` and `mantenimiento`.`fecha_inicio` = `calendario`.`fechaini` and `mantenimiento`.`fecha_final` = `calendario`.`fechafin`)) join `orden_servicio` on(`orden_servicio`.`iduni` = `calendario`.`iduni` and `orden_servicio`.`idservi` = `calendario`.`idserv` and `orden_servicio`.`fecha_inicial` = `calendario`.`fechaini` and `orden_servicio`.`fecha_final` = `calendario`.`fechafin`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduni` (`iduni`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsucur` (`idsucur`);

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrol` (`idrol`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcol` (`idcol`),
  ADD KEY `idcalen` (`idcalen`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idunid` (`idunid`);

--
-- Indices de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flete_ibfk_1` (`idservi`),
  ADD KEY `flete_ibfk_2` (`idcli`),
  ADD KEY `flete_ibfk_3` (`iduni`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursal_colaborador`
--
ALTER TABLE `sucursal_colaborador`
  ADD KEY `idcol` (`idcol`),
  ADD KEY `idsuc` (`idsuc`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`noserie`),
  ADD KEY `iddispo` (`iddispo`),
  ADD KEY `idsuc` (`idsuc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `noserie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`iduni`) REFERENCES `unidades` (`noserie`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idsucur`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idcol`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `log_ibfk_2` FOREIGN KEY (`idcalen`) REFERENCES `calendario` (`id`);

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`idunid`) REFERENCES `unidades` (`noserie`);

--
-- Filtros para la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD CONSTRAINT `flete_ibfk_1` FOREIGN KEY (`idservi`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `flete_ibfk_2` FOREIGN KEY (`idcli`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `flete_ibfk_3` FOREIGN KEY (`iduni`) REFERENCES `unidades` (`noserie`),
  ADD CONSTRAINT `orden_servicio_ibfk_1` FOREIGN KEY (`idservi`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `orden_servicio_ibfk_2` FOREIGN KEY (`idcli`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `orden_servicio_ibfk_3` FOREIGN KEY (`iduni`) REFERENCES `unidades` (`noserie`);

--
-- Filtros para la tabla `sucursal_colaborador`
--
ALTER TABLE `sucursal_colaborador`
  ADD CONSTRAINT `sucursal_colaborador_ibfk_1` FOREIGN KEY (`idcol`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `sucursal_colaborador_ibfk_2` FOREIGN KEY (`idsuc`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD CONSTRAINT `unidades_ibfk_1` FOREIGN KEY (`iddispo`) REFERENCES `disponibilidad` (`id`),
  ADD CONSTRAINT `unidades_ibfk_2` FOREIGN KEY (`idsuc`) REFERENCES `sucursal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

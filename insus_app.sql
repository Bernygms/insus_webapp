-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2019 a las 23:51:12
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `insus_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_est` int(11) NOT NULL,
  `nombre_est` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_est`, `nombre_est`) VALUES
(1, 'AGUASCALIENTES'),
(2, 'BAJA CALIFORNIA'),
(3, 'BAJA CALIFORNIA SUR'),
(4, 'CAMPECHE'),
(5, 'COAHUILA'),
(6, 'COLIMA'),
(7, 'CHIAPAS'),
(8, 'CHIHUAHUA'),
(9, 'DISTRITO FEDERAL'),
(10, 'DURANGO'),
(11, 'GUANAJUATO'),
(12, 'GUERRERO'),
(13, 'HIDALGO'),
(14, 'JALISCO'),
(15, 'MÉXICO'),
(16, 'MICHOACAN'),
(17, 'MORELOS'),
(18, 'NAYARIT'),
(19, 'NUEVO LEON'),
(20, 'OAXACA'),
(21, 'PUEBLA'),
(22, 'QUERETARO'),
(23, 'QUINTANA ROO'),
(24, 'SAN LUIS POTOSI'),
(25, 'SINALOA'),
(26, 'SONORA'),
(27, 'TABASCO'),
(28, 'TAMAULIPAS'),
(29, 'TLAXCALA'),
(30, 'VERACRUZ'),
(31, 'YUCATAN'),
(32, 'ZACATECAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros_recursos`
--

CREATE TABLE `otros_recursos` (
  `id_otr_rec` int(11) NOT NULL,
  `rectificaciones_otr_rec` decimal(10,0) NOT NULL,
  `otros_otr_rec` decimal(10,0) NOT NULL,
  `fecha_mes_otros_rec` date NOT NULL,
  `fecha_edi_otros_rec` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasprah`
--

CREATE TABLE `pasprah` (
  `id_pasprah` int(11) NOT NULL,
  `accion_pasprah` int(11) NOT NULL,
  `subsidio_pasprah` decimal(10,0) NOT NULL,
  `apoyo_insus_pasprah` decimal(10,0) NOT NULL,
  `fecha_mes_pasprah` date NOT NULL,
  `fecha_edi_pasprah` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pmu`
--

CREATE TABLE `pmu` (
  `id_pmu` int(11) NOT NULL,
  `accion_pmu` int(11) NOT NULL,
  `pago_ben_pmu` decimal(10,0) NOT NULL,
  `subcidio_pmu` decimal(10,0) NOT NULL,
  `fecha_mes_pmu` date NOT NULL,
  `fecha_edi_pmu` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prah`
--

CREATE TABLE `prah` (
  `id_prah` int(11) NOT NULL,
  `accion_prah` int(11) NOT NULL,
  `pago_ben_prah` decimal(10,0) NOT NULL,
  `subcidio_prah` decimal(10,0) NOT NULL,
  `fecha_mes_prah` date NOT NULL,
  `fecha_edi_prah` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prah`
--

INSERT INTO `prah` (`id_prah`, `accion_prah`, `pago_ben_prah`, `subcidio_prah`, `fecha_mes_prah`, `fecha_edi_prah`, `pk_id_raci`) VALUES
(1, 2, '12000', '12000', '2019-06-12', '0000-00-00', 2),
(2, 3, '1000', '1000', '2019-06-12', '2019-06-12', 2),
(3, 1, '1000', '1000', '2019-06-12', '2019-06-12', 2),
(4, 5, '2000', '2000', '2019-06-12', '2019-06-12', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raci`
--

CREATE TABLE `raci` (
  `id_raci` int(11) NOT NULL,
  `entidad_raci` int(11) NOT NULL,
  `clave_insus_raci` varchar(7) NOT NULL,
  `clave_inegi_raci` varchar(12) NOT NULL,
  `modalidad_raci` varchar(8) NOT NULL,
  `nombre_de_pob_raci` varchar(150) NOT NULL,
  `municipio_raci` varchar(150) NOT NULL,
  `superficie_de_pob_raci` varchar(50) NOT NULL,
  `municipio_pro_raci` varchar(150) NOT NULL,
  `fecha_ini_con_raci` date NOT NULL,
  `universo_de_lot_raci` int(11) NOT NULL,
  `contratados_raci` int(11) NOT NULL,
  `total_con_raci` int(11) NOT NULL,
  `pendientes_de_con_raci` int(11) NOT NULL,
  `pk_Id_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `raci`
--

INSERT INTO `raci` (`id_raci`, `entidad_raci`, `clave_insus_raci`, `clave_inegi_raci`, `modalidad_raci`, `nombre_de_pob_raci`, `municipio_raci`, `superficie_de_pob_raci`, `municipio_pro_raci`, `fecha_ini_con_raci`, `universo_de_lot_raci`, `contratados_raci`, `total_con_raci`, `pendientes_de_con_raci`, `pk_Id_est`) VALUES
(1, 1, '0003-7', '10010001', 'EXP', 'LAS CUMBRES', ' AGUASCALIENTES', '54-20-52.00', '0', '0000-00-00', 1771, 0, 1771, 0, 0),
(2, 1, '0004-4', '10010001', 'EXP', 'LAS CUMBRES II', ' AGUASCALIENTES', '02-88-91.92', '0', '0000-00-00', 134, 0, 133, 1, 0),
(3, 1, '0006-9', '10010001', 'EXP', 'LA HUERTA', ' AGUASCALIENTES', '87-90-29.90', '0', '0000-00-00', 3342, 0, 3342, 0, 0),
(4, 1, '0007-6', '10010001', 'EXP', 'LA HUERTA II', ' AGUASCALIENTES', '38-05-59.00', '0', '0000-00-00', 345, 0, 345, 0, 0),
(5, 1, '0008-3', '10010001', 'EXP', 'LOS POCITOS', ' AGUASCALIENTES', '15-09-80.10', '0', '0000-00-00', 634, 0, 633, 1, 0),
(6, 1, '0011-8', '10010001', 'EXP', 'OJO CALIENTE', ' AGUASCALIENTES', '21-42-09.69', '0', '0000-00-00', 289, 0, 286, 3, 0),
(7, 1, '0012-5', '10010001', 'EXP', 'SALTO DE OJO CALIENTE', ' AGUASCALIENTES', '29-97-37.50', '0', '0000-00-00', 837, 0, 836, 1, 0),
(8, 1, '0016-4', '10030001', 'EXP', 'CALVILLO', ' CALVILLO', '25-84-60.86', '0', '0000-00-00', 566, 0, 550, 16, 0),
(9, 1, '0019-6', '10050001', 'EXP', 'JESUS MARIA', 'JESUS MARIA', '37-04-75.73', '0', '0000-00-00', 932, 0, 931, 1, 0),
(10, 1, '0020-6', '10060261', 'EXP', 'COLONIA PROGRESO', 'PABELLON DE ARTEAGA', '29-20-54.35', '0', '0000-00-00', 671, 0, 671, 0, 0),
(11, 1, '0024-5', '10080001', 'EXP', 'SAN JOSE DE GRACIA ', 'SAN JOSE DE GRACIA', '38-19-54.56', '0', '0000-00-00', 416, 0, 394, 22, 0),
(12, 1, '0025-2', '10080001', 'EXP', 'SAN JOSE DE GRACIA II', 'SAN JOSE DE GRACIA', '29-40-54.69', '0', '0000-00-00', 333, 0, 315, 18, 0),
(13, 1, '0028-4', '10090012', 'EXP', 'EL CHAYOTE', ' TEPEZALA', '34-86-86.00', '0', '0000-00-00', 319, 0, 317, 2, 0),
(14, 1, '0035-8', '10020059', 'EXP', 'VIUDAS DE ORIENTE', ' ASIENTOS', '50-34-93.37', '0', '0000-00-00', 869, 0, 788, 81, 0),
(15, 1, '0036-5', '10100001', 'EXP', 'PALO ALTO', ' EL LLANO', '147-26-32.00', '0', '0000-00-00', 1487, 0, 1270, 217, 0),
(16, 1, '0055-9', '10010001', 'EXP', 'LOS POCITOS II', ' AGUASCALIENTES', '01-39-34.00', '0', '0000-00-00', 38, 0, 30, 8, 0),
(17, 1, '0069-3', '10080001', 'EXP', 'SAN JOSE DE GRACIA III', ' SAN JOSE DE GRACIA', '16-51-67.00', '0', '0000-00-00', 121, 0, 83, 38, 0),
(18, 1, '0073-8', '10010001', 'EXP', 'LAS CUMBRES III', ' AGUASCALIENTES', '52-26-89.00', '0', '0000-00-00', 2117, 0, 2078, 39, 0),
(19, 1, '0076-8', '10010001', 'ESP', 'NAZARIO ORTIZ GARZA', ' AGUASCALIENTES', '00-62-56.50', '0', '0000-00-00', 89, 0, 89, 0, 0),
(20, 1, '0087-5', '10012272', 'MDT', 'LOS NEGRITOS (EL EDÉN)', ' AGUASCALIENTES', '05-54-97.00', '0', '0000-00-00', 183, 0, 101, 82, 0),
(21, 1, '0088-8', '10012272', 'MDT', 'LOS NEGRITOS (GRANJAS SAN FELIPE)', ' AGUASCALIENTES', '03-21-50.00', '0', '0000-00-00', 111, 0, 93, 18, 0),
(22, 1, '0089-7', '10010001', 'MDT', 'CUMBRES (ANEXO PALOMINO DENA)', ' AGUASCALIENTES', '20-90-82.00', '0', '0000-00-00', 710, 0, 645, 65, 0),
(23, 1, '0090-2', '10012050', 'MDT', 'CUMBRES (LA LOMA)', ' AGUASCALIENTES', '71-76-88.00', '0', '0000-00-00', 1500, 0, 1560, -60, 0),
(24, 1, '0091-7', '10012055', 'MDT', 'SAN IGNACIO (JARDIN DE LOS OLIVOS)', ' AGUASCALIENTES', '06-32-56.00', '0', '0000-00-00', 172, 0, 134, 38, 0),
(25, 1, '0092-5', '10010001', 'MDT', 'SALTO DE OJO CALIENTE Y SU ANEXO', ' AGUASCALIENTES', '05-83-43.00', '0', '0000-00-00', 127, 0, 100, 27, 0),
(26, 1, '0096-6', '10010001', 'MDT', 'PE. OJO CALIENTE (EL RIEGO)', ' AGUASCALIENTES', '03-09-58.00', '0', '0000-00-00', 138, 0, 116, 22, 0),
(27, 1, '0098-0', '10010001', 'MDT', 'PE. NORIAS DE PASO HONDO (CIUDAD GOTICA)', ' AGUASCALIENTES', '03-28-49.00', '0', '0000-00-00', 112, 0, 87, 25, 0),
(28, 1, '0099-8', '10010001', 'MDT', 'PE. NORIAS DE PASO HONDO (ANEXO NORIAS)', ' AGUASCALIENTES', '01-69-81.00', '0', '0000-00-00', 66, 0, 38, 28, 0),
(29, 1, '0100-2', '10010001', 'MDT', 'PE. SAN IGNACIO (PLAYA DE GUADALUPE)', ' AGUASCALIENTES', '02-00-96.00', '0', '0000-00-00', 65, 0, 20, 45, 0),
(30, 1, '0105-5', '10010001', 'MDT', 'PE. LOS NEGRITOS (S. MARTIN DE LA CANTERA)', ' AGUASCALIENTES', '02-83-81.22', '0', '0000-00-00', 50, 0, 32, 18, 0),
(31, 1, '0107-8', '10010001', 'MDT', 'PE. NORIAS DE OJO CALIENTE (P.31 Y 37)', ' AGUASCALIENTES', '18-17-37.00', '0', '0000-00-00', 630, 0, 271, 359, 0),
(32, 1, '0108-5', '10010001', 'MDT', 'PE. NORIAS DE OJO CALIENTE (PARCELA 42)', ' AGUASCALIENTES', '08-59-13.31', '0', '0000-00-00', 220, 0, 183, 37, 0),
(33, 1, '0109-8', '10010001', 'MDT', 'PE. EL ZOYATAL (PARCELA 35)', ' AGUASCALIENTES', '01-84-09.10', '0', '0000-00-00', 40, 0, 15, 25, 0),
(34, 1, '0110-8', '10010293', 'MDT', 'PE. NORIAS DE OJO CALIENTE (PARCELA 20)', ' AGUASCALIENTES', '01-86-01.00', '0', '0000-00-00', 57, 0, 29, 28, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regla1`
--

CREATE TABLE `regla1` (
  `id_reg1` int(11) NOT NULL,
  `accion_reg1` int(11) NOT NULL,
  `pago_ben_reg1` decimal(10,0) NOT NULL,
  `apoyo_insus_reg1` decimal(10,0) NOT NULL,
  `fecha_mes_reg1` date NOT NULL,
  `fecha_edi_reg1` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regla2`
--

CREATE TABLE `regla2` (
  `id_reg2` int(11) NOT NULL,
  `accion_reg2` int(11) NOT NULL,
  `pago_ben_reg2` decimal(10,0) NOT NULL,
  `fecha_mes_reg2` date NOT NULL,
  `fecha_edi_reg2` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regla3`
--

CREATE TABLE `regla3` (
  `id_reg3` int(11) NOT NULL,
  `accion_reg3` int(11) NOT NULL,
  `pago_ben_reg3` decimal(10,0) NOT NULL,
  `fecha_mes_reg3` date NOT NULL,
  `fecha_edi_reg3` date NOT NULL,
  `pk_id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Super Usuario'),
(2, 'Administrador'),
(3, 'Usuario Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `nombre_usu` varchar(30) NOT NULL,
  `apellidos_usu` varchar(60) NOT NULL,
  `usuario_usu` varchar(20) NOT NULL,
  `correo_usu` varchar(100) NOT NULL,
  `password_usu` varchar(100) NOT NULL,
  `estado_usu` int(11) NOT NULL,
  `rol_usu` int(11) NOT NULL,
  `pk_id_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nombre_usu`, `apellidos_usu`, `usuario_usu`, `correo_usu`, `password_usu`, `estado_usu`, `rol_usu`, `pk_id_est`) VALUES
(1, 'Bernardino', 'Games Cabanzo', '@Berna', 'bernardinogamescabanzo@hotmail.com', '12345', 1, 1, 0),
(2, 'Puebla', 'Puebla Pue.', '', 'puebla@hotmail.com', '12345', 2, 3, 21),
(3, 'AGUASCALIENTES', 'AGU', '', 'aguascalientes@hotmail.com', '12345', 1, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `otros_recursos`
--
ALTER TABLE `otros_recursos`
  ADD PRIMARY KEY (`id_otr_rec`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `pasprah`
--
ALTER TABLE `pasprah`
  ADD PRIMARY KEY (`id_pasprah`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `pmu`
--
ALTER TABLE `pmu`
  ADD PRIMARY KEY (`id_pmu`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `prah`
--
ALTER TABLE `prah`
  ADD PRIMARY KEY (`id_prah`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `raci`
--
ALTER TABLE `raci`
  ADD PRIMARY KEY (`id_raci`);

--
-- Indices de la tabla `regla1`
--
ALTER TABLE `regla1`
  ADD PRIMARY KEY (`id_reg1`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `regla2`
--
ALTER TABLE `regla2`
  ADD PRIMARY KEY (`id_reg2`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `regla3`
--
ALTER TABLE `regla3`
  ADD PRIMARY KEY (`id_reg3`),
  ADD KEY `pk_id_raci` (`pk_id_raci`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `otros_recursos`
--
ALTER TABLE `otros_recursos`
  MODIFY `id_otr_rec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pasprah`
--
ALTER TABLE `pasprah`
  MODIFY `id_pasprah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pmu`
--
ALTER TABLE `pmu`
  MODIFY `id_pmu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prah`
--
ALTER TABLE `prah`
  MODIFY `id_prah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `raci`
--
ALTER TABLE `raci`
  MODIFY `id_raci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `regla2`
--
ALTER TABLE `regla2`
  MODIFY `id_reg2` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `regla3`
--
ALTER TABLE `regla3`
  MODIFY `id_reg3` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `otros_recursos`
--
ALTER TABLE `otros_recursos`
  ADD CONSTRAINT `otros_recursos_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);

--
-- Filtros para la tabla `pasprah`
--
ALTER TABLE `pasprah`
  ADD CONSTRAINT `pasprah_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);

--
-- Filtros para la tabla `pmu`
--
ALTER TABLE `pmu`
  ADD CONSTRAINT `pmu_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);

--
-- Filtros para la tabla `prah`
--
ALTER TABLE `prah`
  ADD CONSTRAINT `prah_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);

--
-- Filtros para la tabla `regla1`
--
ALTER TABLE `regla1`
  ADD CONSTRAINT `regla1_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);

--
-- Filtros para la tabla `regla2`
--
ALTER TABLE `regla2`
  ADD CONSTRAINT `regla2_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);

--
-- Filtros para la tabla `regla3`
--
ALTER TABLE `regla3`
  ADD CONSTRAINT `regla3_ibfk_1` FOREIGN KEY (`pk_id_raci`) REFERENCES `raci` (`id_raci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

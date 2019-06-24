-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2019 a las 21:03:02
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
  `pk_Id_raci` int(11) NOT NULL
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
  `pk_Id_raci` int(11) NOT NULL
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
  `pk_Id_raci` int(11) NOT NULL
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
  `pk_Id_raci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raci`
--

CREATE TABLE `raci` (
  `id_raci` int(11) NOT NULL,
  `entidad_raci` int(11) NOT NULL,
  `clave_insus_raci` varchar(7) NOT NULL,
  `clave_inegi_raci` varchar(9) NOT NULL,
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
  `pk_Id_raci` int(11) NOT NULL
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
  `pk_Id_raci` int(11) NOT NULL
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
  `pk_Id_raci` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int(11) NOT NULL,
  `nombre_usu` varchar(30) NOT NULL,
  `apellidos_usu` varchar(60) NOT NULL,
  `usuario_usu` varchar(20) NOT NULL,
  `correo_usu` varchar(100) NOT NULL,
  `password_usu` varchar(100) NOT NULL,
  `estado_usu` int(11) NOT NULL,
  `rol_usu` int(11) NOT NULL,
  `pk_estado_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `nombre_usu`, `apellidos_usu`, `usuario_usu`, `correo_usu`, `password_usu`, `estado_usu`, `rol_usu`, `pk_estado_usu`) VALUES
(1, 'Bernardino', 'Games Cabanzo', '@Berna', 'bernardinogamescabanzo@hotmail.com', '12345', 1, 1, 3);

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
  ADD PRIMARY KEY (`id_otr_rec`);

--
-- Indices de la tabla `pasprah`
--
ALTER TABLE `pasprah`
  ADD PRIMARY KEY (`id_pasprah`);

--
-- Indices de la tabla `pmu`
--
ALTER TABLE `pmu`
  ADD PRIMARY KEY (`id_pmu`);

--
-- Indices de la tabla `prah`
--
ALTER TABLE `prah`
  ADD PRIMARY KEY (`id_prah`);

--
-- Indices de la tabla `raci`
--
ALTER TABLE `raci`
  ADD PRIMARY KEY (`id_raci`);

--
-- Indices de la tabla `regla1`
--
ALTER TABLE `regla1`
  ADD PRIMARY KEY (`id_reg1`);

--
-- Indices de la tabla `regla2`
--
ALTER TABLE `regla2`
  ADD PRIMARY KEY (`id_reg2`);

--
-- Indices de la tabla `regla3`
--
ALTER TABLE `regla3`
  ADD PRIMARY KEY (`id_reg3`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
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
  MODIFY `id_prah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `raci`
--
ALTER TABLE `raci`
  MODIFY `id_raci` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

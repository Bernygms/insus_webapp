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

--
-- Estructura de tabla para la tabla `usuarios`
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
  `pk_estado_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuario` (`id_usu`, `nombre_usu`, `apellidos_usu`, `usuario_usu`, `correo_usu`, `password_usu`, `estado_usu`, `rol_usu`, `pk_estado_usu`) VALUES
(1, 'Bernardino', 'Games Cabanzo', '@Berna', 'bernardinogamescabanzo@hotmail.com', '12345', 1, 1, 3);

--
-- Índices para tablas volcadas
--


ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);


ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

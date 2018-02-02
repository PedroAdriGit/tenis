-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-01-2018 a las 18:40:06
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_tenis`
--
CREATE DATABASE IF NOT EXISTS `BD_TENIS_PEDROPABLO` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `BD_TENIS_PEDROPABLO`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

DROP TABLE IF EXISTS `jugadores`;
CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nivel_tenis` enum('0','1','2','3','4','5') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nivel_padel` enum('0','1','2','3','4','5') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `edad` int(2) NOT NULL,
  `sexo` enum('hombre','mujer','otro','') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esSocio` enum('si','no') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `disponibilidad` enum('L-Vmornings','L-Vevenings','WeekendMornings','WeekendEvenings') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Observaciones` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `nombre`, `apellidos`, `telefono`, `email`, `nivel_tenis`, `nivel_padel`, `edad`, `sexo`, `esSocio`, `disponibilidad`, `Observaciones`, `id_usuario`) VALUES
(11, 'Pedro Pablo', 'Perez Lopez', '670836484', 'pedromail@gmail.com', '0', '0', 24, 'hombre', 'si', 'WeekendEvenings', '', 8),
(12, 'Maria Jesus', 'Sanchez Lopez', '616412219', 'majesan@gmail.com', '1', '0', 23, 'mujer', 'si', 'WeekendMornings', '', 9),
(13, 'Juan Manuel', 'Perez Gomez', '616414581', 'jmanuper@gmail.com', '3', '2', 14, 'hombre', 'no', 'L-Vevenings', '', 10),
(14, 'Maria Luisa', 'Martin Lopez', '615423896', 'mlumar@gmail.com', '1', '2', 16, 'mujer', 'si', 'WeekendMornings', '', 11),
(15, 'Silvia', 'Moreno Moreno', '636412131', 'sluvi@gmail.com', '3', '2', 27, 'mujer', 'si', 'L-Vevenings', '', 12),
(16, 'Juan Jose', 'Lopez Luz', '612321141', 'jjolo@gmail.com', '4', '3', 17, 'hombre', 'no', 'L-Vevenings', '', 13),
(17, 'Maria del Carmen', 'Perez Tejero', '645141721', 'mcarpe@gmail.com', '2', '4', 22, 'mujer', 'no', 'WeekendMornings', '', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_admin`
--

DROP TABLE IF EXISTS `login_admin`;
CREATE TABLE `login_admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password_admin` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `login_admin`
--

INSERT INTO `login_admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'pedro_admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`) VALUES
(8, 'plpedro', '827ccb0eea8a706c4c34a16891f84e7b'),
(9, 'MJesusSan', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'jmanuper', '81dc9bdb52d04dc20036dbd8313ed055'),
(11, 'mlumar', '25f9e794323b453885f5181f1b624d0b'),
(12, 'sluvi', '185aef3b1c810799a6be8314abf6512c'),
(13, 'jjolo', '827ccb0eea8a706c4c34a16891f84e7b'),
(14, 'mcarpe', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`);

--
-- Indices de la tabla `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `login_admin`
--
ALTER TABLE `login_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2017 a las 09:31:56
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `task_manager`
--
CREATE DATABASE IF NOT EXISTS `task_manager` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `task_manager`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `admin_password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `admin_mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_password`, `admin_mail`) VALUES
(1, 'admin', 'admin', 'admin@admin.com'),
(2, 'admin2', 'admin2', 'admin2@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `client_password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `client_mail` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_password`, `client_mail`) VALUES
(1, 'David', '1234', 'david@david.com'),
(2, 'Juan', '4321', 'juan@juan.com'),
(3, 'Ola', 'bla', 'ola@ola.com'),
(5, 'fran', 'fran', 'fran@fran.com'),
(8, 'Raul', 'raul', 'raul@raul.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packs`
--

DROP TABLE IF EXISTS `packs`;
CREATE TABLE `packs` (
  `pack_id` int(11) NOT NULL,
  `pack_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pack_desc` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `packs`
--

INSERT INTO `packs` (`pack_id`, `pack_name`, `pack_desc`) VALUES
(1, 'pack1', 'Descripción de este nuestro pack 1'),
(2, 'pack2', 'Remitirse a la descripción del pack 1 sustituyendo el 1 por un 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `task_description` longtext COLLATE utf8_spanish_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tech_id` int(11) DEFAULT NULL,
  `task_date_start` datetime DEFAULT NULL,
  `task_date_end` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `task_time_seconds` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_name`, `task_description`, `client_id`, `tech_id`, `task_date_start`, `task_date_end`, `status_id`, `task_time_seconds`) VALUES
(1, 'tarea1', '', NULL, NULL, NULL, NULL, 0, 0),
(2, 'tarea2', '', NULL, NULL, NULL, NULL, 0, 0),
(3, 'tarea3', '', NULL, NULL, NULL, NULL, 0, 0),
(4, 'task1', '', NULL, NULL, NULL, NULL, 0, 0),
(5, 'task2', '', NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `technicians`
--

DROP TABLE IF EXISTS `technicians`;
CREATE TABLE `technicians` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tech_password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tech_mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `technicians`
--

INSERT INTO `technicians` (`tech_id`, `tech_name`, `tech_password`, `tech_mail`) VALUES
(1, 'tecnico1', '1234', 'tecnico1@tecnico1.com'),
(2, 'tecnico2', '4321', 'tecnico2@tecnico2.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_mail` (`admin_mail`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_mail` (`client_mail`);

--
-- Indices de la tabla `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indices de la tabla `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`tech_id`),
  ADD UNIQUE KEY `tech_mail` (`tech_mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `packs`
--
ALTER TABLE `packs`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `technicians`
--
ALTER TABLE `technicians`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

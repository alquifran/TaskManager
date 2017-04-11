-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2017 a las 10:53:32
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
(1, 'admin', '$2y$10$45A7j9oOEwIaI4MxNmjrkewzQpMZ1iuyAkxAMxElzio3po6K10PBa', 'admin@admin.com'),
(2, 'admin2', '$2y$10$aErKssBvViq.Q43y8flZReez43uakHSvz8mcxeelOMCgFm3NKpIEG', 'admin2@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `client_password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `client_mail` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `client_alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_password`, `client_mail`, `client_alta`) VALUES
(1, 'David', '$2y$10$6dmxOtLTbRPUT9XzVJbhvede2PcDTo3GB80AtuJizh/FFc.pIIYe6', 'david@david.com', 0),
(2, 'Juan', '$2y$10$oWRGZne1Ki/RtkjGcKtxJO28lQYwzrnQ5IaUl4/.ZJt.Q1N/I.dry', 'juan@juan.com', 1),
(3, 'Ola', '$2y$10$ltheKZKgfd2TlA6hqId5deaLNy3eBApOBH2Extb8jDnWoYHP9AI7S', 'ola@ola.com', 0),
(5, 'fran', '$2y$10$79x4ens2Qf/2sLK6RXD8H.qlDtYpgkeMJsHWSXDbuAx.g7tqbBkZO', 'fran@fran.com', 1),
(8, 'Raul', '$2y$10$5r6aN0jwOURKC/Heu5NNXue.vGNz.g9KBqYnFUaL5vChtvyGb3A82', 'raul@raul.com', 1),
(9, 'mario', '$2y$10$wZT6zJv8zYqIyGjhK/iL..GgENsYsje10QXvwkhF0cjmhEGlbtuoK', 'mario@mario.mario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_pack`
--

DROP TABLE IF EXISTS `client_pack`;
CREATE TABLE `client_pack` (
  `client_pack_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `consumed_time` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `client_pack`
--

INSERT INTO `client_pack` (`client_pack_id`, `client_id`, `pack_id`, `consumed_time`, `status`) VALUES
(1, 1, 1, 0, 'active'),
(2, 2, 2, 0, ''),
(3, 2, 1, 0, ''),
(4, 2, 2, 0, ''),
(5, 2, 1, 0, ''),
(6, 2, 2, 0, ''),
(7, 2, 2, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packs`
--

DROP TABLE IF EXISTS `packs`;
CREATE TABLE `packs` (
  `pack_id` int(11) NOT NULL,
  `pack_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pack_desc` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `pack_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `packs`
--

INSERT INTO `packs` (`pack_id`, `pack_name`, `pack_desc`, `pack_time`) VALUES
(1, 'pack1', 'Pack 1 con x minutos de trabajo', 0),
(2, 'pack2', 'Pack 2 con "y" minutos de trabajo', 0);

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
(4, 'task11111', 'fddf', NULL, 1, NULL, NULL, 2, 0),
(5, 'task2', '', NULL, 1, NULL, NULL, 0, 0),
(11, 'Tarea2', 'Tarea2', 3, 1, NULL, NULL, 1, NULL),
(14, 'Blanco', 'Cliente en blanco', NULL, 1, NULL, NULL, 1, NULL),
(16, 'Tearea 4', 'Aprender a mecanografiar', 8, 1, NULL, NULL, 0, NULL),
(18, 'ADfadsf', 'fadssafa', 2, 2, NULL, NULL, 0, NULL),
(19, 'Enviar a cliente', 'lo dicho', 2, 2, NULL, NULL, 2, NULL),
(20, 'abdcefg', 'sentadito me quede', 1, 2, NULL, NULL, 0, NULL),
(21, 'asdfasdf', '', NULL, 1, NULL, NULL, 2, NULL),
(22, 'Dddd', '', NULL, NULL, NULL, NULL, 0, NULL),
(23, 'Fff', '', NULL, NULL, NULL, NULL, 0, NULL),
(24, 'tarea de mario', 'taraearstaereataera', 9, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `technicians`
--

DROP TABLE IF EXISTS `technicians`;
CREATE TABLE `technicians` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tech_password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tech_mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tech_alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `technicians`
--

INSERT INTO `technicians` (`tech_id`, `tech_name`, `tech_password`, `tech_mail`, `tech_alta`) VALUES
(1, 'tecnico1', '$2y$10$6VmQDpeYZKHrR9PVPTAZguIc3V9bA4w15noreW6FO6.Zdpy/SJX6S', 'tecnico1@tecnico1.com', 1),
(2, 'tecnico2', '$2y$10$mHrzkit2ZVxJK7YWdG2YGOxG7ypFZ8poG/.ftSPN7drbGTYNZfK56', 'tecnico2@tecnico2.com', 1),
(3, 'tec3', '$2y$10$Kl6jLbZKTySkfe4.4HcIj.oWE8AgR9ksHOXg1WQzNw7VTyGoa/k8K', 'tec3@tec3.com', 0);

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
-- Indices de la tabla `client_pack`
--
ALTER TABLE `client_pack`
  ADD PRIMARY KEY (`client_pack_id`),
  ADD KEY `pack_clients_id_idx` (`client_id`),
  ADD KEY `pack_pack_id_idx` (`pack_id`);

--
-- Indices de la tabla `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_clients_id_idx` (`client_id`),
  ADD KEY `task_techs_id_idx` (`tech_id`);

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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `client_pack`
--
ALTER TABLE `client_pack`
  MODIFY `client_pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `packs`
--
ALTER TABLE `packs`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `technicians`
--
ALTER TABLE `technicians`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `client_pack`
--
ALTER TABLE `client_pack`
  ADD CONSTRAINT `pack_clients_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pack_pack_id` FOREIGN KEY (`pack_id`) REFERENCES `packs` (`pack_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `task_clients_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `task_techs_id` FOREIGN KEY (`tech_id`) REFERENCES `technicians` (`tech_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

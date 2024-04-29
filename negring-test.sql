-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2024 a las 08:02:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db-productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `detalle` varchar(30) NOT NULL,
  `stock` int(5) NOT NULL,
  `visibilidad` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `detalle`, `stock`, `visibilidad`) VALUES
(1, 'MARIO ODDYSEI', 'NUEVO', 5, 0),
(2, 'KIRBY STAR ALLIES', 'USADO', 20, 0),
(3, 'METROID PRIME REMASTERED', 'UTIL', 30, 0),
(4, 'FIRE EMBLEM HEROS', 'NUEVO', 20, 0),
(5, 'MARIO KART WII', 'NUEVO', 30, 0),
(6, 'KIRBY RETURN TO DREAMLAND', 'USADO', 30, 0),
(7, 'METROID PRIME ECHOES', 'USADO', 20, 0),
(8, 'KIRBY AMAZYNG MIRROR', 'NUEVO', 20, 0),
(9, 'KIRBY AIR RIDE', 'NUEVO', 30, 0),
(10, 'METROID FUSION', 'USADO', 30, 0),
(11, 'MARIO PARTY 1', 'USADO', 20, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `correo` text NOT NULL,
  `cargo` text NOT NULL,
  `contrasena` text NOT NULL,
  `visibilidad` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `correo`, `cargo`, `contrasena`, `visibilidad`) VALUES
(1, 'pedrojara', 'pjara@outlook.es', 'Developer', '0', 0),
(2, 'mariaarriagada', 'marriagada@outlook.es', 'DEVELOPER', 'PASS1234', 0),
(3, 'juanmartinez', 'jmartinez@outlook.es', 'DEVELOPER', 'pass1234', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

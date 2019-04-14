-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2019 a las 04:50:39
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
-- Base de datos: `utn`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Catorce` ()  NO SQL
UPDATE `productos` as prod SET `Precio`=97.50 WHERE prod.Tamaño="Grande"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cinco` ()  NO SQL
SELECT envio.Numero FROM `envios` as envio ORDER BY envio.Numero LIMIT 3$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cuatro` ()  NO SQL
SELECT SUM(prov.Cantidad) FROM `envios` as prov WHERE 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dieciseis` ()  NO SQL
DELETE FROM `productos` WHERE pNumero=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Diecisiete` ()  NO SQL
DELETE FROM `provedores` WHERE provedores.Numero not in(SELECT envios.Numero FROM envios)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Diez` ()  NO SQL
SELECT prov.Direccion, prov.Localidad FROM `provedores` as prov WHERE prov.Nombre LIKE'%I%'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Doce` ()  NO SQL
INSERT INTO `provedores`(`Numero`) VALUES (103)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dos` ()  NO SQL
SELECT prov.Numero,prov.Nombre,prov.Direccion,prov.Localidad FROM `provedores` as prov WHERE prov.Localidad ="Quilmes"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Nueve` ()  NO SQL
SELECT envio.Numero FROM `envios` as envio,`provedores` as prov WHERE prov.Localidad="Avellaneda" and envio.Numero=prov.Numero$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Ocho` ()  NO SQL
SELECT SUM(envio.Cantidad) FROM `envios` as envio WHERE envio.Numero="102"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Once` ()  NO SQL
INSERT INTO `productos`(`pNombre`, `pNumero`, `Precio`, `Tamaño`) VALUES ("Chocolate",4,25.35,"Chico")$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Quince` ()  NO SQL
UPDATE `productos` as prod,`envios` as envio SET `Tamaño`= "Mediano" WHERE envio.Cantidad >=300 and envio.pNumero=prod.pNumero$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Seis` ()  NO SQL
SELECT prov.Nombre,prod.pNombre envios FROM `envios` as envio, `provedores` as prov,`productos` as prod WHERE prod.pNumero=envio.pNumero and prov.Numero = envio.Numero$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Siete` ()  NO SQL
SELECT SUM(envio.Cantidad*prod.Precio) FROM `envios` as envio,`productos` as prod WHERE prod.pNumero=envio.pNumero$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Trece` ()  NO SQL
INSERT INTO `provedores`(`Numero`, `Nombre`, `Localidad`) VALUES (107,"Rosales","La Plata")$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Tres` ()  NO SQL
SELECT envio.Numero,envio.pNumero,envio.Cantidad FROM `envios` as envio WHERE envio.Cantidad BETWEEN 200 and 300$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Uno` ()  NO SQL
SELECT prod.pNombre,prod.pNumero,prod.Precio,prod.Tamaño FROM `productos` as prod ORDER BY prod.pNombre$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `Numero` int(18) NOT NULL,
  `pNumero` int(18) NOT NULL,
  `Cantidad` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`Numero`, `pNumero`, `Cantidad`) VALUES
(100, 1, 500),
(100, 2, 1500),
(100, 3, 100),
(101, 2, 55),
(101, 3, 225),
(102, 1, 600),
(102, 3, 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pNombre` varchar(30) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `pNumero` int(18) NOT NULL,
  `Precio` float DEFAULT NULL,
  `Tamaño` varchar(20) COLLATE ucs2_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`pNombre`, `pNumero`, `Precio`, `Tamaño`) VALUES
('Cigarrillos', 2, 45.89, 'Mediano'),
('Gaseosa', 3, 97.5, 'Mediano'),
('Chocolate', 4, 25.35, 'Chico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedores`
--

CREATE TABLE `provedores` (
  `Numero` int(18) NOT NULL,
  `Nombre` varchar(30) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `Direccion` varchar(50) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `Localidad` varchar(80) COLLATE ucs2_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci;

--
-- Volcado de datos para la tabla `provedores`
--

INSERT INTO `provedores` (`Numero`, `Nombre`, `Direccion`, `Localidad`) VALUES
(100, 'Perez', 'Perón 876', 'Quilmes'),
(101, 'Gimenez', 'Mitre 750', 'Avellaneda'),
(102, 'Aguirre', 'Boedo 634', 'Bernal'),
(103, NULL, NULL, NULL),
(107, 'Rosales', NULL, 'La Plata');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`Numero`,`pNumero`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pNumero`);

--
-- Indices de la tabla `provedores`
--
ALTER TABLE `provedores`
  ADD PRIMARY KEY (`Numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

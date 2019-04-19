-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 08:09 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumnosutn`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(18) NOT NULL,
  `nombre` varchar(30) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `apellido` varchar(30) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `legajo` int(18) DEFAULT NULL,
  `edad` int(18) DEFAULT NULL,
  `imagen` varchar(200) COLLATE ucs2_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellido`, `legajo`, `edad`, `imagen`) VALUES
(1, 'Jonathan', 'Perez', 1, 19, 'cualquiera.jpg'),
(2, 'Jonathan', 'Perez', 2, 19, 'fotito.jpg'),
(4, 'Jonathan', 'Perez', 1050, 17, 'cualquiera.jpg'),
(8, 'Jonathan', 'Peralta', 1056, 19, './Fotos/Jonathan1056.jpg'),
(9, 'Jonathan', 'Peralta', 1057, 19, './Fotos/Jonathan1057.jpg'),
(10, 'Nahuel', 'Martinez', 1058, 25, './Fotos/Nahuel1058.jpg'),
(11, 'Alberto', 'Perez', 1059, 24, './Fotos/Alberto1059.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

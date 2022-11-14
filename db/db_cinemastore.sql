-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 23:56:10
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cinemastore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Camaras'),
(2, 'Tripodes'),
(11, 'Iluminación'),
(12, 'Sonido'),
(16, 'Microfonos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `rating` int(1) NOT NULL,
  `id_product_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `comment`, `rating`, `id_product_fk`) VALUES
(4, 'EDIT via API', 8, 3),
(5, 'asdasdasd', 10, 42),
(7, 'comment via API', 5, 29),
(8, 'comment via API', 5, 3),
(9, 'comment via API', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_products_fk` int(11) NOT NULL,
  `path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `id_products_fk`, `path`) VALUES
(4, 37, 'img/products634af20500a9c.jpg'),
(5, 34, 'img/products634af2c3220ea.jpg'),
(6, 34, 'img/products634af2d5f04bd.jpg'),
(7, 18, 'img/products634af3f918020.jpg'),
(8, 18, 'img/products634af4c3a1e39.jpg'),
(9, 37, 'img/products634af6bee8d59.jpg'),
(10, 37, 'img/products/634afcaae84bc.jpg'),
(11, 37, 'img/products/img634afcc743b04.jpg'),
(12, 37, 'img/products634afcd2dd857.jpg'),
(13, 37, 'img/products634afcdab59fb.jpg'),
(14, 7, 'img/products634e025cbef7f.jpg'),
(15, 18, 'img/products634e037a7daa3.jpg'),
(16, 29, 'img/products634e040057329.jpg'),
(17, 30, 'img/products634e0463ad36d.jpg'),
(18, 31, 'img/products634e0537c0afd.jpg'),
(19, 32, 'img/products634e0596d9b56.jpg'),
(20, 34, 'img/products634e05e666a25.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `country` varchar(45) NOT NULL,
  `brand` varchar(45) NOT NULL,
  `techChar` varchar(500) NOT NULL,
  `id_categories_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `model`, `price`, `country`, `brand`, `techChar`, `id_categories_fk`) VALUES
(3, 'ESO C300 Mark II', 1374999, 'Japón', 'Canon', 'Incorpora el nuevo sensor DGO 4k Super 35mm', 1),
(7, 'Canon XA40', 816000, 'Estados Unidos', 'Canon', 'Grabación 4K UHD 30p, Lente zoom óptico 20X, Pantalla táctil LCD de 3 pulgadas', 1),
(18, 'Neewer 100W', 78225, 'Estados Unidos', 'Neewer', 'Luz de 5600 Kelvin, CRI 97+, TLCI 97+, 11000 Lux', 11),
(29, 'BOYA BY M1 ', 7850, 'Estados Unidos', 'BOYA', 'Micrófono Lavalier, sonido omnidireccional, Baterias 1 LR44', 16),
(30, 'GVM Luz LED bicolor', 134400, 'Estados Unidos', 'GVM', 'Temperatura bicolor y ajuste sin pasos, 97+ G100W, TLCI 97+, rango de temperatura Kelvin de 3200K a 5600K', 11),
(31, 'Tascam Portacapture X8', 225734, 'Australia', 'TASCAM', '4 Entradas de micrófono XLR R/TRS con fuente de alimentación individual (24 V / 48 V), condensador de diafragma grande desmontable de 0.575', 12),
(32, 'Tascam DP-24SD', 315000, 'Estados Unidos', 'TASCAM', '19 faders elimina la estructuración de capas, 12 pomos giratorios conectados a la pantalla LCD, medios SD/SDHC de estado sólido', 12),
(34, 'TH-05', 20475, 'Estados Unidos', 'TASCAM', 'Sensibilidad 95 db (+/- 3dB), respuesta de frecuencia 15hz - 22kHz, impedencia 32Ω', 12),
(37, 'Canon EOS C300 Mark II', 788000, 'EEUU', 'Canon', 'Sensor CMOS de 1.378 4K, 2 salidas 3G-SDI, 2 entradas CLR, 2 Ranuras tarjetas CFast', 1),
(38, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(39, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(40, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(41, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(42, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(43, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(44, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(45, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(46, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(47, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(48, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(49, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(50, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(51, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1),
(52, 'modeloPOST', 0, 'countryPOSTPostman', 'brandPOSTPostman', 'charPOSTPostman', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$6tXj9lmGN/7jta5gXwkRt.NkfjHraM1G1QeXsOFNqm7D.iRM46uSi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product_fk` (`id_product_fk`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`id_products_fk`),
  ADD KEY `id_products_fk` (`id_products_fk`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categories_fk` (`id_categories_fk`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_product_fk`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_products_fk`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_categories_fk`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

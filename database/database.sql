-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-11-2024 a las 15:45:12
-- Versión del servidor: 8.0.39-0ubuntu0.24.04.2
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `order_id`, `name`, `email`, `comment`) VALUES
(1, 1, NULL, NULL, NULL),
(2, 1, NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL),
(4, 2, NULL, NULL, NULL),
(5, 3, NULL, NULL, NULL),
(6, 3, NULL, NULL, NULL),
(7, 3, NULL, NULL, NULL),
(8, 4, NULL, NULL, NULL),
(9, 4, NULL, NULL, NULL),
(10, 4, NULL, NULL, NULL),
(11, 1, NULL, NULL, NULL),
(12, 2, NULL, NULL, NULL),
(13, 2, NULL, NULL, NULL),
(14, 3, NULL, NULL, NULL),
(15, 3, NULL, NULL, NULL),
(16, 3, NULL, NULL, NULL),
(17, 4, NULL, NULL, NULL),
(18, 4, NULL, NULL, NULL),
(19, 4, NULL, NULL, NULL),
(20, 4, NULL, NULL, NULL),
(21, 1, NULL, NULL, NULL),
(22, 2, NULL, NULL, NULL),
(23, 2, NULL, NULL, NULL),
(24, 3, NULL, NULL, NULL),
(25, 3, NULL, NULL, NULL),
(26, 3, NULL, NULL, NULL),
(27, 4, NULL, NULL, NULL),
(28, 4, NULL, NULL, NULL),
(29, 4, NULL, NULL, NULL),
(30, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`image_id`, `image_url`) VALUES
(1, 'http://example.com/image1.jpg'),
(2, 'http://example.com/image2.jpg'),
(3, 'http://example.com/image3.jpg'),
(4, 'http://example.com/image4.jpg'),
(5, 'http://example.com/image5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `shipping_status` varchar(50) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `tracking_id`, `shipping_status`, `last_update`) VALUES
(1, '1234567890', 'In Transit', '2023-06-15 10:00:00'),
(2, '0987654321', 'Delivered', '2023-06-14 15:30:00'),
(3, '1122334455', 'In Transit', '2023-06-16 09:45:00'),
(4, '5566778899', 'Delivered', '2023-06-13 11:20:00'),
(5, '9999999666', 'Delivered', '2023-06-17 13:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `stock`) VALUES
(1, 'Producto 1', 'Descripción del producto 1', 10.00, 100),
(2, 'Producto 2', 'Descripción del producto 2', 20.00, 50),
(3, 'Producto 3', 'Descripción del producto 3', 30.00, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_images`
--

CREATE TABLE `product_images` (
  `product_image_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `image_id` int DEFAULT NULL,
  `cover` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `product_images`
--

INSERT INTO `product_images` (`product_image_id`, `product_id`, `image_id`, `cover`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 0),
(3, 1, 2, 0),
(4, 2, 3, 1),
(5, 2, 4, 1),
(6, 3, 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `image_id` (`image_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product_images`
--
ALTER TABLE `product_images`
  MODIFY `product_image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Filtros para la tabla `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_images_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

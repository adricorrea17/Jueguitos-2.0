-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2022 a las 22:08:43
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_correa_adrian`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `carrito_id` int(10) UNSIGNED NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`carrito_id`, `usuario_fk`) VALUES
(22, 22),
(24, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
(1, 'Playstation 4'),
(2, 'Xbox One'),
(3, 'Nintendo Switch');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `compras_id` int(10) UNSIGNED NOT NULL,
  `carrito_fk` int(10) UNSIGNED NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `productos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(10) UNSIGNED NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `categoria_fk` tinyint(3) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `usuario_fk`, `categoria_fk`, `titulo`, `precio`, `descripcion`, `imagen`) VALUES
(1, 22, 1, 'God Of War Ragnarok', '145.99', 'God of Wars es un videojuego de acción-aventura desarrollado por SCE Santa Monica Studio y publicado por Sony Interactive Entertainment. Su lanzamiento se produjo el 20 de abril de 2018 como un título exclusivo para la consola PlayStation 4. Será lanzado en Microsoft Windows el 14 de enero de 2022.', 'god.jpg'),
(2, 22, 2, 'BATTLEFIELD V', '89.99', 'Battlefield V es un videojuego de acción bélica desarrollado por DICE y editado por EA ambientado en la Segunda Guerra Mundial. Esta entrega de la exitosa franquicia FPS dispone de un modo campaña compuesto por varias historias con diferentes protagonistas y ubicaciones así como una vertiente multijugador.', 'btf5.jpg'),
(3, 22, 2, 'METAL GEAR SOLID V GROUND ZEROES', '59.99', 'METAL GEAR SOLID V GROUND ZEROES\', \'Metal Gear Solid V: Ground Zeroes es un videojuego de acción-aventura y sigilo desarrollado por Kojima Productions y producido por Konami.​​ Es parte de una subserie de precuelas de la saga Metal Gear, que tiene lugar un año después de los eventos sucedidos en Metal Gear Solid: Peace Walker.', 'metalgear.jpg'),
(4, 22, 1, 'GUARDIANS OF THE GALAXY', '45.89', 'GUARDIANS OF THE GALAXY\', \'Marvels Guardians of the Galaxy es un juego de un acción y aventura de un solo jugador, es también una historia completamente original y aunque se notan las influencias del mundo y de los personajes con los que James Gunn nos ha enamorado en sus películas, no deja de ser su propia historia', 'guardians.jpg'),
(5, 22, 1, 'UNCHARTED 4', '63.80', 'UNCHARTED 4\', \'Uncharted 4: El desenlace del ladrón, es un videojuego de acción-aventura en tercera persona, lanzado el 10 de mayo de 2016, distribuido por Sony Computer Entertainment y desarrollado por Naughty Dog exclusivamente para PlayStation 4.', 'uncharted.jpg'),
(6, 22, 2, 'RISE OF THE TOMB RAIDER', '59.99', 'RISE OF THE TOMB RAIDER\', \'La veterana Lara Croft protagoniza este videojuego de acción y supervivencia dentro de la ya conocida readaptación de la saga Tomb Raider que sigue explorando los orígenes de la conocida heroína y aventurera. Esta entrega, de nombre Rise of the Tomb Raider presenta una depurada técnica de animación, mayores áreas de exploración y un nuevo guión.', 'tomb.jpg'),
(7, 22, 1, 'THE LAST OF US PART II', '99.99', 'THE LAST OF US PART II\', \'The Last of Us Part II es un juego de acción y aventuras de 2020 desarrollado por Naughty Dog y publicado por Sony Interactive Entertainment para PlayStation 4.', 'tlou2.jpg'),
(8, 22, 2, 'MORTAL KOMBAT 11', '89.99', 'MORTAL KOMBAT 11\', \'NetherRealm Studios da vida a Mortal Kombat 11, un nuevo capítulo de esta veterana serie de videojuegos de lucha que llega con las mayores opciones de personalización vistas en la serie hasta la fecha.', 'mk11.jpg'),
(9, 22, 3, 'Animal Crossing', '129.99', 'Animal Crossing\', \'Animal Crossing: New Horizons supone el estreno de la exitosa saga en Nintendo Switch, un colorido simulador de vida que invita a los jugadores a participar en el Plan de Asentamiento en Islas Desiertas de Nook Inc. y disfrutar de una vida placentera repleta de creatividad, encanto y libertad', 'animal.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_agregado`
--

CREATE TABLE `producto_agregado` (
  `producto_agregado_id` int(10) UNSIGNED NOT NULL,
  `carrito_fk` int(10) UNSIGNED NOT NULL,
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `rol_fk` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `rol_fk`, `email`, `password`, `nombre`, `apellido`) VALUES
(22, 1, 'adriancorrea@gmail.com', '$2y$10$tFMOS2vXoQXHDHnxOZV.rOaDpQ8uxTvkS73zMFtcnW/jc1OsQI7V.', 'Adrian', 'Correa'),
(24, 2, 'pepe@123.com', '$2y$10$veWNeiEALDd/9UCi6Oz3/.bWLrleXiy7ypgEhfh/xRchvn9MtulJC', 'pepe', 'tatita');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`carrito_id`),
  ADD KEY `fk_Carrito_Usuarios1_idx` (`usuario_fk`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`compras_id`),
  ADD KEY `fk_compras_Carrito1_idx` (`carrito_fk`),
  ADD KEY `fk_compras_Usuarios1_idx` (`usuario_fk`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `fk_Productos_Usuarios_idx` (`usuario_fk`),
  ADD KEY `fk_Productos_Categorias1_idx` (`categoria_fk`);

--
-- Indices de la tabla `producto_agregado`
--
ALTER TABLE `producto_agregado`
  ADD PRIMARY KEY (`producto_agregado_id`),
  ADD KEY `fk_producto_agregado_Productos1_idx` (`producto_fk`),
  ADD KEY `fk_producto_agregado_Carrito1_idx` (`carrito_fk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_Usuarios_roles1_idx` (`rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `carrito_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `compras_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `producto_agregado`
--
ALTER TABLE `producto_agregado`
  MODIFY `producto_agregado_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_Carrito_Usuarios1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_Carrito1` FOREIGN KEY (`carrito_fk`) REFERENCES `carrito` (`carrito_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_Usuarios1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`categoria_fk`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_agregado`
--
ALTER TABLE `producto_agregado`
  ADD CONSTRAINT `fk_producto_agregado_Carrito1` FOREIGN KEY (`carrito_fk`) REFERENCES `carrito` (`carrito_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_agregado_Productos1` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_roles1` FOREIGN KEY (`rol_fk`) REFERENCES `roles` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

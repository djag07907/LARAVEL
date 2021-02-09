-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2019 a las 16:28:39
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectolaravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(3, 'harinas', 'todas las harinas', 1, NULL, '2018-12-13 23:07:51'),
(4, 'pastas', 'todas las pastas', 1, NULL, NULL),
(5, 'detergentes', 'varios detergentes', 1, '2018-12-12 22:59:21', '2018-12-12 22:59:21'),
(6, 'resfrescos', 'varios resfrescos', 1, '2018-12-13 02:06:19', '2018-12-13 23:08:08'),
(9, 'cervezas', 'todas las cervezas', 1, '2018-12-16 22:25:06', '2018-12-16 23:19:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'pedro', 'CEDULA', '123456', 'av carlota', '123456', 'pedro@gmail.com', NULL, NULL),
(2, 'franco', 'CEDULA', '1234569', 'av caracas', '78963', 'franco@gmail.com', '2018-12-20 20:11:17', '2018-12-20 20:11:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `idproveedor` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_compra` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `idproveedor`, `idusuario`, `tipo_identificacion`, `num_compra`, `fecha_compra`, `impuesto`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'FACTURA', '001', '2019-01-08 00:00:00', '0.20', '20.00', 'Anulado', '2019-01-09 02:25:41', '2019-01-09 03:57:56'),
(4, 1, 1, 'FACTURA', '003', '2019-01-08 00:00:00', '0.20', '20.00', 'Anulado', '2019-01-09 04:11:29', '2019-01-09 04:12:24');

--
-- Disparadores `compras`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockCompraAnular` AFTER UPDATE ON `compras` FOR EACH ROW BEGIN
  UPDATE productos p
    JOIN detalle_compras di
      ON di.idproducto = p.id
     AND di.idcompra = new.id
     set p.stock = p.stock - di.cantidad;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcompra` int(10) UNSIGNED NOT NULL,
  `idproducto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id`, `idcompra`, `idproducto`, `cantidad`, `precio`) VALUES
(4, 3, 5, 10, '1.00'),
(5, 3, 4, 10, '1.00'),
(6, 4, 5, 10, '1.00'),
(7, 4, 4, 10, '1.00');

--
-- Disparadores `detalle_compras`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockCompra` AFTER INSERT ON `detalle_compras` FOR EACH ROW BEGIN
 UPDATE productos SET stock = stock + NEW.cantidad 
 WHERE productos.id = NEW.idproducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `idventa` int(10) UNSIGNED NOT NULL,
  `idproducto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `idventa`, `idproducto`, `cantidad`, `precio`, `descuento`) VALUES
(1, 1, 1, 25, '5.00', '0.00'),
(4, 3, 4, 10, '10.00', '0.00'),
(5, 3, 1, 10, '100.00', '0.00');

--
-- Disparadores `detalle_ventas`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_ventas` FOR EACH ROW BEGIN
 UPDATE productos SET stock = stock - NEW.cantidad 
 WHERE productos.id = NEW.idproducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_07_212527_create_categorias_table', 1),
(4, '2018_12_16_202808_create_productos_table', 2),
(5, '2018_12_19_144040_create_proveedores_table', 3),
(6, '2018_12_19_210020_create_clientes_table', 4),
(7, '2018_12_20_144948_create_roles_table', 5),
(8, '2018_12_20_000000_create_users_table', 6),
(9, '2018_12_27_214559_create_compras_table', 7),
(10, '2018_12_27_214622_create_detalle_compras_table', 7),
(11, '2019_01_09_173229_create_ventas_table', 8),
(12, '2019_01_09_173252_create_detalle_ventas_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcategoria` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `imagen` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idcategoria`, `codigo`, `nombre`, `precio_venta`, `stock`, `condicion`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 3, '12345', 'harina de maiz', '100.00', 50, 1, 'NFc59MB4XrqpIfxj.jpg', NULL, '2019-01-17 17:12:11'),
(2, 3, '799665', 'harina de trigo', '600.00', 500, 1, 'Z4cQ6H7r68TmQQHZ.jpg', NULL, '2019-01-17 17:11:59'),
(3, 3, '56666', 'harina para arepas', '50.00', 30, 1, 'gd5tfXoAbO9UYbl5.jpg', NULL, '2019-01-17 17:11:45'),
(4, 9, '5666', 'cerveza heineken', '10.00', 610, 1, '98tMaFO3SZ88RcBB.jpg', NULL, '2019-01-17 17:11:34'),
(5, 9, '46666', 'cerveza golden', '60.00', 60, 1, 'LK5yi0cT19yX33hN.jpg', NULL, '2019-01-17 17:17:34'),
(6, 5, '1111111', 'ace', '71.00', 21, 1, 'd6PRC5PLiNF5RjkW.jpg', '2018-12-19 04:05:48', '2019-01-17 19:53:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'carlos', 'CEDULA', '1234566', 'av california', '123456', 'carlos@gmail.com', NULL, NULL),
(2, 'luis1', 'CEDULA', '123456', 'av new york este', '123456', 'luis@gmail.com', '2018-12-20 02:15:01', '2018-12-20 02:15:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Administrador', 'Administrador', 1),
(2, 'Vendedor', 'Vendedor', 1),
(3, 'Comprador', 'Comprador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `idrol` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `usuario`, `password`, `condicion`, `idrol`, `imagen`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'eyter', 'CEDULA', '123456', 'av carlota', '123456', 'eyter@gmail.com', 'ucevito', '$2y$10$CZQMFRfEPJ2OzntyUDLFbecFq7TeIDcLHm91oEvHbXc5JeVPp3zgC', 1, 1, 'rwz0BXXlop8CuRW5.jpg', 'EarE1PQLOOy49AfZnwMcWumN7cHR8lKjYsourBvalysBtqVFo4KP5THc4SfX', NULL, '2019-01-17 17:52:08'),
(2, 'alberto', 'CEDULA', '123456', 'av san jose', '12345', 'alberto@gmail.com', 'alberto', '$2y$10$VaXGkFMLgOvlJuoUk5MwZe1HgG/I2IIyniQX5WDl5FPNHkdzSm3vG', 1, 3, 'b6FKnCUej9khErJi.jpg', 'xzH8uzJrmG8FTPesBKCK8K724X8SEc47TKJga3zjZN270dmDoSpm2otIKKKQ', '2018-12-21 21:39:42', '2019-01-17 21:53:20'),
(3, 'carlos', 'CEDULA', '12366', 'avenida', '5666', 'carlos@gmail.com', 'carlos', '$2y$10$X.O49b0Nw0Zy675ztoTTDuY2R1jwBhOYOBww1LC4jG9Ek9k/bVo3O', 1, 2, '4RdCWKmNooL9hmHc.jpg', 'vRhxzXdIWJ9B7ZYSiOIcVDKNSt1jrcD3xAkwNONxEI3fSuyAxgmoaKSUS6dj', '2018-12-28 02:12:37', '2019-01-17 21:53:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcliente` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_venta` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `idcliente`, `idusuario`, `tipo_identificacion`, `num_venta`, `fecha_venta`, `impuesto`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'FACTURA', '001', '2019-01-09 00:00:00', '0.20', '100.00', 'Registrado', NULL, NULL),
(3, 1, 1, 'FACTURA', '002', '2019-01-11 00:00:00', '0.20', '1100.00', 'Anulado', '2019-01-11 21:56:04', '2019-01-12 00:12:57');

--
-- Disparadores `ventas`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVentaAnular` AFTER UPDATE ON `ventas` FOR EACH ROW BEGIN
  UPDATE productos p
    JOIN detalle_ventas dv
      ON dv.idproducto = p.id
     AND dv.idventa= new.id
     set p.stock = p.stock + dv.cantidad;
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorias_nombre_unique` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_nombre_unique` (`nombre`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_idproveedor_foreign` (`idproveedor`),
  ADD KEY `compras_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_compras_idcompra_foreign` (`idcompra`),
  ADD KEY `detalle_compras_idproducto_foreign` (`idproducto`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_idventa_foreign` (`idventa`),
  ADD KEY `detalle_ventas_idproducto_foreign` (`idproducto`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_nombre_unique` (`nombre`),
  ADD KEY `productos_idcategoria_foreign` (`idcategoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proveedores_nombre_unique` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_idcliente_foreign` (`idcliente`),
  ADD KEY `ventas_idusuario_foreign` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_idproveedor_foreign` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `compras_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `detalle_compras_idcompra_foreign` FOREIGN KEY (`idcompra`) REFERENCES `compras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_compras_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_ventas_idventa_foreign` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_idcategoria_foreign` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_idcliente_foreign` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

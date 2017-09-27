-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2017 a las 15:14:16
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kimup`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `md5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `usuario`, `clave`, `md5`) VALUES
(1, 'Jefe de sala', 'sala', '6b694e8cf87fc88d392ed8ebf81d9385'),
(2, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mermas`
--

CREATE TABLE `mermas` (
  `codigo` int(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `cantidad_mermas` int(50) NOT NULL,
  `motivo` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mermas`
--

INSERT INTO `mermas` (`codigo`, `fecha`, `cantidad_mermas`, `motivo`, `id`) VALUES
(7100, '2017-09-19', 10, 'Caducidad', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meta`
--

CREATE TABLE `meta` (
  `monto` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `meta`
--

INSERT INTO `meta` (`monto`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `codigo` int(10) NOT NULL,
  `precioVenta` int(10) NOT NULL,
  `precioOferta` int(10) NOT NULL,
  `fecha1` date NOT NULL,
  `fecha2` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `proveedor` varchar(52) NOT NULL,
  `codigo` int(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `fecha` date DEFAULT NULL,
  `codigo` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `proveedor` varchar(50) NOT NULL,
  `vencimiento` date NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `precio_venta` int(10) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `minimo` int(5) NOT NULL,
  `cant_actual` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`fecha`, `codigo`, `descripcion`, `proveedor`, `vencimiento`, `cantidad`, `precio_compra`, `precio_venta`, `departamento`, `minimo`, `cant_actual`) VALUES
('2017-09-23', 7100, 'Camarones importados 500 grs.', 'Mar verde', '2017-12-21', 50, 3500, 6790, 'Congelados', 5, 50),
('2017-09-01', 7123, 'Aceite de oliva extra virgen 1lt.', 'Talliani', '2018-09-18', 200, 2500, 5400, 'Despensa', 20, 200),
('2017-09-02', 7340, 'Queso cheddar laminado', 'Dos alamos', '2017-11-03', 100, 200, 1590, 'Lacteos', 10, 100),
('2017-09-19', 7446, 'Choclo dulce 400 grs.', 'Minuto verde', '2018-01-01', 100, 600, 1599, 'Congelados', 10, 100),
('2017-09-08', 7657, 'Arroz integral 450 grs.', 'Miraflores', '2017-09-19', 200, 300, 760, 'Despensa', 30, 200),
('2017-09-18', 7665, 'Cerveza nacional 985cc.', 'Stella Artois', '2019-09-30', 100, 560, 1999, 'Bebidas y licores', 15, 100),
('2017-09-06', 7734, 'Lasagna precocida 360 grs.', 'Lucchetti', '2017-09-30', 200, 200, 608, 'Despensa', 30, 200),
('2017-09-17', 7788, 'Agua purificada con gas 500cc.', 'Benedictino', '2017-09-22', 100, 290, 439, 'Bebidas y licores', 15, 100),
('2017-09-15', 7789, 'Pechuga pollo bandeja', 'Ariztia', '2017-09-13', 100, 2000, 3832, 'Carniceria', 20, 5),
('2016-08-01', 7800, 'Galleta choco chips 125 grs', 'Costa', '2018-08-08', 3, 200, 500, 'galletas', 1, NULL),
('0000-00-00', 7876876, 'h', 'hjkbkj', '2017-08-31', 9, 7, 6, 'j', 7, 9),
('0000-00-00', 565785768, 'u', 'h', '2017-09-01', 9, 8, 6, 'k', 8, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_ext`
--

CREATE TABLE `reporte_ext` (
  `id` int(10) NOT NULL,
  `valor` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reporte_ext`
--

INSERT INTO `reporte_ext` (`id`, `valor`, `fecha`) VALUES
(1, 114.49, '2017-01-01'),
(2, 114.76, '2017-02-01'),
(3, 115.2, '2017-03-01'),
(4, 115.48, '2017-04-01'),
(5, 115.63, '2017-05-01'),
(6, 115.18, '2017-06-01'),
(7, 115.45, '2017-07-01'),
(8, 115.69, '2017-08-01'),
(9, 115, '2017-09-01'),
(10, 0, '2017-10-01'),
(11, 0, '2017-11-01'),
(12, 0, '2017-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `codigo` int(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`codigo`, `descripcion`, `cantidad`, `fecha`, `hora`, `id`) VALUES
(7123, '', 50, '2017-09-20', '05:00:00.000000', 1),
(7340, '', 10, '2017-09-20', '00:00:00.000000', 5),
(7789, '', 5, '2017-09-19', '00:00:00.000000', 6),
(7789, '', 15, '2017-09-20', '00:00:00.000000', 7),
(7446, '', 12, '2017-09-20', '00:00:00.000000', 8),
(7788, '', 18, '2017-09-20', '00:00:00.000000', 9),
(7890, '', 50, '2017-09-20', '00:00:00.000000', 12),
(7657, '', 20, '2017-09-18', '00:00:00.000000', 13),
(7665, '', 25, '2017-09-18', '00:00:00.000000', 14),
(7800, 'Galleta choco chips 200 grs', 2, '2016-08-02', '09:20:21.000000', 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mermas`
--
ALTER TABLE `mermas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_2` (`codigo`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `reporte_ext`
--
ALTER TABLE `reporte_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feha` (`fecha`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mermas`
--
ALTER TABLE `mermas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

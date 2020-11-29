-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2020 a las 20:58:56
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `becomesmarthome`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'SMARTWATCH', 'Relojes inteligentes'),
(2, 'SMART TV', 'Televisores inteligentes'),
(3, 'SMARTSPEAKER', 'Altavoces inteligentes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id_provincia` int(11) DEFAULT NULL,
  `id_localidad` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id_provincia`, `id_localidad`, `nombre`) VALUES
(1, 1, 'CIUDAD REAL'),
(2, 2, 'MÉRIDA'),
(3, 3, 'PERPIGNAN'),
(4, 4, 'BORDEAUX'),
(1, 5, 'ALMAGRO'),
(2, 6, 'BADAJOZ'),
(3, 7, 'ELNE'),
(4, 8, 'MÉRIGNAC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre`) VALUES
(1, 'ESPAÑA'),
(2, 'FRANCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_localidad` int(11) DEFAULT NULL,
  `coste` decimal(11,2) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `agencia_transporte` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `direccion`, `id_localidad`, `coste`, `estado`, `agencia_transporte`, `fecha`) VALUES
(2, 5, 'Avenida de Julio Maldonado nº 1', 0, '671.00', 'confirm', 'seur', '2020-11-21'),
(5, 5, 'Avenida de Julio Maldonado nº 1', 3, '670.89', 'confirm', 'seur', '2020-11-21'),
(9, 5, 'Avenida de Julio Maldonado nº 1', 1, '670.89', 'confirm', 'seur', '2020-11-21'),
(11, 5, 'Avenida de Julio Maldonado nº 1', 1, '490.00', 'ready', 'seur', '2020-11-21'),
(12, 5, 'Avenida de Julio Maldonado nº 1', 1, '179.00', 'sent', 'seur', '2020-11-22'),
(13, 5, 'Avenida de Julio Maldonado nº 1', 1, '199.99', 'preparation', 'seur', '2020-11-22'),
(14, 5, 'Avenida de Julio Maldonado nº 1', 1, '71.24', 'sent', 'seur', '2020-11-22'),
(15, 17, 'Avenida de Super Mario 1', 1, '435.99', 'ready', 'seur', '2020-11-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `oferta` tinyint(1) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `popular` tinyint(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_categoria`, `nombre`, `descripcion`, `imagen`, `precio`, `oferta`, `stock`, `popular`, `fecha`) VALUES
(3, 1, 'Willful Smartwatch', ' Puedes elegir entre correr, andar en bicicleta, yoga y muchos otros ejercicios, establecer una meta', 'willful-smartwatch.jpg', 29.99, 0, 20, 0, '2020-11-15'),
(4, 1, 'AIMIUVEI Smartwatch', 'AIMIUVEI Reloj Inteligente con la pantalla a color de alta definición de 1.4 pulgadas ofrece una exc', 'AIMIUVEI Smartwatch.jpg', 33.99, 0, 20, 0, '2020-11-15'),
(5, 1, 'Fitbit Versa 3 ', 'Smartwatch de salud y forma física con GPS integrado, análisis continuo de la frecuencia cardiaca', 'Fitbit-Versa-3-jpeg.jpg', 189.57, 0, 30, 0, '2020-11-15'),
(6, 1, 'LATEC Smartwatch', 'Reloj Inteligente con 1.3\" Pantalla Táctil Completa', 'latec-smartwatch-jpeg.jpg', 49.99, 0, 50, 0, '2020-11-15'),
(7, 1, 'ELEGIANT SmartWatch', 'Reloj Inteligente IP68 con Pantalla Táctil de 1.3\'\'', 'elegiant-smartwatch-jpeg.jpg', 32.99, 0, 100, 0, '2020-11-15'),
(8, 1, 'AMAZFIT Reloj', 'Actividad Bip Color Kokoda Green', 'amazfit-reloj-jpeg.jpg', 59.9, 0, 200, 0, '2020-11-15'),
(9, 1, 'ELEPHONE Reloj Inteligente', 'Smartwatch Hombre de IP67 360x360PX Rastreador de Actividad Impermeable', 'elephone-smartwatch-jpeg.jpg', 31.19, 0, 100, 0, '2020-11-15'),
(10, 1, 'CatShin Reloj Inteligente', 'Mujer,Smartwatch Hombre,Impermeable IP68,Pulsera Actividad Inteligente Medidor Presion Arterial Moni', 'catshin-smartwatch-jpeg.jpg', 31.99, 0, 73, 0, '2020-11-15'),
(11, 1, 'NAIXUES Smartwatch', 'Reloj Inteligente IP67 para Mujer Hombre, Reloj Deportivo con Pulsómetro, Cronómetro, Presión Arteri', 'NAIXUES-smartwatch-jpeg.jpg', 33.59, 0, 10, 0, '2020-11-16'),
(12, 1, 'Huawei Watch GT Fashion', 'Reloj (TruSleep, GPS, monitoreo del ritmo cardiaco), Marrón', 'huawei-watch-gt-fashion-jpeg.jpg', 99, 0, 41, 0, '2020-11-16'),
(13, 2, 'Samsung 32T4305 2020', 'Smart TV de 32\" con Resolución HD, HDR, PurColor, Ultra Clean View y Compatible con Asistentes de Vo', 'samsung-32T4305-2020-32p.jpg', 220.99, 0, 100, 0, '2020-11-16'),
(14, 2, 'Samsung Crystal UHD 2020 43TU7095', 'Smart TV de 43\" con Resolución 4K, HDR 10+, Crystal Display, Procesador 4K, PurColor, Sonido Intelig', 'samsung-crystal-uhd-2020-43TU7095-43p-4k.jpg', 490, 0, 52, 0, '2020-11-16'),
(15, 2, 'TD Systems Televisor Smart TV Android 9.0 y HBBTV', '800 PCI Hz, 3X HDMI, 2X USB. DVB-T2/C/S2, Modo Hotel - K32DLX11HS 32 pulgadas', 'TD-Systems-Smart-TV-K32DLX11HS-32p-jpg.jpg', 179, 0, 100, 0, '2020-11-16'),
(16, 2, 'Samsung 65Q70T QLED 4K 2020', 'Smart TV de 65\" con Resolución 4K UHD, Inteligencia Artificial 4K, HDR 10+, Multi View, Ambient Mode', 'Samsung-65Q70T-QLED-4K-65p.jpg', 1129, 0, 50, 0, '2020-11-16'),
(17, 2, 'Hisense 58AE7000F', 'Smart TV Resolución 4K, UHD TV 2020, con Alexa integrada, Precision Colour, escalado UHD con IA, Ult', 'hisense-58AE7000F-smart-tv-jpeg.jpg', 479.99, 0, 73, 0, '2020-11-16'),
(18, 2, 'CHiQ Televisor Smart TV LED 55 Pulgadas', ' Android 9.0, Smart TV, UHD, 4K, WiFi, Bluetooth, Google Play Store, Google Assistant, Netflix, Prim', 'ChiQ-Smar-tv-led-jpeg.jpg', 435.99, 0, 72, 0, '2020-11-16'),
(19, 2, 'Xiaomi Mi LED TV 4S 139,7 cm (55', ' 3840 x 2160 Pixeles, LED, Smart TV, WiFi, Negro', 'xiaomi-mi-led-tv-4s-55-jpeg.jpg', 464, 0, 23, 0, '2020-11-21'),
(20, 2, 'TV LED 65 pulgadas XIAOMI MI TV 4S 4K-UHD Smart TV', 'Smart TV', 'xiaomi-mi-tv-4s-4k-65-jpeg.jpg', 670.89, 0, 43, 0, '2020-11-21'),
(21, 2, 'Xiaomi Mi LED TV (32\") 4A 81,3 cm HD Smart TV WiFi Negro LED TV 4A, 81,3 cm (32\")', '1366 x 768 Pixeles, LED, Smart TV, WiFi, (Negro) [Clase de eficiencia energética A]', 'xiaomi-mi-led-tv-4a-smart-tv-jpeg.jpg', 186.72, 0, 46, 0, '2020-11-22'),
(22, 2, 'Televisor Led 32 Pulgadas HD Smart TV. Radiola LD32100KA', ' Resolución 1920 x 720P, HDMI, VGA, WiFi, TDT2, USB Multimedia, Color Negro [Clase de eficiencia ene', 'radiola-32-smart-tv-jpeg.jpg', 169.9, 0, 76, 0, '2020-11-22'),
(23, 3, 'Echo Dot (3.ª generación) ', 'Altavoz inteligente con Alexa, tela de color gris oscuro', 'Echo-Dot-3-Generacion.jpg', 49.99, 0, 57, 0, '2020-11-22'),
(24, 3, 'Gigaset Smart Speaker L800HX Blanco', 'Altavoz Inteligente, con teléfono incorporado que te permite hacer llamadas por el fijo.', 'Gigaset-Smart-Speaker-L800HX-Blanco.jpg', 78.66, 0, 42, 0, '2020-11-22'),
(25, 3, 'Echo Show (2.ª generación)', 'Mantén el contacto con la ayuda de Alexa, negro', 'echo-show-2-generacion-jpeg.jpg', 229.99, 0, 78, 0, '2020-11-22'),
(26, 3, 'Libratone Zipp 2', 'Altavoz inteligente con Alexa integrada multiroom, color verde (Pine Green)', 'libratone-zipp-2-jpeg.jpg', 124.84, 0, 87, 0, '2020-11-22'),
(27, 3, 'Energy Sistem Smart Speaker 5', 'Altavoz Inteligente con Alexa Integrado (Wi-Fi, Bluetooth, USB, Spotify/Airplay)', 'energy-sistem-smart-speaker-jpeg.jpg', 71.24, 0, 78, 0, '2020-11-22'),
(28, 3, 'Energy Sistem Smart Speaker 3', 'Talk Altavoz Inteligente con Alexa Integrado (Wi-Fi, Bluetooth, Line-in, Spotify/Airplay)', 'energy-sistem-smart-speaker-3-alexa-jpeg.jpg', 64.99, 0, 89, 0, '2020-11-22'),
(29, 3, 'Energy Sistem Smart Speaker 7', 'Torre de Sonido Inteligente con Alexa Integrado (Wi-Fi, Bluetooth, USB, Spotify/Airplay)', 'energy-sistem-smart-speaker-7-torre-sonido-jpeg.jpg', 108.96, 0, 34, 1, '2020-11-22'),
(30, 3, 'Bose - Home Speaker 500', 'Sonido estéreo con Alexa integrada, plata', 'bose-home-speaker-500-alexa-jpeg.jpg', 339.01, 1, 76, 1, '2020-11-22'),
(31, 3, 'Echo Show 8', 'Smart Speaker', 'echo-show-8-jpeg.jpg', 90, 0, 43, 1, '2020-11-22'),
(32, 3, 'Echo Studio', 'Smart Speaker', 'echo-studio-jpeg.jpg', 199.99, 1, 32, 0, '2020-11-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productopedido`
--

CREATE TABLE `productopedido` (
  `id_linea` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productopedido`
--

INSERT INTO `productopedido` (`id_linea`, `id_pedido`, `id_producto`, `unidades`) VALUES
(1, 9, 20, 1),
(2, 10, 20, 1),
(3, 11, 14, 1),
(4, 12, 15, 1),
(5, 13, 32, 1),
(6, 14, 27, 1),
(7, 15, 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_pais` int(11) DEFAULT NULL,
  `id_provincia` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_pais`, `id_provincia`, `nombre`) VALUES
(1, 1, 'CIUDAD REAL'),
(1, 2, 'BADAJOZ'),
(2, 3, 'PYRÉNÉES-ORIENTALES'),
(2, 4, 'GIRONDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_localidad` int(11) DEFAULT NULL,
  `rol` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `nombre`, `apellidos`, `direccion`, `id_localidad`, `rol`, `imagen`) VALUES
(13, 'sergiogordillo@gmail.com', '$2y$04$V7/XXQMfw.ApT2vQUAEkD.Rrjk0dhpFeo2dEoZpR92lRTxWSsvxLa', 'Sergio', 'Gordillo', 'Avenida de Julio Maldonado nº 1', 1, 'administrador', 'AIMIUVEI Smartwatch.jpg'),
(14, 'supermario@gmail.com', '$2y$04$6xR48JD/7DexaeG3N8582.JW8ZdeWPd04dOuPvCXvaLGI2R8kjP6K', 'Super Mario', 'Bros', 'Avenida de Super Mario 1', 1, 'usuario', 'AIMIUVEI Smartwatch.jpg'),
(15, 'juliomaldonado@gmail.com', '$2y$04$3Zsqgjo2N1AosPPDekUnuuDBb0Zx.4qADYSXG4RHY.7R32aSpiExa', 'Julio', 'Maldonado', 'Mi Avenida 1', 1, 'administrador', 'AIMIUVEI Smartwatch.jpg'),
(16, 'amadorrivas@gmail.com', '$2y$04$3OjoWGdhTgaIsbMNPnQH5u6MwJYvHhXHfd4kEKyEfIq5BgLpK/RJ6', 'Amador', 'Rivas', 'Calle Pinchito 1', 1, 'administrador', 'AIMIUVEI Smartwatch.jpg'),
(17, 'rickymartin@gmail.com', '$2y$04$f9CptCux2f5rk98bTCwLoeQnAcbSqQAbPwmfw7IslysY3qwg0VldO', 'Ricky', 'Martin', 'Calle Baile 1', 1, 'usuario', 'AIMIUVEI Smartwatch.jpg'),
(18, 'willsmith@gmail.com', '$2y$04$YtgJh5YP9yQZFI7Jhluyw.L51trhSBEzIXw2fKBi/ancYbQlHVZDC', 'Will', 'Smith', 'Avenida de Will 1', 5, 'usuario', 'AIMIUVEI-Smartwatch-jpg.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`),
  ADD KEY `id_provincia` (`id_provincia`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `productopedido`
--
ALTER TABLE `productopedido`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `productopedido`
--
ALTER TABLE `productopedido`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id_provincia`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

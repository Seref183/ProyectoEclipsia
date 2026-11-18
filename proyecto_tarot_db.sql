-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2026 a las 15:22:18
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
-- Base de datos: `proyecto_tarot_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arcanos_mayores`
--

CREATE TABLE `arcanos_mayores` (
  `id_mayor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `significado` text NOT NULL,
  `significado_invertido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `arcanos_mayores`
--

INSERT INTO `arcanos_mayores` (`id_mayor`, `nombre`, `numero`, `significado`, `significado_invertido`) VALUES
(1, 'El Loco', '0', 'Nuevos comienzos, espontaneidad, aventura y fe ciega en el camino.', 'Imprudencia, riesgo innecesario y temor a dar el salto.'),
(2, 'El Mago', 'I', 'Habilidad, poderes manifestados, concentración y recursos disponibles.', 'Manipulación, talento desaprovechado y malas intenciones.'),
(3, 'La Sacerdotisa', 'II', 'Intuición profunda, misterio, sabiduría interior y secretos revelados.', 'Secretos ocultos, superficialidad y desconexión con la intuición.'),
(4, 'El Emperador', 'IV', 'Autoridad, estructura, liderazgo, estabilidad y poder establecido.', 'Tiranía, rigidez, falta de control y abuso de poder.'),
(5, 'Los Amantes', 'VI', 'Amor verdadero, unión armoniosa, decisiones cruciales y valores compartidos.', 'Desarmonía, malas elecciones, indecisión y conflicto de valores.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arcanos_menores`
--

CREATE TABLE `arcanos_menores` (
  `id_menor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `palo` varchar(50) NOT NULL,
  `significado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `arcanos_menores`
--

INSERT INTO `arcanos_menores` (`id_menor`, `nombre`, `palo`, `significado`) VALUES
(1, 'As de Copas', 'Copas', 'Nuevos comienzos emocionales, amor incondicional, intuición y paz espiritual.'),
(2, 'Tres de Espadas', 'Espadas', 'Dolor del alma, desamor, tristeza, desilusión y separación dolorosa.'),
(3, 'As de Bastos', 'Bastos', 'Energía creativa desbordante, inspiración, nuevos retos profesionales y entusiasmo.'),
(4, 'Diez de Copas', 'Copas', 'Felicidad familiar absoluta, armonía en el hogar, amor duradero y plenitud emocional.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `correo`, `mensaje`) VALUES
(1, 'amane', 'ppp@hotmail.com', 'necesito mas informacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `usuario`, `password`) VALUES
(1, 'dola', '$2y$10$sIfa6q48F714D0l8hDGFuOCRnSO3QnRJwo16Z9VEd3mFm3T0r36y2'),
(2, 'amane', '$2y$10$RkWkray5.mPqIdlLxEsb.OygUey3zbuUD/y3j8JO6IZ/T4.kvcywO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_tirada` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_tarot`
--

CREATE TABLE `registros_tarot` (
  `id_registro` int(11) NOT NULL,
  `id_mayor` int(11) DEFAULT NULL,
  `id_menor` int(11) DEFAULT NULL,
  `consultante` varchar(100) DEFAULT NULL,
  `tipo_tirada` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiradas`
--

CREATE TABLE `tiradas` (
  `id_tirada` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `num_cartas` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `disponibilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tiradas`
--

INSERT INTO `tiradas` (`id_tirada`, `nombre`, `tipo`, `num_cartas`, `descripcion`, `precio`, `disponibilidad`) VALUES
(1, 'Tirada del Amor Verdadero', 'Romántica', 3, 'Explora los sentimientos profundos, bloqueos y futuro en pareja', 250.00, 20),
(2, 'Tirada Relámpago Sí o No', 'Rápida', 1, 'Respuesta directa y clara a una pregunta concreta de sí o no', 150.00, 30),
(3, 'Lectura de Chackras y Energía', 'Espiritual', 7, 'Diagnóstico completo del estado energético y emocional actual', 500.00, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arcanos_mayores`
--
ALTER TABLE `arcanos_mayores`
  ADD PRIMARY KEY (`id_mayor`);

--
-- Indices de la tabla `arcanos_menores`
--
ALTER TABLE `arcanos_menores`
  ADD PRIMARY KEY (`id_menor`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_tirada` (`id_tirada`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `registros_tarot`
--
ALTER TABLE `registros_tarot`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_mayor` (`id_mayor`),
  ADD KEY `id_menor` (`id_menor`);

--
-- Indices de la tabla `tiradas`
--
ALTER TABLE `tiradas`
  ADD PRIMARY KEY (`id_tirada`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arcanos_mayores`
--
ALTER TABLE `arcanos_mayores`
  MODIFY `id_mayor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `arcanos_menores`
--
ALTER TABLE `arcanos_menores`
  MODIFY `id_menor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros_tarot`
--
ALTER TABLE `registros_tarot`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiradas`
--
ALTER TABLE `tiradas`
  MODIFY `id_tirada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_tirada`) REFERENCES `tiradas` (`id_tirada`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `registros_tarot`
--
ALTER TABLE `registros_tarot`
  ADD CONSTRAINT `registros_tarot_ibfk_1` FOREIGN KEY (`id_mayor`) REFERENCES `arcanos_mayores` (`id_mayor`),
  ADD CONSTRAINT `registros_tarot_ibfk_2` FOREIGN KEY (`id_menor`) REFERENCES `arcanos_menores` (`id_menor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

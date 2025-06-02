-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2025 a las 23:12:46
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gescofrade`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hermandad`
--

CREATE DATABASE IF NOT EXISTS gesCofrade;
USE gesCofrade;

CREATE TABLE `hermandad` (
  `id_hermandad` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hermandad`
--

INSERT INTO `hermandad` (`id_hermandad`, `nombre`, `tipo`, `ubicacion`) VALUES
(1, 'Hermandad de Nuestro Padre Jesús Nazareno', 'Penitencial', 'Herrera, Sevilla'),
(2, 'Hermandad del Santo Entierro', 'Penitencial', 'Herrera, Sevilla'),
(3, 'Hermandad de la Borriquita', 'Penitencial', 'Herrera, Sevilla'),
(4, 'Hermandad del Rocío de Herrera', 'Gloria', 'Herrera, Sevilla'),
(5, 'Hermandad de la Virgen de los Dolores', 'Penitencial', 'Herrera, Sevilla'),
(6, 'Hermandad de Nuestro Padre Jesús Cautivo', 'Penitencial', 'Alcalá de Guadaíra, Sevilla'),
(7, 'Hermandad de la Virgen de la Paz', 'Gloria', 'Utrera, Sevilla'),
(8, 'Hermandad de la Esperanza Macarena', 'Penitencial', 'Sevilla Capital'),
(9, 'Hermandad del Rocío de Utrera', 'Gloria', 'Utrera, Sevilla'),
(10, 'Hermandad de la Virgen de los Remedios', 'Penitencial', 'Dos Hermanas, Sevilla'),
(11, 'Hermandad de Nuestro Padre Jesús Nazareno', 'Penitencial', 'Écija, Sevilla'),
(12, 'Hermandad de la Virgen del Rocío', 'Gloria', 'Alcalá de Guadaíra, Sevilla'),
(13, 'admin', 'penitencia', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hermanos`
--

CREATE TABLE `hermanos` (
  `DNI` varchar(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `id_hermandad` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`id_hermandad`))
) ;

--
-- Volcado de datos para la tabla `hermanos`
--

INSERT INTO `hermanos` (`DNI`, `nombre`, `apellido`, `direccion`, `telefono`, `id_hermandad`) VALUES
('11223344A', 'Antonio', 'López', 'Calle Real 5', '654321987', '[1,4]'),
('11223344J', 'José', 'González', 'C/ Mayor 12', '610000001', '[6]'),
('22334455B', 'Lucía', 'Martín', 'Av. de la Paz 12', '678123456', '[2]'),
('22334455M', 'María', 'Sánchez', 'C/ Real 14', '610000002', '[7]'),
('33445566C', 'Carlos', 'Ramírez', 'Calle Nueva 9', '698745632', '[3,5]'),
('33445576C', 'Carlos', 'Fernández', 'C/ Sevilla 9', '610000003', '[8]'),
('44556677D', 'Rosa', 'Moreno', 'Plaza Mayor 3', '600123987', '[1,2,3]'),
('44556677L', 'Laura', 'Hernández', 'C/ Virgen 20', '610000004', '[9]'),
('55667788A', 'Antonio', 'Pérez', 'C/ Sol 15', '610000005', '[10]'),
('55667788E', 'David', 'Serrano', 'Camino del Molino 8', '612345678', '[4,5]'),
('99999998Y', 'admin_admin', 'Test_admin', 'Avenida Inventada 456', '600000001', '[13]'),
('99999999X', 'admin', 'Test', 'Calle prueba 123', '600000000', '[13]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `referencia` varchar(100) NOT NULL,
  `elemento` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `id_hermandad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`referencia`, `elemento`, `descripcion`, `id_hermandad`) VALUES
('HBOR001XHS', 'Palmas para la Borriquita', 'Palmas blancas trenzadas', 3),
('HEM001XSE', 'Túnica de Nazareno', 'Túnica morada con cíngulo dorado', 8),
('HROC001XHS', 'Simpecado del Rocío', 'Simpecado bordado en oro', 4),
('HSE001XHS', 'Urna del Santo Entierro', 'Urna de cristal con detalles dorados', 2),
('HVD001XHS', 'Manto de la Virgen de los Dolores', 'Manto de terciopelo bordado', 5),
('JNZ001XEC', 'Faroles de procesión', 'Faroles antiguos de hierro', 11),
('NPC001XAG', 'Cruz Guía', 'Cruz de madera para procesión', 6),
('NPJN001XHS', 'Cruz Guía', 'Cruz que encabeza la procesión', 1),
('RUC001XUS', 'Carreta del Simpecado', 'Carreta de madera para la romería', 9),
('TEST001X62', 'Incensario', 'Incensario de plata usado en procesiones', 13),
('TEST002X62', 'Cruz Parroquial', 'Cruz con detalles góticos para cortejos', 13),
('TEST003X62', 'Ciriales de plata de ley', 'Juego de ciriales plateados', 13),
('TEST004X62', 'Libro de Reglas', 'Libro encuadernado con las reglas de la hermandad', 13),
('TEST005X62', 'Túnica de terciopelo morada', 'Túnica blanca con cíngulo negro', 13),
('TEST006X62', 'Estandarte', 'Estandarte bordado con el escudo de la hermandad', 13),
('TEST007X62', 'Bocina', 'Bocina de metal dorado utilizada en el cortejo', 13),
('TEST008X62', 'Candelería', 'Candelabros grandes para el paso', 13),
('TEST009X62', 'Paso de Cristo', 'Estructura del paso de misterio', 13),
('TEST010X62', 'Faroles', 'Faroles de mano para acompañamiento', 13),
('VDR001XDH', 'Medalla de la Virgen', 'Medalla en oro de la Virgen de los Remedios', 10),
('VPA001XUS', 'Candelabros', 'Candelabros para el paso de la Virgen de la Paz', 7),
('VRC001XAG', 'Simpecado bordado', 'Simpecado con bordados dorados', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `id_hermandad` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`id_hermandad`))
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_hermandad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `id_hermandad`) VALUES
    (1, 'nazareno_admin@gmail.com', 'clave123', 1),
    (2, 'nazareno_hermano_mayor', '$2y$10$etpyutX1IsROazFohsqsd.8tGQwMTtfLNnGTmYhbcbv/igQlHq57q', 1),
    (3, 'entierro_admin', '$2y$10$58N.Dnefv51zncFRMxRXyeiznPxSMNvpeF9fsIgRYfvfzv3i.LCfW', 2),
    (4, 'entierro_hermano_mayor', '$2y$10$liPgZ2ZN421mBkQeXQCEG.CEJpLggF./VqQB1Vr3W37OfEUPnF8sW', 2),
    (5, 'borriquita_user', '$2y$10$KzgJs41LmtXa7gprVDecX.act7wTb6bF6Pmiy877aKs0PXicdlMbS', 3),
    (6, 'borriquita_hermano_mayor', '$2y$10$3e06uAeeMrTFFw4hiw6zXOQSjLJNDeFAioDbvMfefZIeTFd3IGcfG', 3),
    (7, 'rocio_admin', '$2y$10$TVUFCm/DuSk2NLuVdiPMbOQXblH0DE9BB8oXsjTC9cuNnWPAkddoa', 4),
    (8, 'rocio_hermano_mayor', '$2y$10$OAXscTW7YUnCOcGwDEh11OKVrrWJYMM.f0VvanbeqqxoVzQ3w2URi', 4),
    (9, 'dolores_admin', '$2y$10$Nm7otpKWaRRwxKVXmUz6VuKb1EoyltSjh4V74ak39sNWOCSolhOMa', 5),
    (10, 'dolores_hermano_mayor', '$2y$10$5bJ7Lb2sGWkIslM9UYEcjeXU9nhPIAFkQFB8JQGo7Y6WglxcfTXym', 5),
    (11, 'cautivo_admin', '$2y$10$vdHckFD2E7O0sSpMBlpetulvOe9Yy2uAbeOn.dnl5mAVt/bmBPqp6', 6),
    (12, 'cautivo_hermano_mayor', '$2y$10$hSAS173KiuhacHzmiHaaU.qR0sVR.mVdmq2kp0hN0hi8ByBON0sgS', 6),
    (13, 'virgenpaz_admin', '$2y$10$JmHRRadTcLKvnXSBX15MlOQ20zYWb3oXSBc2cpmDyQd7rIRzVIEmC', 7),
    (14, 'virgenpaz_hermano_mayor', '$2y$10$YdMAamqPjOTFGQQW77thdOiP265NCmePfLu59V0MBc2W9Sh5chRjK', 7),
    (15, 'macarena_admin', '$2y$10$Btp0CP7M1US03/RE5Ff71eeXKeVeAERNvj7TV7jp7d2h09MsOSsES', 8),
    (16, 'macarena_hermano_mayor', '$2y$10$lNsNQek/.7uQqYdg8LMLhuy1RrzMNjTG8IOlK.lHlz1Dq8xjIpQR.', 8),
    (17, 'rocioutrera_admin', '$2y$10$onxzV80/.7LfF.FWDRG1HOe9yWwq80WUCJOf9/EFzezmmMNrx8eUm', 9),
    (18, 'rocioutrera_hermano_mayor', '$2y$10$VikoD0lRvTgOiTqE3.hTIeHiDO7aCAgm0WpA.xT8FtQ/pf3tQ3qYS', 9),
    (19, 'remedios_admin', '$2y$10$h6f6X5Nn.5mKNzsVGoEtX.Eb8VHewlTzfYtVAFJq.mnDbebpLPREW', 10),
    (20, 'remedios_hermano_mayor', '$2y$10$6DYAKMtrJJTQc.pWzJ7dO.1BV/fnulzzRGZHWaPtp8YMTmxLnitJy', 10),
    (21, 'nazareno_admin', '$2y$10$8qIV8F5.JHFcyzcYYubVQ.b.qAk3u0z5JS9iUfhs5fPaXGNn0wg7y', 1),
(22, 'admin_admin', '$2y$10$leyf2W.6MchaxliHhbl/ievdZ51mi9Bl/kqBx9vnBO0IEFrs0JmaG', 13),
(23, 'admin_admin_admin', '$2y$10$.GZ7bsGnQf1kGYWUISjGV.AwotZ/7MnKhDvX0hILywPH2GaIPG.wK', 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hermandad`
--
ALTER TABLE `hermandad`
  ADD PRIMARY KEY (`id_hermandad`);

--
-- Indices de la tabla `hermanos`
--
ALTER TABLE `hermanos`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`referencia`),
  ADD KEY `id_hermandad` (`id_hermandad`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_hermandad` (`id_hermandad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hermandad`
--
ALTER TABLE `hermandad`
  MODIFY `id_hermandad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_hermandad`) REFERENCES `hermandad` (`id_hermandad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_hermandad`) REFERENCES `hermandad` (`id_hermandad`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

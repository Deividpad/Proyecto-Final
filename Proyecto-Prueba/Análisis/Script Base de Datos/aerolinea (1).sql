-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2017 a las 19:10:14
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aerolinea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aerolinea`
--

CREATE TABLE `aerolinea` (
  `idAerolinea` int(11) NOT NULL,
  `Razon_Social` varchar(60) NOT NULL,
  `Nit` int(11) NOT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Correo` varchar(60) NOT NULL,
  `Telefono` bigint(20) UNSIGNED NOT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aerolinea`
--

INSERT INTO `aerolinea` (`idAerolinea`, `Razon_Social`, `Nit`, `Direccion`, `Correo`, `Telefono`, `Estado`) VALUES
(1, 'Aviancaa', 123456, 'Bogotá', 'Avianca@gmail.com', 2344556, 'Activa'),
(2, 'Latam', 98765, 'Medellin', 'latam@gamil.com', 23456, 'Activa'),
(3, 'AirLine', 797082, 'Cali', 'arliline@gmail.com', 45995040, 'Activa'),
(4, 'Viva Colombia', 555654, 'Barranquilla', 'vaiva@gmail.com', 55546443, 'Activa'),
(5, 'Peter Vuelos', 7654544, 'Comuna 1', 'perter@gmail.com', 32456, 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientostickete`
--

CREATE TABLE `asientostickete` (
  `Vuelo_idVuelo` int(11) NOT NULL,
  `Tiquete_idTiquete` int(11) NOT NULL,
  `NAsiento` int(11) NOT NULL,
  `Clase` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asientostickete`
--

INSERT INTO `asientostickete` (`Vuelo_idVuelo`, `Tiquete_idTiquete`, `NAsiento`, `Clase`) VALUES
(1, 1, 7, 'Negocios'),
(1, 2, 30, 'Negocios'),
(1, 2, 32, 'Negocios'),
(2, 3, 1, 'Negocios'),
(2, 4, 1, 'Negocios'),
(3, 5, 21, 'Negocios'),
(4, 6, 35, 'Negocios'),
(5, 7, 80, 'Negocios'),
(6, 8, 27, 'Negocios'),
(6, 9, 3, 'Negocios'),
(7, 10, 11, 'Negocios'),
(7, 11, 44, 'Negocios'),
(7, 12, 44, 'Negocios'),
(7, 13, 44, 'Negocios'),
(7, 14, 44, 'Negocios'),
(7, 15, 44, 'Negocios'),
(7, 16, 44, 'Negocios'),
(7, 17, 26, 'Negocios'),
(9, 18, 25, 'Negocios'),
(9, 19, 32, 'Negocios'),
(9, 19, 52, 'Negocios'),
(9, 20, 60, 'Negocios'),
(9, 20, 75, 'Negocios'),
(10, 21, 76, 'Negocios'),
(10, 22, 12, 'Negocios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avion`
--

CREATE TABLE `avion` (
  `idAvion` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Modelo` varchar(60) NOT NULL,
  `Tiempo_Vuelo` int(11) NOT NULL,
  `Capacidad_Silla` int(3) NOT NULL,
  `Asiento_Negocios_Fin` int(11) NOT NULL,
  `Aerolinea_idAerolinea` int(11) NOT NULL,
  `Estado` enum('Activo','Inactivo','Destinado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

--
-- Volcado de datos para la tabla `avion`
--

INSERT INTO `avion` (`idAvion`, `Nombre`, `Modelo`, `Tiempo_Vuelo`, `Capacidad_Silla`, `Asiento_Negocios_Fin`, `Aerolinea_idAerolinea`, `Estado`) VALUES
(1, 'Jet', 'Boing 711', 480, 80, 20, 1, 'Inactivo'),
(2, 'AirBus', 'A330', 480, 80, 20, 2, 'Inactivo'),
(3, 'AirBus', 'A320', 380, 80, 20, 1, 'Inactivo'),
(4, 'Boing 777', 'A319', 240, 80, 20, 1, 'Inactivo'),
(5, 'Boing 1776', 'Carretilla', 480, 80, 20, 5, 'Destinado'),
(6, 'Aires Dam', '2016', 480, 134, 6, 4, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudades` int(11) NOT NULL,
  `Ciudad` varchar(60) NOT NULL,
  `Departamentos_idDepartamentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudades`, `Ciudad`, `Departamentos_idDepartamentos`) VALUES
(1, 'Tunja', 1),
(2, 'Bogotá', 2),
(4, 'Sogamoso', 1),
(5, 'Soacha', 2),
(6, 'Mosquera', 2),
(7, 'Paipa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combo`
--

CREATE TABLE `combo` (
  `idCombo` int(11) NOT NULL,
  `Ninos` int(1) NOT NULL,
  `Adultos` int(1) NOT NULL,
  `Fecha_Ida` datetime NOT NULL,
  `Fecha_Vuelta` datetime NOT NULL,
  `Precio` int(9) NOT NULL,
  `Vuelo_idVuelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamentos` int(11) NOT NULL,
  `Departamentos` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDepartamentos`, `Departamentos`) VALUES
(1, 'Boyacá'),
(2, 'Cundinamarca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero`
--

CREATE TABLE `pasajero` (
  `idPasajero` int(11) NOT NULL,
  `Tipo_Documento` enum('C.C','T.I','C.E','R.C','Otros') NOT NULL,
  `Documento` bigint(20) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellido` varchar(60) NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  `Direccion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasajero`
--

INSERT INTO `pasajero` (`idPasajero`, `Tipo_Documento`, `Documento`, `Nombre`, `Apellido`, `Telefono`, `Direccion`) VALUES
(1, 'C.C', 1020833844, 'Maria', 'Lozano', 234567, 'Sogamoso'),
(2, 'C.C', 1057604685, 'Cristian', 'Ramirez', 34567, 'Sogamoso'),
(3, 'C.C', 1007445221, 'Junior', 'Bonilla', 34567, 'Calle 13'),
(4, 'C.C', 1002691188, 'Marcela', 'Mateus', 345678, 'Sogamoso'),
(5, 'C.C', 6777878, 'Yeimy', 'Duerte', 45678, 'Calle 16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idPersonal` int(11) NOT NULL,
  `Tipo_Documento` enum('C.C','T.I','C.E','R.C','Otros') NOT NULL,
  `Documento` bigint(20) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellido` varchar(60) NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Correo` varchar(60) NOT NULL,
  `Cargo` enum('Piloto','Copiloto','Auxiliar','Ingeniero_Vuelo','Azafata') NOT NULL,
  `Rh` varchar(45) NOT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idPersonal`, `Tipo_Documento`, `Documento`, `Nombre`, `Apellido`, `Telefono`, `Direccion`, `Correo`, `Cargo`, `Rh`, `Estado`) VALUES
(1, 'C.C', 90766655, 'Erika', 'Numpaque', 2343, 'Sogamoso', 'erika@gmail.com', 'Piloto', 'A+', 'Activo'),
(2, 'C.C', 1050200869, 'Marcela', 'Troncozo', 23456, 'Sogamoso', 'marce@gmail.com', 'Azafata', 'A+', 'Activo'),
(3, 'C.C', 9905090156, 'Jhon', 'Bautista', 23456, 'Calle 13', 'jhon@gmail.com', '', 'A+', 'Activo'),
(4, 'C.C', 1057602501, 'Jose', 'Cardenas', 312456, 'Calle 16', 'jose@gmail.com', 'Copiloto', 'AB+', 'Activo'),
(5, 'C.C', 1057592202, 'Nestor', 'Riaño', 34567, 'Avenido 1', 'nestor@gmail.com', 'Piloto', 'B-', 'Activo'),
(6, 'C.C', 1052386154, 'Luis', 'Cardneas', 345678, 'Calle 13', 'luis@gmail.com', 'Azafata', 'A+', 'Activo'),
(7, 'C.C', 9888590, 'Alex', 'Brenal', 55660533, 'Sogamoso', 'alex@gmail.com', 'Auxiliar', 'A+', 'Activo'),
(8, 'C.C', 1002406507, 'Damaris', 'Ruiz', 324567, 'Belen', 'damaris@gmail.com', 'Azafata', 'O+', 'Activo'),
(9, 'C.C', 23574437, 'Olga', 'Padilla', 4356, 'Belen', 'olga@gmail.com', 'Piloto', 'O+', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_has_vuelo`
--

CREATE TABLE `personal_has_vuelo` (
  `Personal_idPersonal` int(11) NOT NULL,
  `Vuelo_idVuelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal_has_vuelo`
--

INSERT INTO `personal_has_vuelo` (`Personal_idPersonal`, `Vuelo_idVuelo`) VALUES
(1, 1),
(1, 7),
(1, 8),
(1, 9),
(2, 7),
(2, 8),
(2, 9),
(3, 2),
(3, 3),
(3, 7),
(4, 3),
(4, 7),
(4, 8),
(4, 9),
(5, 4),
(5, 7),
(5, 8),
(5, 9),
(6, 5),
(6, 8),
(6, 9),
(7, 6),
(8, 10),
(9, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `idRutas` int(11) NOT NULL,
  `Origen` int(11) NOT NULL,
  `Destino` int(11) NOT NULL,
  `Duracion` int(11) NOT NULL,
  `Precio_Negocios` int(11) NOT NULL,
  `Precio_Economico` int(11) NOT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idRutas`, `Origen`, `Destino`, `Duracion`, `Precio_Negocios`, `Precio_Economico`, `Estado`) VALUES
(1, 1, 2, 40, 80000, 450000, 'Inactiva'),
(2, 4, 5, 40, 70000, 50000, 'Inactiva'),
(3, 5, 4, 45, 1000000, 70000, 'Inactiva'),
(4, 6, 7, 30, 95000, 67000, 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiquete`
--

CREATE TABLE `tiquete` (
  `idTiquete` int(11) NOT NULL,
  `Clase` enum('Empresarial','Economica') NOT NULL,
  `Numero_Asiento` int(3) NOT NULL,
  `Valor` int(9) NOT NULL,
  `Estado` enum('Activo','inactivo') NOT NULL,
  `Pasajero_idPasajero` int(11) NOT NULL,
  `Vuelo_idVuelo` int(11) DEFAULT NULL,
  `Combo_idCombo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiquete`
--

INSERT INTO `tiquete` (`idTiquete`, `Clase`, `Numero_Asiento`, `Valor`, `Estado`, `Pasajero_idPasajero`, `Vuelo_idVuelo`, `Combo_idCombo`) VALUES
(1, 'Empresarial', 0, 80000, 'Activo', 1, 1, 1),
(2, 'Empresarial', 0, 900000, 'Activo', 2, 1, 1),
(3, 'Empresarial', 0, 80000, 'Activo', 3, 2, 1),
(4, 'Empresarial', 0, 80000, 'Activo', 3, 2, 1),
(5, 'Empresarial', 0, 50000, 'Activo', 4, 3, 1),
(6, 'Empresarial', 0, 50000, 'Activo', 3, 4, 1),
(7, 'Empresarial', 0, 450000, 'Activo', 5, 5, 1),
(8, 'Empresarial', 0, 450000, 'Activo', 1, 6, 1),
(9, 'Empresarial', 0, 80000, 'Activo', 2, 6, 1),
(10, 'Empresarial', 0, 80000, 'Activo', 4, 7, 1),
(11, 'Empresarial', 0, 450000, 'Activo', 4, 7, 1),
(12, 'Empresarial', 0, 450000, 'Activo', 4, 7, 1),
(13, 'Empresarial', 0, 450000, 'Activo', 4, 7, 1),
(14, 'Empresarial', 0, 450000, 'Activo', 1, 7, 1),
(15, 'Empresarial', 0, 450000, 'Activo', 1, 7, 1),
(16, 'Empresarial', 0, 450000, 'Activo', 1, 7, 1),
(17, 'Empresarial', 0, 450000, 'Activo', 1, 7, 1),
(18, 'Empresarial', 0, 70000, 'Activo', 3, 9, 1),
(19, 'Empresarial', 0, 140000, 'Activo', 3, 9, 1),
(20, 'Empresarial', 0, 140000, 'Activo', 3, 9, 1),
(21, 'Empresarial', 0, 67000, 'Activo', 5, 10, 1),
(22, 'Empresarial', 0, 67000, 'Activo', 5, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Documento` varchar(45) NOT NULL,
  `Contrasena` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Documento`, `Contrasena`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
  `idVuelo` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Tipo` enum('Ida','Ida-Vuelta') NOT NULL,
  `Avion_idAvion` int(11) NOT NULL,
  `Rutas_idRutas` int(11) NOT NULL,
  `Estado` enum('Activo','Inactivo','Realizado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`idVuelo`, `Fecha`, `Hora`, `Tipo`, `Avion_idAvion`, `Rutas_idRutas`, `Estado`) VALUES
(1, '2017-08-11', '01:01:00', 'Ida', 1, 1, 'Realizado'),
(2, '2017-08-16', '01:01:00', 'Ida', 2, 1, 'Realizado'),
(3, '2017-08-16', '15:30:00', 'Ida', 2, 2, 'Realizado'),
(4, '2017-08-17', '09:30:00', 'Ida', 2, 2, 'Realizado'),
(5, '2017-08-22', '16:30:00', 'Ida', 3, 1, 'Realizado'),
(6, '2017-08-13', '05:30:00', 'Ida', 4, 1, 'Realizado'),
(7, '2017-08-19', '01:30:00', 'Ida', 1, 1, 'Realizado'),
(8, '2017-08-24', '15:30:00', 'Ida', 5, 1, 'Inactivo'),
(9, '2017-08-24', '01:30:00', 'Ida', 1, 3, 'Realizado'),
(10, '2017-08-14', '14:00:00', 'Ida', 6, 4, 'Realizado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aerolinea`
--
ALTER TABLE `aerolinea`
  ADD PRIMARY KEY (`idAerolinea`),
  ADD UNIQUE KEY `Nit` (`Nit`);

--
-- Indices de la tabla `asientostickete`
--
ALTER TABLE `asientostickete`
  ADD KEY `Vuelo_idVuelo` (`Vuelo_idVuelo`),
  ADD KEY `Tiquete_idTiquete` (`Tiquete_idTiquete`);

--
-- Indices de la tabla `avion`
--
ALTER TABLE `avion`
  ADD PRIMARY KEY (`idAvion`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudades`),
  ADD UNIQUE KEY `Ciudad` (`Ciudad`);

--
-- Indices de la tabla `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`idCombo`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDepartamentos`);

--
-- Indices de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD PRIMARY KEY (`idPasajero`),
  ADD UNIQUE KEY `Documento` (`Documento`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`idPersonal`),
  ADD UNIQUE KEY `Documento_UNIQUE` (`Documento`);

--
-- Indices de la tabla `personal_has_vuelo`
--
ALTER TABLE `personal_has_vuelo`
  ADD PRIMARY KEY (`Personal_idPersonal`,`Vuelo_idVuelo`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`idRutas`);

--
-- Indices de la tabla `tiquete`
--
ALTER TABLE `tiquete`
  ADD PRIMARY KEY (`idTiquete`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`idVuelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aerolinea`
--
ALTER TABLE `aerolinea`
  MODIFY `idAerolinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `avion`
--
ALTER TABLE `avion`
  MODIFY `idAvion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `combo`
--
ALTER TABLE `combo`
  MODIFY `idCombo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  MODIFY `idPasajero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `idPersonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idRutas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tiquete`
--
ALTER TABLE `tiquete`
  MODIFY `idTiquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  MODIFY `idVuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientostickete`
--
ALTER TABLE `asientostickete`
  ADD CONSTRAINT `asientostickete_ibfk_1` FOREIGN KEY (`Vuelo_idVuelo`) REFERENCES `vuelo` (`idVuelo`),
  ADD CONSTRAINT `asientostickete_ibfk_2` FOREIGN KEY (`Tiquete_idTiquete`) REFERENCES `tiquete` (`idTiquete`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2020 a las 11:04:34
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `comprasweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `NUM_ALMACEN` int(11) NOT NULL DEFAULT '0',
  `LOCALIDAD` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`NUM_ALMACEN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`NUM_ALMACEN`, `LOCALIDAD`) VALUES
(10, 'BILBAO'),
(20, 'Madrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacena`
--

CREATE TABLE IF NOT EXISTS `almacena` (
  `NUM_ALMACEN` int(11) NOT NULL DEFAULT '0',
  `ID_PRODUCTO` varchar(5) NOT NULL DEFAULT '',
  `CANTIDAD` int(11) DEFAULT NULL,
  PRIMARY KEY (`NUM_ALMACEN`,`ID_PRODUCTO`),
  KEY `FK_ALM_PRO` (`ID_PRODUCTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacena`
--

INSERT INTO `almacena` (`NUM_ALMACEN`, `ID_PRODUCTO`, `CANTIDAD`) VALUES
(10, '1', 0),
(10, '2', 20),
(20, '1', 0),
(20, '2', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `ID_CATEGORIA` varchar(5) NOT NULL DEFAULT '',
  `NOMBRE` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ID_CATEGORIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `NOMBRE`) VALUES
('1', 'pedro'),
('2', 'pe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `NIF` varchar(9) NOT NULL DEFAULT '',
  `NOMBRE` varchar(40) DEFAULT NULL,
  `APELLIDO` varchar(40) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `DIRECCION` varchar(40) DEFAULT NULL,
  `CIUDAD` varchar(40) DEFAULT NULL,
  `passwor` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`NIF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`NIF`, `NOMBRE`, `APELLIDO`, `CP`, `DIRECCION`, `CIUDAD`, `passwor`) VALUES
('01234567H', 'David', 'p', '28044', 'aa', 'a', 'p'),
('10045678R', 'Francisco', 'por', '28044', 'Canarias', 'Tenerife', 'rop'),
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `NIF` varchar(9) NOT NULL DEFAULT '',
  `ID_PRODUCTO` varchar(5) NOT NULL DEFAULT '',
  `FECHA_COMPRA` date NOT NULL DEFAULT '0000-00-00',
  `UNIDADES` int(11) DEFAULT NULL,
  PRIMARY KEY (`NIF`,`ID_PRODUCTO`,`FECHA_COMPRA`),
  KEY `FK_COM_PRO` (`ID_PRODUCTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`NIF`, `ID_PRODUCTO`, `FECHA_COMPRA`, `UNIDADES`) VALUES
('01234567H', '2', '2020-01-31', 1),
('10045678R', '1', '2020-01-31', 5),
('10045678R', '2', '2020-01-30', 5),
('10045678R', '2', '2020-01-31', 5),
('10045678R', '2', '2020-02-03', 1),

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `ID_PRODUCTO` varchar(5) NOT NULL DEFAULT '',
  `NOMBRE` varchar(40) DEFAULT NULL,
  `PRECIO` double DEFAULT NULL,
  `ID_CATEGORIA` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUCTO`),
  KEY `FK_PROD_CAT` (`ID_CATEGORIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `NOMBRE`, `PRECIO`, `ID_CATEGORIA`) VALUES
('1', 'goma', 10, '1'),
('2', 'piedra', 10, '2');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacena`
--
ALTER TABLE `almacena`
  ADD CONSTRAINT `FK_ALM_ALM` FOREIGN KEY (`NUM_ALMACEN`) REFERENCES `almacen` (`NUM_ALMACEN`),
  ADD CONSTRAINT `FK_ALM_PRO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `FK_COM_CLI` FOREIGN KEY (`NIF`) REFERENCES `cliente` (`NIF`),
  ADD CONSTRAINT `FK_COM_PRO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_PROD_CAT` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

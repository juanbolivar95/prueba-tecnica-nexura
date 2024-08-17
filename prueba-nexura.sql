-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba-nexura
CREATE DATABASE IF NOT EXISTS `prueba-nexura` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba-nexura`;

-- Volcando estructura para tabla prueba-nexura.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla prueba-nexura.areas: ~4 rows (aproximadamente)
INSERT INTO `areas` (`id`, `nombre`) VALUES
	(1, 'administrativo'),
	(2, 'recursos humanos'),
	(3, 'gestión de riesgos'),
	(4, 'finanzas');

-- Volcando estructura para tabla prueba-nexura.empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int unsigned NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexo` char(1) NOT NULL,
  `area_id` int NOT NULL,
  `boletin` int NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla prueba-nexura.empleados: ~1 rows (aproximadamente)

-- Volcando estructura para tabla prueba-nexura.empleado_rol
CREATE TABLE IF NOT EXISTS `empleado_rol` (
  `empleado_id` int unsigned NOT NULL,
  `rol_id` int unsigned NOT NULL,
  KEY `FK_empleado_rol_roles` (`rol_id`),
  KEY `FK_empleado_rol_empleados` (`empleado_id`),
  CONSTRAINT `FK_empleado_rol_empleados` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_empleado_rol_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla prueba-nexura.empleado_rol: ~3 rows (aproximadamente)

-- Volcando estructura para tabla prueba-nexura.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int unsigned NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla prueba-nexura.roles: ~3 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`) VALUES
	(1, 'profesional de proyectos - Desarrollador'),
	(2, 'gerente estratégico'),
	(3, 'auxiliar administrativo');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

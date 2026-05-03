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


-- Volcando estructura de base de datos para patients
CREATE DATABASE IF NOT EXISTS `patients` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `patients`;

-- Volcando estructura para tabla patients.analisismercado
CREATE TABLE IF NOT EXISTS `analisismercado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivelDemanda_ana` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fechaAnalisis_ana` date NOT NULL,
  `nivelCompetencia_ana` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tendenciaSalud_ana` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `normativaVigente_ana` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.analisismercado: ~3 rows (aproximadamente)
INSERT INTO `analisismercado` (`id`, `nivelDemanda_ana`, `fechaAnalisis_ana`, `nivelCompetencia_ana`, `tendenciaSalud_ana`, `normativaVigente_ana`) VALUES
	(1, 'Alta', '2026-05-01', 'Media', 'Telemedicina', 'Ley de Salud'),
	(2, 'Media', '2026-04-15', 'Alta', 'Apps médicas', 'Regulación digital'),
	(3, 'Baja', '2026-03-10', 'Baja', 'Atención domiciliaria', 'Normas locales');

-- Volcando estructura para tabla patients.atencion
CREATE TABLE IF NOT EXISTS `atencion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipoPlanAtencion_ate` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `horarioDisponible_ate` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `promocionActiva_ate` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nivelPersonalizacion_ate` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.atencion: ~3 rows (aproximadamente)
INSERT INTO `atencion` (`id`, `tipoPlanAtencion_ate`, `horarioDisponible_ate`, `promocionActiva_ate`, `nivelPersonalizacion_ate`) VALUES
	(1, 'General', '08:00–12:00', 'Descuento 10%', 'Prioridad alta'),
	(2, 'Especializado', '12:00–16:00', 'Consulta gratis inicial', 'Seguimiento continuo'),
	(3, 'Preventivo', '16:00–20:00', 'Paquete familiar', 'Atención personalizada');

-- Volcando estructura para tabla patients.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `idCita_cit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fechaCita_cit` date NOT NULL,
  `estadoCita_cit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tipoRecordatorio_cit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nivelSatisfaccion_cit` decimal(3,1) NOT NULL,
  `idPaciente_cit` int NOT NULL,
  `idServicio_cit` int NOT NULL,
  PRIMARY KEY (`idCita_cit`),
  KEY `fk_cita_paciente` (`idPaciente_cit`),
  KEY `fk_cita_servicio` (`idServicio_cit`),
  CONSTRAINT `fk_cita_paciente` FOREIGN KEY (`idPaciente_cit`) REFERENCES `paciente` (`idPaciente_pac`),
  CONSTRAINT `fk_cita_servicio` FOREIGN KEY (`idServicio_cit`) REFERENCES `serviciosmedicos` (`idServicio_ser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.citas: ~3 rows (aproximadamente)
INSERT INTO `citas` (`idCita_cit`, `fechaCita_cit`, `estadoCita_cit`, `tipoRecordatorio_cit`, `nivelSatisfaccion_cit`, `idPaciente_cit`, `idServicio_cit`) VALUES
	('Cita #001', '2026-05-10', 'Pendiente', 'SMS', 4.5, 1, 101),
	('Cita #002', '2026-05-11', 'Atendida', 'Email', 4.8, 2, 102),
	('Cita #003', '2026-05-12', 'Cancelada', 'Notificación App', 4.2, 3, 103);

-- Volcando estructura para tabla patients.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `idPaciente_pac` int NOT NULL,
  `nombreCompleto_pac` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `historialClinico_pac` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `categoriaPaciente_pac` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `correoElectronico_pac` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono_pac` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion_pac` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idPaciente_pac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.paciente: ~3 rows (aproximadamente)
INSERT INTO `paciente` (`idPaciente_pac`, `nombreCompleto_pac`, `historialClinico_pac`, `categoriaPaciente_pac`, `correoElectronico_pac`, `telefono_pac`, `direccion_pac`) VALUES
	(1, 'Juan Pérez', 'Hipertensión', 'Frecuente', 'juan@email.com', '0991234567', 'Latacunga'),
	(2, 'María López', 'Diabetes', 'Nuevo', 'maria@email.com', '0987654321', 'Quito'),
	(3, 'Carlos Ruiz', 'Paciente sano', 'Ocasional', 'carlos@email.com', '0971122334', 'Ambato');

-- Volcando estructura para tabla patients.personal
CREATE TABLE IF NOT EXISTS `personal` (
  `idMedico_per` int NOT NULL,
  `idPersonal_per` int NOT NULL,
  `especialidadMedica_per` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `horarioLaboral_per` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nivelDesempeno_per` decimal(5,1) NOT NULL,
  `tipoRol_per` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idMedico_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.personal: ~3 rows (aproximadamente)
INSERT INTO `personal` (`idMedico_per`, `idPersonal_per`, `especialidadMedica_per`, `horarioLaboral_per`, `nivelDesempeno_per`, `tipoRol_per`) VALUES
	(10, 20, 'Cardiología', '08:00–16:00', 95.5, 'Médico'),
	(11, 21, 'Pediatría', '09:00–17:00', 90.0, 'Médico'),
	(12, 22, 'Administración', '08:00–14:00', 88.3, 'Administrativo');

-- Volcando estructura para tabla patients.planestrategico
CREATE TABLE IF NOT EXISTS `planestrategico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ObjetivoGeneral_pla` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `misionSistema_pla` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `visionSistema_pla` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `indicadorRendimiento_pla` decimal(5,2) NOT NULL,
  `metaAnual_pla` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.planestrategico: ~3 rows (aproximadamente)
INSERT INTO `planestrategico` (`id`, `ObjetivoGeneral_pla`, `misionSistema_pla`, `visionSistema_pla`, `indicadorRendimiento_pla`, `metaAnual_pla`) VALUES
	(1, 'Reducir tiempo de espera', 'Gestionar citas médicas eficientes', 'Ser líder en salud digital', 92.50, 50),
	(2, 'Mejorar atención al paciente', 'Optimizar recursos médicos', 'Innovar en telemedicina', 88.00, 40),
	(3, 'Digitalizar procesos', 'Automatizar citas', 'Expandir servicios online', 95.20, 60);

-- Volcando estructura para tabla patients.serviciosmedicos
CREATE TABLE IF NOT EXISTS `serviciosmedicos` (
  `nombreServicio_ser` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `idServicio_ser` int NOT NULL,
  `estadoServicio_ser` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `precioConsulta_ser` decimal(10,2) NOT NULL,
  `porcentajeRentabilidad_ser` decimal(5,2) NOT NULL,
  `tipoPaquete_ser` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `duracionServicio_ser` int NOT NULL,
  PRIMARY KEY (`idServicio_ser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.serviciosmedicos: ~3 rows (aproximadamente)
INSERT INTO `serviciosmedicos` (`nombreServicio_ser`, `idServicio_ser`, `estadoServicio_ser`, `precioConsulta_ser`, `porcentajeRentabilidad_ser`, `tipoPaquete_ser`, `duracionServicio_ser`) VALUES
	('Consulta general', 101, 'Disponible', 25.50, 15.20, 'Básico', 30),
	('Especialidad cardiología', 102, 'Disponible', 40.00, 20.50, 'Premium', 60),
	('Teleconsulta', 103, 'NoDisponible', 20.00, 10.00, 'Virtual', 20);

-- Volcando estructura para tabla patients.sistema
CREATE TABLE IF NOT EXISTS `sistema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombreUsuario_sis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `rolUsuario_sis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `motorBaseDatos_sis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nivelSeguridad_sis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tipoIntegracion_sis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estadoUsuario_sis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla patients.sistema: ~3 rows (aproximadamente)
INSERT INTO `sistema` (`id`, `nombreUsuario_sis`, `rolUsuario_sis`, `motorBaseDatos_sis`, `nivelSeguridad_sis`, `tipoIntegracion_sis`, `estadoUsuario_sis`) VALUES
	(1, 'admin', 'administrador', 'MySQL', 'Alta', 'API externa', 'Activo'),
	(2, 'user1', 'recepcionista', 'PostgreSQL', 'Media', 'Sistema interno', 'Activo'),
	(3, 'medico1', 'médico', 'SQL Server', 'Alta', 'Plataforma salud', 'Inactivo');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

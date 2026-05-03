-- ============================================================
-- BASE DE DATOS: patients
-- SISTEMA DIGITAL DE GESTIÓN DE CITAS MÉDICAS
-- ============================================================

CREATE DATABASE IF NOT EXISTS `patients` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `patients`;

-- Desactivar llaves foráneas temporalmente para reconstruir
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `Citas`;
DROP TABLE IF EXISTS `Personal`;
DROP TABLE IF EXISTS `Sistema`;
DROP TABLE IF EXISTS `Atencion`;
DROP TABLE IF EXISTS `Paciente`;
DROP TABLE IF EXISTS `AnalisisMercado`;
DROP TABLE IF EXISTS `ServiciosMedicos`;
DROP TABLE IF EXISTS `planEstrategico`;

-- ============================================================
-- 1. planEstrategico
-- ============================================================
CREATE TABLE `planEstrategico` (
  `ObjetivoGeneral_pla` VARCHAR(255) NOT NULL,
  `misionSistema_pla` VARCHAR(255) NOT NULL,
  `visionSistema_pla` VARCHAR(255) NOT NULL,
  `indicadorRendimiento_pla` DECIMAL(5,2) NOT NULL,
  `metaAnual_pla` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `planEstrategico` (`ObjetivoGeneral_pla`, `misionSistema_pla`, `visionSistema_pla`, `indicadorRendimiento_pla`, `metaAnual_pla`) VALUES
('Reducir tiempo de espera', 'Gestionar citas médicas eficientes', 'Ser líder en salud digital', 92.5, 50),
('Mejorar atención al paciente', 'Optimizar recursos médicos', 'Innovar en telemedicina', 88.0, 40),
('Digitalizar procesos', 'Automatizar citas', 'Expandir servicios online', 95.2, 60);

-- ============================================================
-- 2. ServiciosMedicos
-- ============================================================
CREATE TABLE `ServiciosMedicos` (
  `nombreServicio_ser` VARCHAR(100) NOT NULL,
  `idServicio_ser` INT NOT NULL,
  `estadoServicio_ser` VARCHAR(50) NOT NULL,
  `precioConsulta_ser` DECIMAL(10,2) NOT NULL,
  `porcentajeRentabilidad_ser` DECIMAL(5,2) NOT NULL,
  `tipoPaquete_ser` VARCHAR(50) NOT NULL,
  `duracionServicio_ser` INT NOT NULL,
  PRIMARY KEY (`idServicio_ser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ServiciosMedicos` (`nombreServicio_ser`, `idServicio_ser`, `estadoServicio_ser`, `precioConsulta_ser`, `porcentajeRentabilidad_ser`, `tipoPaquete_ser`, `duracionServicio_ser`) VALUES
('Consulta general', 101, 'Disponible', 25.50, 15.2, 'Básico', 30),
('Especialidad cardiología', 102, 'Disponible', 40.00, 20.5, 'Premium', 60),
('Teleconsulta', 103, 'NoDisponible', 20.00, 10.0, 'Virtual', 20);

-- ============================================================
-- 3. AnalisisMercado
-- ============================================================
CREATE TABLE `AnalisisMercado` (
  `nivelDemanda_ana` VARCHAR(50) NOT NULL,
  `fechaAnalisis_ana` DATE NOT NULL,
  `nivelCompetencia_ana` VARCHAR(50) NOT NULL,
  `tendenciaSalud_ana` VARCHAR(100) NOT NULL,
  `normativaVigente_ana` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `AnalisisMercado` (`nivelDemanda_ana`, `fechaAnalisis_ana`, `nivelCompetencia_ana`, `tendenciaSalud_ana`, `normativaVigente_ana`) VALUES
('Alta', '2026-05-01', 'Media', 'Telemedicina', 'Ley de Salud'),
('Media', '2026-04-15', 'Alta', 'Apps médicas', 'Regulación digital'),
('Baja', '2026-03-10', 'Baja', 'Atención domiciliaria', 'Normas locales');

-- ============================================================
-- 4. Paciente
-- ============================================================
CREATE TABLE `Paciente` (
  `idPaciente_pac` INT NOT NULL,
  `nombreCompleto_pac` VARCHAR(150) NOT NULL,
  `historialClinico_pac` VARCHAR(255) NOT NULL,
  `categoriaPaciente_pac` VARCHAR(50) NOT NULL,
  `correoElectronico_pac` VARCHAR(150) NOT NULL,
  `telefono_pac` VARCHAR(20) NOT NULL,
  `direccion_pac` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idPaciente_pac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Paciente` (`idPaciente_pac`, `nombreCompleto_pac`, `historialClinico_pac`, `categoriaPaciente_pac`, `correoElectronico_pac`, `telefono_pac`, `direccion_pac`) VALUES
(1, 'Juan Pérez', 'Hipertensión', 'Frecuente', 'juan@email.com', '0991234567', 'Latacunga'),
(2, 'María López', 'Diabetes', 'Nuevo', 'maria@email.com', '0987654321', 'Quito'),
(3, 'Carlos Ruiz', 'Paciente sano', 'Ocasional', 'carlos@email.com', '0971122334', 'Ambato');

-- ============================================================
-- 5. Atencion
-- ============================================================
CREATE TABLE `Atencion` (
  `tipoPlanAtencion_ate` VARCHAR(100) NOT NULL,
  `horarioDisponible_ate` VARCHAR(50) NOT NULL,
  `promocionActiva_ate` VARCHAR(100) NOT NULL,
  `nivelPersonalizacion_ate` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Atencion` (`tipoPlanAtencion_ate`, `horarioDisponible_ate`, `promocionActiva_ate`, `nivelPersonalizacion_ate`) VALUES
('General', '08:00–12:00', 'Descuento 10%', 'Prioridad alta'),
('Especializado', '12:00–16:00', 'Consulta gratis inicial', 'Seguimiento continuo'),
('Preventivo', '16:00–20:00', 'Paquete familiar', 'Atención personalizada');

-- ============================================================
-- 6. Citas
-- ============================================================
CREATE TABLE `Citas` (
  `idCita_cit` VARCHAR(50) NOT NULL,
  `fechaCita_cit` DATE NOT NULL,
  `estadoCita_cit` VARCHAR(50) NOT NULL,
  `tipoRecordatorio_cit` VARCHAR(50) NOT NULL,
  `nivelSatisfaccion_cit` DECIMAL(3,1) NOT NULL,
  `idPaciente_cit` INT NOT NULL,
  `idServicio_cit` INT NOT NULL,
  PRIMARY KEY (`idCita_cit`),
  CONSTRAINT `fk_cita_paciente` FOREIGN KEY (`idPaciente_cit`) REFERENCES `Paciente` (`idPaciente_pac`),
  CONSTRAINT `fk_cita_servicio` FOREIGN KEY (`idServicio_cit`) REFERENCES `ServiciosMedicos` (`idServicio_ser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Citas` (`idCita_cit`, `fechaCita_cit`, `estadoCita_cit`, `tipoRecordatorio_cit`, `nivelSatisfaccion_cit`, `idPaciente_cit`, `idServicio_cit`) VALUES
('Cita #001', '2026-05-10', 'Pendiente', 'SMS', 4.5, 1, 101),
('Cita #002', '2026-05-11', 'Atendida', 'Email', 4.8, 2, 102),
('Cita #003', '2026-05-12', 'Cancelada', 'Notificación App', 4.2, 3, 103);

-- ============================================================
-- 7. Sistema
-- ============================================================
CREATE TABLE `Sistema` (
  `nombreUsuario_sis` VARCHAR(50) NOT NULL,
  `rolUsuario_sis` VARCHAR(50) NOT NULL,
  `motorBaseDatos_sis` VARCHAR(50) NOT NULL,
  `nivelSeguridad_sis` VARCHAR(50) NOT NULL,
  `tipoIntegracion_sis` VARCHAR(50) NOT NULL,
  `estadoUsuario_sis` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Sistema` (`nombreUsuario_sis`, `rolUsuario_sis`, `motorBaseDatos_sis`, `nivelSeguridad_sis`, `tipoIntegracion_sis`, `estadoUsuario_sis`) VALUES
('admin', 'administrador', 'MySQL', 'Alta', 'API externa', 'Activo'),
('user1', 'recepcionista', 'PostgreSQL', 'Media', 'Sistema interno', 'Activo'),
('medico1', 'médico', 'SQL Server', 'Alta', 'Plataforma salud', 'Inactivo');

-- ============================================================
-- 8. Personal
-- ============================================================
CREATE TABLE `Personal` (
  `idMedico_per` INT NOT NULL,
  `idPersonal_per` INT NOT NULL,
  `especialidadMedica_per` VARCHAR(100) NOT NULL,
  `horarioLaboral_per` VARCHAR(50) NOT NULL,
  `nivelDesempeno_per` DECIMAL(5,1) NOT NULL,
  `tipoRol_per` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idMedico_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Personal` (`idMedico_per`, `idPersonal_per`, `especialidadMedica_per`, `horarioLaboral_per`, `nivelDesempeno_per`, `tipoRol_per`) VALUES
(10, 20, 'Cardiología', '08:00–16:00', 95.5, 'Médico'),
(11, 21, 'Pediatría', '09:00–17:00', 90.0, 'Médico'),
(12, 22, 'Administración', '08:00–14:00', 88.3, 'Administrativo');

SET FOREIGN_KEY_CHECKS = 1;
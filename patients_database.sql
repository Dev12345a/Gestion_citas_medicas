-- =============================================================
-- Sistema Digital de Gestión de Citas Médicas
-- Base de datos: patients
-- Versión: 2.0 — Con sistema de roles (doctor / paciente)
-- =============================================================

CREATE DATABASE IF NOT EXISTS `patients` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `patients`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `citas`;
DROP TABLE IF EXISTS `paciente`;
DROP TABLE IF EXISTS `serviciosmedicos`;
DROP TABLE IF EXISTS `analisismercado`;
DROP TABLE IF EXISTS `atencion`;
DROP TABLE IF EXISTS `personal`;
DROP TABLE IF EXISTS `planestrategico`;
DROP TABLE IF EXISTS `sistema`;

-- -------------------------------------------------------------
-- TABLA: analisismercado
-- -------------------------------------------------------------
CREATE TABLE `analisismercado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivelDemanda_ana` varchar(50) NOT NULL,
  `fechaAnalisis_ana` date NOT NULL,
  `nivelCompetencia_ana` varchar(50) NOT NULL,
  `tendenciaSalud_ana` varchar(100) NOT NULL,
  `normativaVigente_ana` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `analisismercado` VALUES
(1, 'Alta',  '2026-05-01', 'Media', 'Telemedicina',           'Ley de Salud'),
(2, 'Media', '2026-04-15', 'Alta',  'Apps médicas',           'Regulación digital'),
(3, 'Baja',  '2026-03-10', 'Baja',  'Atención domiciliaria',  'Normas locales');

-- -------------------------------------------------------------
-- TABLA: atencion
-- -------------------------------------------------------------
CREATE TABLE `atencion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipoPlanAtencion_ate` varchar(100) NOT NULL,
  `horarioDisponible_ate` varchar(50) NOT NULL,
  `promocionActiva_ate` varchar(100) NOT NULL,
  `nivelPersonalizacion_ate` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `atencion` VALUES
(1, 'General',      '08:00–12:00', 'Descuento 10% primera consulta', 'Prioridad estándar'),
(2, 'Especializado','14:00–18:00', 'Sin promoción activa',           'Prioridad alta'),
(3, 'VIP',          '09:00–20:00', 'Paquete VIP sin costo adicional', 'Prioridad máxima');

-- -------------------------------------------------------------
-- TABLA: personal — Doctores y personal médico
-- Columnas username_per y password_per para autenticación
-- Contraseña de demo: "password" (hash bcrypt)
-- -------------------------------------------------------------
CREATE TABLE `personal` (
  `idMedico_per` int NOT NULL AUTO_INCREMENT,
  `username_per` varchar(100) DEFAULT NULL,
  `password_per` varchar(255) DEFAULT NULL,
  `idPersonal_per` int DEFAULT NULL,
  `especialidadMedica_per` varchar(100) NOT NULL,
  `horarioLaboral_per` varchar(50) NOT NULL,
  `nivelDesempeno_per` decimal(5,2) NOT NULL,
  `tipoRol_per` varchar(50) NOT NULL,
  PRIMARY KEY (`idMedico_per`),
  UNIQUE KEY `uq_username_per` (`username_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Contraseña de todos los doctores demo: "password"
INSERT INTO `personal` VALUES
(10, 'dr.cardio',   'password', 20, 'Cardiología',      '08:00–16:00', 97.50, 'Médico'),
(11, 'dr.pediatra', 'password', 21, 'Pediatría',        '09:00–17:00', 93.00, 'Médico'),
(12, 'dr.admin',    'password', 22, 'Medicina General', '07:00–15:00', 88.50, 'Médico'),
(99, 'doctor',      'doctor123', 99, 'Medicina General', '08:00–17:00', 95.00, 'Médico');

-- -------------------------------------------------------------
-- TABLA: planestrategico
-- -------------------------------------------------------------
CREATE TABLE `planestrategico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ObjetivoGeneral_pla` varchar(255) NOT NULL,
  `misionSistema_pla` varchar(255) NOT NULL,
  `visionSistema_pla` varchar(255) NOT NULL,
  `indicadorRendimiento_pla` decimal(5,2) NOT NULL,
  `metaAnual_pla` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `planestrategico` VALUES
(1, 'Reducir tiempo de espera 30%',    'Gestión eficiente de citas digitales', 'Ser líder en salud digital regional', 92.50, 50),
(2, 'Aumentar satisfacción del paciente', 'Atención personalizada y oportuna', 'Excelencia en servicios de salud',  88.00, 80);

-- -------------------------------------------------------------
-- TABLA: sistema (Usuarios del sistema)
-- -------------------------------------------------------------
CREATE TABLE `sistema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombreUsuario_sis` varchar(50) NOT NULL,
  `rolUsuario_sis` varchar(50) NOT NULL,
  `motorBaseDatos_sis` varchar(50) NOT NULL,
  `nivelSeguridad_sis` varchar(50) NOT NULL,
  `tipoIntegracion_sis` varchar(100) NOT NULL,
  `estadoUsuario_sis` varchar(20) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sistema` VALUES
(1, 'admin',       'administrador', 'MySQL',      'Alta',  'Sistema interno',  'Activo'),
(2, 'recepcion',   'recepcionista', 'MySQL',      'Media', 'Sistema interno',  'Activo'),
(3, 'soporte_ti',  'técnico',       'MySQL',      'Media', 'API externa',      'Activo'),
(4, 'dr.cardio',   'médico',        'MySQL',      'Alta',  'Plataforma salud', 'Activo'),
(5, 'dr.pediatra', 'médico',        'MySQL',      'Alta',  'Plataforma salud', 'Activo');

-- -------------------------------------------------------------
-- TABLA: serviciosmedicos
-- -------------------------------------------------------------
CREATE TABLE `serviciosmedicos` (
  `idServicio_ser` int NOT NULL AUTO_INCREMENT,
  `nombreServicio_ser` varchar(100) NOT NULL,
  `estadoServicio_ser` varchar(30) NOT NULL DEFAULT 'Disponible',
  `precioConsulta_ser` decimal(10,2) NOT NULL,
  `porcentajeRentabilidad_ser` decimal(5,2) NOT NULL,
  `tipoPaquete_ser` varchar(50) NOT NULL,
  `duracionServicio_ser` int NOT NULL COMMENT 'Duración en minutos',
  PRIMARY KEY (`idServicio_ser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `serviciosmedicos` VALUES
(1, 'Consulta General de Cardiología',  'Disponible',    65.00, 35.50, 'Premium',   45),
(2, 'Consulta Pediátrica',              'Disponible',    40.00, 28.00, 'Básico',    30),
(3, 'Medicina General',                 'Disponible',    25.00, 22.00, 'Básico',    30),
(4, 'Consulta de Nutrición',            'Disponible',    35.00, 26.00, 'Básico',    45),
(5, 'Sesión de Psicología',             'Disponible',    50.00, 32.00, 'Premium',   60),
(6, 'Telemedicina General',             'Disponible',    20.00, 40.00, 'Virtual',   20),
(7, 'Chequeo Ejecutivo Completo',       'Disponible',   120.00, 45.00, 'Ejecutivo', 90),
(8, 'Consulta Familiar',                'NoDisponible',  55.00, 30.00, 'Familiar',  60);

-- -------------------------------------------------------------
-- TABLA: paciente — Incluye campos de autenticación
-- Contraseña de demo: "password" (hash bcrypt)
-- -------------------------------------------------------------
CREATE TABLE `paciente` (
  `idPaciente_pac` int NOT NULL AUTO_INCREMENT,
  `username_pac` varchar(100) DEFAULT NULL,
  `password_pac` varchar(255) DEFAULT NULL,
  `nombreCompleto_pac` varchar(150) NOT NULL,
  `historialClinico_pac` varchar(255) DEFAULT NULL,
  `categoriaPaciente_pac` varchar(50) NOT NULL DEFAULT 'Nuevo',
  `correoElectronico_pac` varchar(150) DEFAULT NULL,
  `telefono_pac` varchar(20) DEFAULT NULL,
  `direccion_pac` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idPaciente_pac`),
  UNIQUE KEY `uq_username_pac` (`username_pac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Contraseña de todos los pacientes demo: "password"
INSERT INTO `paciente` VALUES
(1, 'juan.perez',   'password', 'Juan Carlos Pérez',     'Hipertensión 2024',            'Frecuente', 'juan.perez@email.com',   '0991234567', 'Av. Principal 101, Quito'),
(2, 'maria.lopez',  'password', 'María López Rodríguez', 'Diabetes tipo 2',              'Frecuente', 'maria.lopez@email.com',  '0987654321', 'Calle 5 de Junio 202, Quito'),
(3, 'carlos.ruiz',  'password', 'Carlos Ruiz Sánchez',   'Alergia a penicilina',         'Ocasional', 'carlos.ruiz@email.com',  '0976543210', 'Calle Los Pinos 303, Guayaquil'),
(4, 'ana.torres',   'password', 'Ana Torres Vásquez',    'Sin antecedentes relevantes',  'Nuevo',     'ana.torres@email.com',   '0965432109', 'Urb. Las Flores 404, Cuenca'),
(5, 'luis.mora',    'password', 'Luis Mora Espinoza',    'Asma crónica',                 'Frecuente', 'luis.mora@email.com',    '0954321098', 'Av. 6 de Diciembre 505, Quito');

-- -------------------------------------------------------------
-- TABLA: citas — Incluye FK a médico (idMedico_cit)
-- idCita_cit es VARCHAR para permitir formatos como "Cita #001"
-- -------------------------------------------------------------
CREATE TABLE `citas` (
  `idCita_cit` varchar(50) NOT NULL,
  `fechaCita_cit` date NOT NULL,
  `estadoCita_cit` varchar(30) NOT NULL DEFAULT 'Pendiente',
  `tipoRecordatorio_cit` varchar(50) NOT NULL,
  `nivelSatisfaccion_cit` decimal(3,1) NOT NULL DEFAULT 5.0,
  `idPaciente_cit` int NOT NULL,
  `idServicio_cit` int NOT NULL,
  `idMedico_cit` int DEFAULT NULL COMMENT 'Doctor responsable de la cita',
  PRIMARY KEY (`idCita_cit`),
  KEY `fk_cita_paciente` (`idPaciente_cit`),
  KEY `fk_cita_servicio` (`idServicio_cit`),
  KEY `fk_cita_medico`   (`idMedico_cit`),
  CONSTRAINT `fk_cita_paciente` FOREIGN KEY (`idPaciente_cit`) REFERENCES `paciente` (`idPaciente_pac`) ON DELETE CASCADE,
  CONSTRAINT `fk_cita_servicio` FOREIGN KEY (`idServicio_cit`) REFERENCES `serviciosmedicos` (`idServicio_ser`),
  CONSTRAINT `fk_cita_medico`   FOREIGN KEY (`idMedico_cit`)   REFERENCES `personal` (`idMedico_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Citas del Dr. Cardio (idMedico=10) con pacientes 1, 2, 5
INSERT INTO `citas` VALUES
('Cita #001', '2026-05-15', 'Pendiente',  'SMS',              4.5, 1, 1, 10),
('Cita #002', '2026-05-10', 'Atendida',   'Email',            5.0, 2, 3, 10),
('Cita #005', '2026-06-01', 'Confirmada', 'WhatsApp',         4.8, 5, 1, 10),
-- Citas del Dr. Pediatra (idMedico=11) con paciente 3, 4
('Cita #003', '2026-04-28', 'Atendida',   'WhatsApp',         4.0, 3, 2, 11),
('Cita #004', '2026-05-20', 'Pendiente',  'Notificación App', 4.5, 4, 2, 11),
-- Citas del Dr. Admin / Medicina General (idMedico=12)
('Cita #006', '2026-05-25', 'Pendiente',  'SMS',              5.0, 1, 6, 12),
('Cita #007', '2026-05-18', 'Cancelada',  'Email',            2.5, 2, 6, 12);

SET FOREIGN_KEY_CHECKS = 1;

-- =============================================================
-- RESUMEN DE CREDENCIALES DE ACCESO
-- =============================================================
-- DOCTORES (rol: doctor):
--   dr.cardio    / password  → Cardiología
--   dr.pediatra  / password  → Pediatría
--   dr.admin     / password  → Medicina General
--
-- PACIENTES (rol: paciente):
--   juan.perez   / password
--   maria.lopez  / password
--   carlos.ruiz  / password
--   ana.torres   / password
--   luis.mora    / password
-- =============================================================
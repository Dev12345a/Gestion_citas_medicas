-- ============================================================
-- BASE DE DATOS: patients
-- SISTEMA DIGITAL DE GESTIÓN DE CITAS MÉDICAS Y SEGUIMIENTO DE PACIENTES
-- ============================================================

CREATE DATABASE IF NOT EXISTS `patients`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `patients`;

-- ============================================================
-- 1. ESPECIALIDADES MÉDICAS (catálogo)
-- ============================================================
DROP TABLE IF EXISTS `follow_ups`;
DROP TABLE IF EXISTS `appointments`;
DROP TABLE IF EXISTS `patients`;
DROP TABLE IF EXISTS `doctors`;
DROP TABLE IF EXISTS `specialties`;

CREATE TABLE `specialties` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(100) NOT NULL,
  `description` TEXT         DEFAULT NULL,
  `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 2. DOCTORES
-- ============================================================
CREATE TABLE `doctors` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `specialty_id` INT(11)      NOT NULL,
  `code`         VARCHAR(50)  NOT NULL,
  `first_name`   VARCHAR(100) NOT NULL,
  `last_name`    VARCHAR(100) NOT NULL,
  `email`        VARCHAR(150) DEFAULT NULL,
  `phone`        VARCHAR(20)  DEFAULT NULL,
  `schedule`     TEXT         DEFAULT NULL COMMENT 'Horario de atención en texto libre',
  `is_active`    TINYINT(1)   NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_doctors_code` (`code`),
  KEY `idx_doctors_specialty` (`specialty_id`),
  CONSTRAINT `fk_doctors_specialty` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 3. PACIENTES
-- ============================================================
CREATE TABLE `patients` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `code`          VARCHAR(50)  NOT NULL,
  `first_name`    VARCHAR(100) NOT NULL,
  `last_name`     VARCHAR(100) NOT NULL,
  `date_of_birth` DATE         DEFAULT NULL,
  `gender`        ENUM('M','F','O') NOT NULL DEFAULT 'O',
  `email`         VARCHAR(150) DEFAULT NULL,
  `phone`         VARCHAR(20)  DEFAULT NULL,
  `address`       TEXT         DEFAULT NULL,
  `blood_type`    ENUM('A+','A-','B+','B-','AB+','AB-','O+','O-','Desconocido') DEFAULT 'Desconocido',
  `allergies`     TEXT         DEFAULT NULL,
  `notes`         TEXT         DEFAULT NULL,
  `is_active`     TINYINT(1)   NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_patients_code` (`code`),
  KEY `idx_patients_gender` (`gender`),
  KEY `idx_patients_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 4. CITAS MÉDICAS
-- ============================================================
CREATE TABLE `appointments` (
  `id`               INT(11)   NOT NULL AUTO_INCREMENT,
  `patient_id`       INT(11)   NOT NULL,
  `doctor_id`        INT(11)   NOT NULL,
  `specialty_id`     INT(11)   NOT NULL,
  `appointment_date` DATE      NOT NULL,
  `appointment_time` TIME      NOT NULL,
  `reason`           TEXT      NOT NULL,
  `status`           ENUM('scheduled','confirmed','completed','cancelled','no_show') NOT NULL DEFAULT 'scheduled',
  `notes`            TEXT      DEFAULT NULL,
  `created_at`       DATETIME  DEFAULT CURRENT_TIMESTAMP,
  `updated_at`       DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_app_patient`  (`patient_id`),
  KEY `idx_app_doctor`   (`doctor_id`),
  KEY `idx_app_date`     (`appointment_date`),
  KEY `idx_app_status`   (`status`),
  CONSTRAINT `fk_app_patient`   FOREIGN KEY (`patient_id`)   REFERENCES `patients`   (`id`),
  CONSTRAINT `fk_app_doctor`    FOREIGN KEY (`doctor_id`)    REFERENCES `doctors`    (`id`),
  CONSTRAINT `fk_app_specialty` FOREIGN KEY (`specialty_id`) REFERENCES `specialties`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 5. SEGUIMIENTO / CONSULTAS
-- ============================================================
CREATE TABLE `follow_ups` (
  `id`                    INT(11) NOT NULL AUTO_INCREMENT,
  `appointment_id`        INT(11) NOT NULL,
  `patient_id`            INT(11) NOT NULL,
  `doctor_id`             INT(11) NOT NULL,
  `follow_up_date`        DATE    NOT NULL,
  `diagnosis`             TEXT    NOT NULL,
  `treatment`             TEXT    DEFAULT NULL,
  `prescription`          TEXT    DEFAULT NULL,
  `next_appointment_date` DATE    DEFAULT NULL,
  `notes`                 TEXT    DEFAULT NULL,
  `created_at`            DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_fu_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments`(`id`),
  CONSTRAINT `fk_fu_patient`     FOREIGN KEY (`patient_id`)     REFERENCES `patients`   (`id`),
  CONSTRAINT `fk_fu_doctor`      FOREIGN KEY (`doctor_id`)      REFERENCES `doctors`    (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- TABLA MIGRATIONS (requerida por CodeIgniter 4)
-- ============================================================
CREATE TABLE IF NOT EXISTS `migrations` (
  `id`        BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version`   VARCHAR(255) NOT NULL,
  `class`     TEXT NOT NULL,
  `group`     TEXT NOT NULL,
  `namespace` TEXT NOT NULL,
  `time`      INT(11) NOT NULL,
  `batch`     INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- DATOS DE EJEMPLO
-- ============================================================

INSERT INTO `specialties` (`name`, `description`) VALUES
('Medicina General',  'Atención médica primaria y general'),
('Cardiología',       'Diagnóstico y tratamiento de enfermedades del corazón'),
('Neurología',        'Enfermedades del sistema nervioso central y periférico'),
('Pediatría',         'Atención médica a niños y adolescentes'),
('Ginecología',       'Salud reproductiva femenina'),
('Traumatología',     'Lesiones y enfermedades del sistema musculoesquelético'),
('Dermatología',      'Enfermedades de la piel, cabello y uñas'),
('Oftalmología',      'Salud visual y enfermedades oculares');

INSERT INTO `doctors` (`specialty_id`, `code`, `first_name`, `last_name`, `email`, `phone`, `schedule`) VALUES
(1, 'DOC-001', 'Carlos',   'Ramírez Torres',  'c.ramirez@clinica.com',  '5552001001', 'Lunes a Viernes 08:00–14:00'),
(1, 'DOC-002', 'María',    'González Pérez',  'm.gonzalez@clinica.com', '5552001002', 'Lunes a Viernes 14:00–20:00'),
(2, 'DOC-003', 'Roberto',  'Sánchez Vega',    'r.sanchez@clinica.com',  '5552001003', 'Lunes, Miércoles y Viernes 09:00–17:00'),
(3, 'DOC-004', 'Ana',      'López Mendoza',   'a.lopez@clinica.com',    '5552001004', 'Martes y Jueves 08:00–16:00'),
(4, 'DOC-005', 'Jorge',    'Martínez Cruz',   'j.martinez@clinica.com', '5552001005', 'Lunes a Viernes 09:00–15:00'),
(5, 'DOC-006', 'Sofía',    'Herrera Núñez',   's.herrera@clinica.com',  '5552001006', 'Lunes a Viernes 10:00–18:00'),
(6, 'DOC-007', 'Luis',     'Flores Castillo', 'l.flores@clinica.com',   '5552001007', 'Martes, Miércoles y Viernes 08:00–14:00'),
(7, 'DOC-008', 'Patricia', 'Moreno Díaz',     'p.moreno@clinica.com',   '5552001008', 'Lunes a Viernes 09:00–17:00');

INSERT INTO `patients` (`code`, `first_name`, `last_name`, `date_of_birth`, `gender`, `email`, `phone`, `address`, `blood_type`, `allergies`, `notes`, `is_active`) VALUES
('PAC-001', 'Ana',     'García López',     '1990-03-15', 'F', 'ana.garcia@email.com',   '5551001001', 'Calle Principal 10',  'O+',          'Penicilina',   'Historial de cefalea crónica', 1),
('PAC-002', 'Carlos',  'Martínez Ruiz',    '1985-07-22', 'M', 'carlos.m@email.com',     '5551001002', 'Av. Central 45',      'A+',          'Ninguna',      NULL, 1),
('PAC-003', 'Laura',   'Sánchez Mora',     '2000-11-30', 'F', 'laura.s@email.com',      '5551001003', 'Calle Norte 7',       'B+',          'Ibuprofeno',   NULL, 1),
('PAC-004', 'Miguel',  'Torres Vega',      '1978-01-10', 'M', 'miguel.t@email.com',     '5551001004', 'Av. Sur 22',          'AB+',         'Ninguna',      'Diabético tipo 2', 1),
('PAC-005', 'Sofía',   'Ramírez Cruz',     '1995-06-18', 'F', 'sofia.r@email.com',      '5551001005', 'Calle Oriente 3',    'A-',          'Sulfas',       NULL, 1),
('PAC-006', 'Roberto', 'Díaz Fuentes',     '1970-09-05', 'M', 'roberto.d@email.com',    '5551001006', 'Av. Poniente 90',     'O-',          'Ninguna',      'Hipertensión arterial', 0),
('PAC-007', 'Valeria', 'Herrera Núñez',    '2003-04-25', 'F', 'valeria.h@email.com',    '5551001007', 'Calle del Sol 14',   'B-',          'Látex',        NULL, 1),
('PAC-008', 'Andrés',  'Moreno Castillo',  '1988-12-01', 'M', 'andres.mc@email.com',    '5551001008', 'Blvd. Central 55',   'AB-',         'Ninguna',      NULL, 1),
('PAC-009', 'Daniela', 'Flores Gutiérrez', '1992-08-14', 'F', 'daniela.fg@email.com',   '5551001009', 'Calle Luna 8',       'O+',          'Aspirina',     NULL, 1),
('PAC-010', 'Jorge',   'Mendoza Peña',     '1965-02-28', 'M', 'jorge.mp@email.com',     '5551001010', 'Av. Reforma 100',    'A+',          'Ninguna',      'Artritis reumatoide', 1);

INSERT INTO `appointments` (`patient_id`, `doctor_id`, `specialty_id`, `appointment_date`, `appointment_time`, `reason`, `status`) VALUES
(1,  1, 1, '2026-04-20', '09:00:00', 'Consulta general por dolor de cabeza recurrente',  'completed'),
(2,  3, 2, '2026-04-21', '10:30:00', 'Revisión cardiológica de rutina',                  'completed'),
(3,  5, 4, '2026-04-22', '11:00:00', 'Control pediátrico',                               'completed'),
(4,  1, 1, '2026-04-23', '08:30:00', 'Control de diabetes tipo 2',                       'completed'),
(5,  6, 5, '2026-04-24', '14:00:00', 'Consulta ginecológica anual',                      'completed'),
(7,  4, 3, '2026-04-28', '09:00:00', 'Evaluación neurológica',                           'confirmed'),
(8,  7, 6, '2026-04-29', '10:00:00', 'Revisión de lesión deportiva en rodilla',          'scheduled'),
(9,  8, 7, '2026-04-30', '11:00:00', 'Consulta dermatológica por eccema',                'scheduled'),
(10, 3, 2, '2026-05-02', '09:30:00', 'Control de presión arterial',                      'scheduled'),
(1,  4, 3, '2026-05-05', '10:00:00', 'Seguimiento neurológico',                          'scheduled');

INSERT INTO `follow_ups` (`appointment_id`, `patient_id`, `doctor_id`, `follow_up_date`, `diagnosis`, `treatment`, `prescription`, `next_appointment_date`, `notes`) VALUES
(1, 1, 1, '2026-04-20', 'Cefalea tensional crónica',                 'Reposo y manejo del estrés',       'Paracetamol 500mg c/8h × 5 días',   '2026-05-20', 'Llevar diario de episodios'),
(2, 2, 3, '2026-04-21', 'Hipertensión arterial controlada',          'Dieta baja en sodio y ejercicio',  'Losartán 50mg c/24h',               '2026-07-21', 'ECG dentro de parámetros normales'),
(3, 3, 5, '2026-04-22', 'Paciente en buen estado de salud general',  'Alimentación equilibrada',         'Vitaminas prenatales',              '2026-07-22', 'Desarrollo normal'),
(4, 4, 1, '2026-04-23', 'Diabetes tipo 2 con glucosa controlada',    'Dieta + ejercicio 30 min/día',     'Metformina 850mg c/12h',            '2026-05-23', 'HbA1c: 6.8%'),
(5, 5, 6, '2026-04-24', 'Sin hallazgos patológicos',                 'Continuar controles anuales',      'Ácido fólico 400mcg/día',           '2026-10-24', 'Papanicolaou negativo');

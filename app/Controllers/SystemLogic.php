<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SystemLogic extends Controller
{
    // ============================================================
    // 1. Visión 360°: Gestión Integral del Sistema de Salud Digital
    // ============================================================
    public function definir_objetivoGeneral() {
        // Definición del objetivo principal del sistema
        $objetivoGeneral = "Reducir tiempo de espera en un 30% durante el próximo semestre";
        
        // Validar que el objetivo tenga sentido
        if (strlen($objetivoGeneral) < 10) {
            $objetivoGeneral = "Reducir tiempo de espera en consultas médicas";
        }
        
        // Guardar en sesión para seguimiento
        session()->set('objetivo_general', $objetivoGeneral);
        
        return $objetivoGeneral;
    }
    
    public function establecer_misionSistema() {
        // Misión del sistema de gestión de citas
        $misionSistema = "Gestionar citas médicas eficientes, reduciendo tiempos de espera 
                          y mejorando la experiencia del paciente mediante tecnología innovadora";
        
        // Registrar en log
        log_message('info', 'Misión del sistema establecida: ' . substr($misionSistema, 0, 50));
        
        return $misionSistema;
    }
    
    public function determinar_visionSistema() {
        // Visión a futuro del sistema
        $visionSistema = "Ser líder en salud digital en la región, reconocido por nuestra 
                          eficiencia operativa y satisfacción del paciente";
        
        return $visionSistema;
    }
    
    public function medir_indicadorRendimiento() {
        // Indicador KPI de rendimiento (ejemplo: porcentaje de citas cumplidas)
        $porcentajeCumplimiento = 92.5;
        $metaEsperada = 95.0;
        
        // Calcular brecha
        $brecha = $metaEsperada - $porcentajeCumplimiento;
        
        if ($brecha > 0) {
            log_message('warning', "Faltante para meta: {$brecha}%");
        }
        
        return $porcentajeCumplimiento;
    }
    
    public function establecer_metaAnual() {
        // Meta anual en términos de reducción o aumento
        $metaAnual = 50; // 50% de reducción en quejas
        
        // Verificar que la meta sea alcanzable
        if ($metaAnual > 100) {
            $metaAnual = 100;
        }
        
        // Guardar meta
        $this->guardarLog("Meta anual establecida: {$metaAnual}%");
        
        return $metaAnual;
    }

    // ============================================================
    // 2. Productos Rentable: Gestión de Servicios Médicos
    // ============================================================
    public function registrar_servicio() {
        // Registrar un nuevo servicio médico
        $nombreServicio = "Consulta general";
        $idServicio = 101;
        $duracionServicio = 30; // minutos
        
        // Validar que el servicio no exista
        $serviciosExistentes = [100, 102, 103];
        if (in_array($idServicio, $serviciosExistentes)) {
            $idServicio = max($serviciosExistentes) + 1;
        }
        
        // Guardar en array simulado
        $nuevoServicio = [
            'id' => $idServicio,
            'nombre' => $nombreServicio,
            'duracion' => $duracionServicio,
            'estado' => 'activo'
        ];
        
        $this->guardarLog("Servicio registrado: " . json_encode($nuevoServicio));
        
        return true;
    }
    
    public function actualizar_nombreServicio() {
        // Actualizar nombre de un servicio existente
        $nuevoNombre = "Especialidad cardiología avanzada";
        $servicioId = 101;
        
        // Validar longitud del nombre
        if (strlen($nuevoNombre) < 5) {
            return false;
        }
        
        // Simular actualización en BD
        $this->guardarLog("Servicio ID {$servicioId} actualizado a: {$nuevoNombre}");
        
        return $nuevoNombre;
    }
    
    public function verificar_estadoServicio() {
        // Verificar si un servicio está disponible
        $estadoServicio = true; // true = Disponible, false = No disponible
        
        // Simular verificación de horario
        $horaActual = date('H');
        if ($horaActual < 8 || $horaActual > 20) {
            $estadoServicio = false; // Fuera de horario laboral
        }
        
        return $estadoServicio;
    }
    
    public function establecer_precioConsulta() {
        // Establecer precio base más impuestos
        $precioBase = 25.50;
        $impuesto = 0.12; // 12% IVA
        $precioConsulta = $precioBase * (1 + $impuesto);
        
        // Redondear a 2 decimales
        $precioConsulta = round($precioConsulta, 2);
        
        return $precioConsulta;
    }
    
    public function calcular_porcentajeRentabilidad() {
        // Calcular rentabilidad del servicio
        $costoOperativo = 18.50;
        $ingreso = $this->establecer_precioConsulta();
        $ganancia = $ingreso - $costoOperativo;
        $porcentajeRentabilidad = ($ganancia / $ingreso) * 100;
        
        return round($porcentajeRentabilidad, 2);
    }
    
    public function gestionar_tipoPaquete() {
        // Gestionar tipos de paquetes médicos
        $tiposDisponibles = ['Básico', 'Premium', 'Familiar', 'Ejecutivo'];
        $tipoPaquete = "Básico";
        
        // Seleccionar según disponibilidad
        $indice = array_search($tipoPaquete, $tiposDisponibles);
        if ($indice === false) {
            $tipoPaquete = $tiposDisponibles[0];
        }
        
        return $tipoPaquete;
    }

    // ============================================================
    // 3. Radar de Mercado: Análisis del Entorno de Salud
    // ============================================================
    public function registrar_analisisMercado() {
        // Registrar un nuevo análisis de mercado
        $analisis = [
            'fecha' => date('Y-m-d H:i:s'),
            'analista' => 'Sistema Automatizado',
            'alcance' => 'Nacional'
        ];
        
        // Guardar en BD simulada
        $this->guardarLog("Análisis de mercado registrado: " . json_encode($analisis));
        
        return true;
    }
    
    public function analizar_nivelDemanda() {
        // Analizar nivel de demanda de servicios
        $demandaEspecialidades = [
            'Pediatría' => 85,
            'Cardiología' => 70,
            'Medicina General' => 95
        ];
        
        // Determinar nivel de demanda según promedio
        $promedioDemanda = array_sum($demandaEspecialidades) / count($demandaEspecialidades);
        
        if ($promedioDemanda >= 80) {
            $nivelDemanda = "Alta";
        } elseif ($promedioDemanda >= 50) {
            $nivelDemanda = "Media";
        } else {
            $nivelDemanda = "Baja";
        }
        
        return $nivelDemanda;
    }
    
    public function evaluar_nivelCompetencia() {
        // Evaluar nivel de competencia en el mercado
        $numeroCompetidores = 5;
        $cuotaMercadoPropia = 25; // porcentaje
        
        if ($numeroCompetidores > 10 || $cuotaMercadoPropia < 15) {
            $nivelCompetencia = "Alta";
        } elseif ($numeroCompetidores > 5 || $cuotaMercadoPropia < 30) {
            $nivelCompetencia = "Media";
        } else {
            $nivelCompetencia = "Baja";
        }
        
        return $nivelCompetencia;
    }
    
    public function validar_fechaAnalisis() {
        // Validar formato de fecha
        $fechaAnalisis = "2026-05-01";
        $formatoValido = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaAnalisis);
        
        if (!$formatoValido) {
            $fechaAnalisis = date('Y-m-d');
            log_message('error', 'Fecha inválida, usando fecha actual');
        }
        
        return $fechaAnalisis;
    }
    
    public function identificar_tendenciaSalud() {
        // Identificar tendencias actuales en salud
        $tendencias = [
            'Telemedicina', 'Inteligencia Artificial en Diagnósticos',
            'Wearables Médicos', 'Medicina Personalizada'
        ];
        
        // Seleccionar tendencia principal
        $tendenciaSalud = $tendencias[0];
        
        // Registrar tendencia identificada
        $this->guardarLog("Tendencia identificada: {$tendenciaSalud}");
        
        return $tendenciaSalud;
    }
    
    public function verificar_normativaVigente() {
        // Verificar normativas legales vigentes
        $normativas = [
            'principal' => 'Ley de Salud',
            'secundaria' => 'Reglamento de Establecimientos de Salud',
            'ultima_actualizacion' => '2025-12-01'
        ];
        
        $normativaVigente = $normativas['principal'];
        
        return $normativaVigente;
    }

    // ============================================================
    // 4. ADN de tu cliente ideal: Gestión del Paciente
    // ============================================================
    public function registrar_paciente() {
        // Registrar nuevo paciente en el sistema
        $idPaciente = 1;
        $nombreCompleto = "Juan Pérez";
        $telefono = "0991234567";
        $direccion = "Latacunga";
        
        // Validar datos obligatorios
        if (empty($nombreCompleto) || empty($telefono)) {
            log_message('error', 'Intento de registro con datos incompletos');
            return false;
        }
        
        // Verificar si ya existe
        $existe = ($idPaciente === 1); // Simulación
        
        if (!$existe) {
            $paciente = [
                'id' => $idPaciente,
                'nombre' => $nombreCompleto,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'fecha_registro' => date('Y-m-d')
            ];
            $this->guardarLog("Paciente registrado: " . json_encode($paciente));
        }
        
        return true;
    }
    
    public function actualizar_datosPaciente() {
        // Actualizar datos existentes del paciente
        $pacienteId = 1;
        $nuevoTelefono = "0987654321";
        
        // Validar formato de teléfono
        if (!preg_match('/^09\d{8}$/', $nuevoTelefono)) {
            log_message('error', 'Formato de teléfono inválido');
            return false;
        }
        
        $this->guardarLog("Paciente ID {$pacienteId} actualizado");
        
        return true;
    }
    
    public function consultar_historialClinico() {
        // Consultar historial clínico del paciente
        $historialClinico = "Hipertensión diagnosticada en 2024, 
                             alergia a penicilina, 
                             última consulta: 15/04/2026";
        
        // Registrar consulta
        $this->guardarLog("Historial clínico consultado");
        
        return $historialClinico;
    }
    
    public function clasificar_categoriaPaciente() {
        // Clasificar según frecuencia de visitas
        $visitasUltimoAño = 8;
        
        if ($visitasUltimoAño >= 6) {
            $categoriaPaciente = "Frecuente";
        } elseif ($visitasUltimoAño >= 3) {
            $categoriaPaciente = "Regular";
        } else {
            $categoriaPaciente = "Ocasional";
        }
        
        return $categoriaPaciente;
    }
    
    public function gestionar_correoElectronico() {
        // Gestionar correo electrónico del paciente
        $correoElectronico = "juan@email.com";
        
        // Validar formato de email
        if (!filter_var($correoElectronico, FILTER_VALIDATE_EMAIL)) {
            log_message('error', "Correo inválido: {$correoElectronico}");
            return false;
        }
        
        // Verificar si ya existe en BD
        $correosExistentes = ['pedro@email.com', 'maria@email.com'];
        if (in_array($correoElectronico, $correosExistentes)) {
            log_message('warning', "Correo ya registrado: {$correoElectronico}");
            return false;
        }
        
        $this->guardarLog("Correo gestionado: {$correoElectronico}");
        
        return true;
    }
    
    public function registrar_contacto() {
        // Registrar contacto de emergencia
        $contactoEmergencia = [
            'nombre' => 'María Pérez',
            'telefono' => '0988887777',
            'parentesco' => 'Cónyuge'
        ];
        
        // Validar datos
        if (empty($contactoEmergencia['nombre']) || empty($contactoEmergencia['telefono'])) {
            return false;
        }
        
        $this->guardarLog("Contacto de emergencia registrado");
        
        return true;
    }

    // ============================================================
    // 5. Ingeniería de Ofertas: Diseño de Servicios de Atención
    // ============================================================
    public function crear_tipoPlanAtencion() {
        // Crear diferentes tipos de planes de atención
        $planes = ['General', 'Preferencial', 'VIP', 'Empresarial'];
        $tipoPlanAtencion = "General";
        
        // Configurar según el plan
        $configuracionPlan = [
            'General' => ['duracion' => 30, 'costo' => 25.50],
            'Preferencial' => ['duracion' => 45, 'costo' => 40.00]
        ];
        
        if (isset($configuracionPlan[$tipoPlanAtencion])) {
            $this->guardarLog("Plan {$tipoPlanAtencion} creado con configuración específica");
        }
        
        return $tipoPlanAtencion;
    }
    
    public function asignar_horarioDisponible() {
        // Asignar horarios disponibles para citas
        $horarioDisponible = "08:00–12:00";
        
        // Verificar disponibilidad real
        $horariosOcupados = ['09:00', '10:30'];
        $horarioInicio = explode('–', $horarioDisponible)[0];
        
        if (in_array($horarioInicio, $horariosOcupados)) {
            $horarioDisponible = "14:00–18:00"; // Horario alternativo
        }
        
        return $horarioDisponible;
    }
    
    public function gestionar_promocionActiva() {
        // Gestionar promociones activas
        $promocionActiva = "Descuento 10% en primera consulta";
        
        // Verificar vigencia
        $fechaExpiracion = strtotime('2026-12-31');
        $hoy = time();
        
        if ($hoy > $fechaExpiracion) {
            $promocionActiva = "Sin promociones activas";
        }
        
        return $promocionActiva;
    }
    
    public function definir_nivelPersonalizacion() {
        // Definir nivel de personalización del servicio
        $preferenciasPaciente = [
            'horario_preferido' => 'mañana',
            'medico_preferido' => 'Dr. Gómez',
            'notificaciones' => true
        ];
        
        if (count($preferenciasPaciente) >= 3) {
            $nivelPersonalizacion = "Prioridad alta";
        } elseif (count($preferenciasPaciente) >= 1) {
            $nivelPersonalizacion = "Prioridad media";
        } else {
            $nivelPersonalizacion = "Prioridad baja";
        }
        
        return $nivelPersonalizacion;
    }

    // ============================================================
    // 6. Marketing de conversión: Gestión de Comunicación y Atención
    // ============================================================
    public function agendar_cita() {
        // Agendar nueva cita médica
        $idCita = "CIT-" . date('Ymd') . "-001";
        $fechaCita = "2026-05-10";
        $horaCita = "10:00";
        
        // Verificar disponibilidad
        $cita = [
            'id' => $idCita,
            'fecha' => $fechaCita,
            'hora' => $horaCita,
            'estado' => 'Agendada',
            'fecha_agendamiento' => date('Y-m-d H:i:s')
        ];
        
        $this->guardarLog("Cita agendada: " . json_encode($cita));
        
        return true;
    }
    
    public function cancelar_cita() {
        // Cancelar cita existente
        $idCita = "CIT-20260510-001";
        $motivo = "Solicitud del paciente";
        
        $estadoCita = "Cancelada";
        
        // Registrar cancelación
        $this->guardarLog("Cita {$idCita} cancelada. Motivo: {$motivo}");
        
        // Liberar horario (simulación)
        $horarioLiberado = true;
        
        return true;
    }
    
    public function reprogramar_cita() {
        // Reprogramar cita a nueva fecha
        $idCita = "CIT-20260510-001";
        $nuevaFecha = "2026-05-15";
        $nuevaHora = "11:30";
        
        // Verificar nueva disponibilidad
        $disponible = true; // Simulación
        
        if ($disponible) {
            $this->guardarLog("Cita {$idCita} reprogramada para {$nuevaFecha} {$nuevaHora}");
            return true;
        }
        
        return false;
    }
    
    public function actualizar_estadoCita() {
        // Actualizar estado de la cita
        $idCita = "CIT-20260510-001";
        $estadoCita = "Atendida";
        
        $estadosValidos = ['Agendada', 'Confirmada', 'Atendida', 'Cancelada', 'No Asistió'];
        
        if (!in_array($estadoCita, $estadosValidos)) {
            $estadoCita = 'Agendada'; // Estado por defecto
        }
        
        $this->guardarLog("Cita {$idCita} actualizada a estado: {$estadoCita}");
        
        return $estadoCita;
    }
    
    public function enviar_recordatorio() {
        // Enviar recordatorio de cita al paciente
        $tipoRecordatorio = "SMS";
        $numeroTelefono = "0991234567";
        $mensaje = "Recordatorio: Su cita médica es mañana a las 10:00";
        
        // Simular envío según tipo
        $canalesDisponibles = ['SMS', 'WhatsApp', 'Email'];
        
        if (!in_array($tipoRecordatorio, $canalesDisponibles)) {
            $tipoRecordatorio = 'SMS'; // Por defecto
        }
        
        $this->guardarLog("Recordatorio enviado por {$tipoRecordatorio} a {$numeroTelefono}");
        
        return true;
    }
    
    public function registrar_nivelSatisfaccion() {
        // Registrar nivel de satisfacción post-consulta
        $nivelSatisfaccion = 4.5; // Escala 1-5
        
        // Validar rango
        if ($nivelSatisfaccion < 1) {
            $nivelSatisfaccion = 1;
        } elseif ($nivelSatisfaccion > 5) {
            $nivelSatisfaccion = 5;
        }
        
        // Clasificar satisfacción
        if ($nivelSatisfaccion >= 4.5) {
            $categoria = "Excelente";
        } elseif ($nivelSatisfaccion >= 3.5) {
            $categoria = "Buena";
        } elseif ($nivelSatisfaccion >= 2.5) {
            $categoria = "Regular";
        } else {
            $categoria = "Mala";
        }
        
        $this->guardarLog("Satisfacción registrada: {$nivelSatisfaccion} ({$categoria})");
        
        return $nivelSatisfaccion;
    }
    
    public function asignar_paciente() {
        // Asignar paciente a una cita o servicio
        $idPaciente = 1;
        $idCita = "CIT-20260510-001";
        
        // Verificar que el paciente exista
        if ($idPaciente <= 0) {
            log_message('error', 'ID de paciente inválido');
            return false;
        }
        
        $this->guardarLog("Paciente {$idPaciente} asignado a cita {$idCita}");
        
        return true;
    }
    
    public function asignar_servicio() {
        // Asignar servicio a una cita
        $idServicio = 101;
        $idCita = "CIT-20260510-001";
        
        // Verificar que el servicio esté activo
        if ($idServicio <= 0) {
            log_message('error', 'ID de servicio inválido');
            return false;
        }
        
        $this->guardarLog("Servicio {$idServicio} asignado a cita {$idCita}");
        
        return true;
    }

    // ============================================================
    // 7. Automatización e Infraestructura digital
    // ============================================================
    public function registrar_usuario() {
        // Registrar usuario en el sistema
        $nombreUsuario = "admin";
        $estadoUsuario = "Activo";
        
        // Validar nombre de usuario
        if (strlen($nombreUsuario) < 4) {
            log_message('error', 'Nombre de usuario muy corto');
            return false;
        }
        
        // Verificar si ya existe
        $usuariosExistentes = ['admin', 'medico1', 'recepcion'];
        if (in_array($nombreUsuario, $usuariosExistentes)) {
            log_message('warning', "Usuario {$nombreUsuario} ya existe");
            return false;
        }
        
        $this->guardarLog("Usuario registrado: {$nombreUsuario} - Estado: {$estadoUsuario}");
        
        return true;
    }
    
    public function autenticar_usuario() {
        // Autenticar credenciales de usuario
        $username = "admin";
        $password = "password123";
        
        // Simular verificación (en producción usar hash)
        $usuarioValido = ($username === "admin");
        $passwordValida = ($password === "password123");
        
        if ($usuarioValido && $passwordValida) {
            // Crear sesión
            session()->set('usuario_autenticado', true);
            session()->set('username', $username);
            $this->guardarLog("Usuario {$username} autenticado exitosamente");
            return true;
        }
        
        log_message('error', "Intento de autenticación fallido para usuario: {$username}");
        return false;
    }
    
    public function asignar_rolUsuario() {
        // Asignar rol a usuario
        $rolUsuario = "administrador";
        
        $rolesValidos = ['administrador', 'médico', 'recepcionista', 'paciente'];
        
        if (!in_array($rolUsuario, $rolesValidos)) {
            $rolUsuario = 'paciente'; // Rol por defecto
            log_message('warning', "Rol inválido, asignando rol por defecto");
        }
        
        // Guardar rol en sesión
        session()->set('rol_usuario', $rolUsuario);
        $this->guardarLog("Rol asignado: {$rolUsuario}");
        
        return true;
    }
    
    public function administrar_baseDatos() {
        // Administrar conexión y operaciones de BD
        $motorBaseDatos = "MySQL";
        
        // Simular verificación de conexión
        $configuracion = [
            'host' => 'localhost',
            'puerto' => 3306,
            'database' => 'sistema_salud',
            'motor' => $motorBaseDatos
        ];
        
        // Verificar conexión (simulación)
        $conectado = true;
        
        if (!$conectado) {
            log_message('critical', "Error de conexión a {$motorBaseDatos}");
            return false;
        }
        
        $this->guardarLog("Base de datos administrada: {$motorBaseDatos}");
        
        return true;
    }
    
    public function validar_nivelSeguridad() {
        // Validar nivel de seguridad del sistema
        $nivelSeguridad = "Alta";
        
        // Verificar múltiples aspectos
        $checks = [
            'sesion_activa' => true,
            'token_valido' => true,
            'ip_autorizada' => true,
            'https_activo' => true
        ];
        
        $cumple = !in_array(false, $checks);
        
        if (!$cumple) {
            $nivelSeguridad = "Baja";
            log_message('critical', 'Fallo en validación de seguridad');
        }
        
        return $nivelSeguridad;
    }
    
    public function gestionar_tipoIntegracion() {
        // Gestionar integraciones con sistemas externos
        $tipoIntegracion = "API externa";
        
        $integraciones = [
            'API externa' => 'https://api.salud.gob.ec/v1',
            'Webhook' => 'https://webhooks.sistema.com',
            'Base de datos compartida' => '192.168.1.100:5432'
        ];
        
        if (!isset($integraciones[$tipoIntegracion])) {
            $tipoIntegracion = 'API externa'; // Por defecto
        }
        
        $this->guardarLog("Integración gestionada: {$tipoIntegracion}");
        
        return true;
    }

    // ============================================================
    // 8. Power-Team & Delegación Estratégica
    // ============================================================
    public function registrar_medico() {
        // Registrar médico en el sistema
        $idMedico = 10;
        $nombreMedico = "Dr. Juan Carlos Gómez";
        $especialidad = "Cardiología";
        
        // Validar ID único
        $medicosExistentes = [5, 8, 12];
        if (in_array($idMedico, $medicosExistentes)) {
            $idMedico = max($medicosExistentes) + 1;
        }
        
        $medico = [
            'id' => $idMedico,
            'nombre' => $nombreMedico,
            'especialidad' => $especialidad,
            'registro_medico' => 'RM-' . date('Y') . '-' . $idMedico
        ];
        
        $this->guardarLog("Médico registrado: " . json_encode($medico));
        
        return true;
    }
    
    public function registrar_personal() {
        // Registrar personal administrativo
        $idPersonal = 20;
        $nombrePersonal = "";
        $cargo = "";
        
        // Validar datos
        if (empty($nombrePersonal) || empty($cargo)) {
            return false;
        }
        
        $personal = [
            'id' => $idPersonal,
            'nombre' => $nombrePersonal,
            'cargo' => $cargo,
            'departamento' => 'Atención al Paciente'
        ];
        
        $this->guardarLog("Personal registrado: " . json_encode($personal));
        
        return true;
    }
    
    public function asignar_especialidadMedica() {
        // Asignar especialidad a médico
        $especialidadMedica = "Cardiología";
        
        $especialidadesValidas = [
            'Cardiología', 'Pediatría', 'Ginecología', 
            'Traumatología', 'Dermatología', 'Medicina General'
        ];
        
        if (!in_array($especialidadMedica, $especialidadesValidas)) {
            $especialidadMedica = 'Medicina General'; // Por defecto
            log_message('warning', "Especialidad no válida, asignando Medicina General");
        }
        
        $this->guardarLog("Especialidad asignada: {$especialidadMedica}");
        
        return true;
    }
    
    public function asignar_horarioLaboral() {
        // Asignar horario laboral al personal
        $horarioLaboral = "08:00–16:00";
        
        // Validar formato
        if (!preg_match('/^\d{2}:\d{2}–\d{2}:\d{2}$/', $horarioLaboral)) {
            $horarioLaboral = "09:00–17:00"; // Horario estándar
            log_message('warning', "Formato de horario inválido, usando estándar");
        }
        
        // Calcular horas trabajadas
        $partes = explode('–', $horarioLaboral);
        $inicio = strtotime($partes[0]);
        $fin = strtotime($partes[1]);
        $horas = ($fin - $inicio) / 3600;
        
        $this->guardarLog("Horario asignado: {$horarioLaboral} ({$horas} horas)");
        
        return $horarioLaboral;
    }
    
    public function evaluar_nivelDesempeno() {
        // Evaluar desempeño del personal
        $nivelDesempeno = 95.5; // Porcentaje
        
        // Validar rango
        if ($nivelDesempeno < 0) {
            $nivelDesempeno = 0;
        } elseif ($nivelDesempeno > 100) {
            $nivelDesempeno = 100;
        }
        
        // Determinar categoría
        if ($nivelDesempeno >= 90) {
            $categoria = "Excelente";
            $bono = 500;
        } elseif ($nivelDesempeno >= 75) {
            $categoria = "Bueno";
            $bono = 250;
        } elseif ($nivelDesempeno >= 60) {
            $categoria = "Regular";
            $bono = 100;
        } else {
            $categoria = "Necesita mejorar";
            $bono = 0;
        }
        
        $this->guardarLog("Desempeño evaluado: {$nivelDesempeno}% - {$categoria} - Bono: \${$bono}");
        
        return $nivelDesempeno;
    }
    
    public function asignar_tipoRol() {
        // Asignar tipo de rol al personal
        $tipoRol = "Médico";
        
        $rolesPosibles = ['Médico', 'Enfermero', 'Administrativo', 'Directivo', 'Técnico'];
        
        if (!in_array($tipoRol, $rolesPosibles)) {
            $tipoRol = 'Administrativo'; // Rol por defecto
            log_message('warning', "Rol no reconocido, asignando Administrativo");
        }
        
        // Asignar permisos según rol
        $permisos = [
            'Médico' => ['citas', 'historial', 'recetas'],
            'Administrativo' => ['citas', 'facturacion', 'reportes']
        ];
        
        $permisosAsignados = $permisos[$tipoRol] ?? ['consultas_basicas'];
        
        $this->guardarLog("Rol asignado: {$tipoRol} - Permisos: " . implode(', ', $permisosAsignados));
        
        return true;
    }

    // ============================================================
    // Métodos auxiliares privados
    // ============================================================
    private function guardarLog($mensaje) {
        // Guardar registro de actividades del sistema
        log_message('info', '[SystemLogic] ' . $mensaje);
    }
}
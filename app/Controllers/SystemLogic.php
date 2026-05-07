<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SystemLogic extends Controller
{
    // ============================================================
    // 1. Visión 360°: Gestión Integral del Sistema de Salud Digital
    // ============================================================
    public function definir_objetivoGeneral() {
        $objetivoGeneral = "Reducir el tiempo de espera de citas médicas en un 30% para el próximo semestre";
        if (strlen($objetivoGeneral) < 10) {
            $objetivoGeneral = "Optimizar la gestión de citas médicas del sistema";
        }
        session()->set('objetivo_general', $objetivoGeneral);
        return $objetivoGeneral;
    }

    public function establecer_misionSistema() {
        $misionSistema = "Gestionar citas médicas eficientes, reduciendo tiempos de espera y mejorando la experiencia del paciente mediante tecnología digital innovadora";
        log_message('info', 'Misión establecida: ' . substr($misionSistema, 0, 50));
        return $misionSistema;
    }

    public function determinar_visionSistema() {
        $visionSistema = "Ser el sistema líder en gestión de salud digital en la región, reconocido por eficiencia operativa y satisfacción del paciente";
        return $visionSistema;
    }

    public function medir_indicadorRendimiento() {
        $porcentajeCumplimiento = 92.5;
        $metaEsperada = 95.0;
        $brecha = $metaEsperada - $porcentajeCumplimiento;
        if ($brecha > 0) {
            log_message('warning', "KPI por debajo de meta. Faltante: {$brecha}%");
        }
        return $porcentajeCumplimiento;
    }

    public function establecer_metaAnual() {
        $metaAnual = 50;
        if ($metaAnual > 100) { $metaAnual = 100; }
        $this->guardarLog("Meta anual de reducción de citas pendientes: {$metaAnual}%");
        return $metaAnual;
    }

    // ============================================================
    // 2. Productos Rentable: Gestión de Servicios Médicos
    // ============================================================
    public function registrar_servicio() {
        $nombreServicio = "Consulta general";
        $idServicio = 101;
        $duracionServicio = 30;
        $serviciosExistentes = [100, 102, 103];
        if (in_array($idServicio, $serviciosExistentes)) {
            $idServicio = max($serviciosExistentes) + 1;
        }
        $nuevoServicio = [
            'id' => $idServicio,
            'nombre' => $nombreServicio,
            'duracion' => $duracionServicio,
            'estado' => 'Disponible'
        ];
        $this->guardarLog("Servicio registrado: " . json_encode($nuevoServicio));
        return true;
    }

    public function actualizar_nombreServicio() {
        $nuevoNombre = "Especialidad Cardiología Avanzada";
        $servicioId = 101;
        if (strlen($nuevoNombre) < 5) { return false; }
        $this->guardarLog("Servicio ID {$servicioId} renombrado a: {$nuevoNombre}");
        return $nuevoNombre;
    }

    public function verificar_estadoServicio() {
        $horaActual = (int)date('H');
        $estadoServicio = ($horaActual >= 8 && $horaActual <= 20);
        $this->guardarLog("Estado de servicio verificado: " . ($estadoServicio ? 'Disponible' : 'Fuera de horario'));
        return $estadoServicio;
    }

    public function establecer_precioConsulta() {
        $precioBase = 25.50;
        $impuesto = 0.12;
        $precioConsulta = round($precioBase * (1 + $impuesto), 2);
        return $precioConsulta;
    }

    public function calcular_porcentajeRentabilidad() {
        $costoOperativo = 18.50;
        $ingreso = $this->establecer_precioConsulta();
        $ganancia = $ingreso - $costoOperativo;
        $porcentajeRentabilidad = ($ganancia / $ingreso) * 100;
        return round($porcentajeRentabilidad, 2);
    }

    public function gestionar_tipoPaquete() {
        $tiposDisponibles = ['Básico', 'Premium', 'Familiar', 'Virtual', 'Ejecutivo'];
        $tipoPaquete = "Básico";
        $indice = array_search($tipoPaquete, $tiposDisponibles);
        if ($indice === false) { $tipoPaquete = $tiposDisponibles[0]; }
        return $tipoPaquete;
    }

    // ============================================================
    // 3. Radar de Mercado: Análisis del Entorno de Salud
    // ============================================================
    public function registrar_analisisMercado() {
        $analisis = [
            'fecha'    => date('Y-m-d'),
            'analista' => 'Sistema Automatizado',
            'alcance'  => 'Nacional'
        ];
        $this->guardarLog("Análisis de mercado registrado: " . json_encode($analisis));
        return true;
    }

    public function analizar_nivelDemanda() {
        $demandaEspecialidades = [
            'Pediatría'        => 85,
            'Cardiología'      => 70,
            'Medicina General' => 95
        ];
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
        $numeroCompetidores = 5;
        $cuotaMercadoPropia = 25;
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
        $fechaAnalisis = date('Y-m-d');
        $formatoValido = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaAnalisis);
        if (!$formatoValido) {
            log_message('error', 'Fecha de análisis inválida, usando fecha actual');
        }
        return $fechaAnalisis;
    }

    public function identificar_tendenciaSalud() {
        $tendencias = ['Telemedicina', 'IA en Diagnósticos', 'Wearables Médicos', 'Medicina Personalizada'];
        $tendenciaSalud = $tendencias[0];
        $this->guardarLog("Tendencia en salud identificada: {$tendenciaSalud}");
        return $tendenciaSalud;
    }

    public function verificar_normativaVigente() {
        $normativas = [
            'principal'          => 'Ley de Salud',
            'secundaria'         => 'Reglamento de Establecimientos de Salud',
            'ultima_actualizacion'=> '2025-12-01'
        ];
        return $normativas['principal'];
    }

    // ============================================================
    // 4. ADN de tu cliente ideal: Gestión del Paciente
    // ============================================================
    public function registrar_paciente() {
        $idPaciente     = session()->get('user_id') ?? 0;
        $nombreCompleto = session()->get('user_name') ?? 'Paciente Nuevo';
        $telefono       = "0991234567";
        if (empty($nombreCompleto) || empty($telefono)) {
            log_message('error', 'Datos de paciente incompletos');
            return false;
        }
        $paciente = [
            'id'      => $idPaciente,
            'nombre'  => $nombreCompleto,
            'telefono'=> $telefono,
            'fecha_registro' => date('Y-m-d')
        ];
        $this->guardarLog("Paciente procesado: " . json_encode($paciente));
        return true;
    }

    public function actualizar_datosPaciente() {
        $pacienteId   = session()->get('user_id') ?? 1;
        $nuevoTelefono = "0987654321";
        if (!preg_match('/^09\d{8}$/', $nuevoTelefono)) {
            log_message('error', 'Formato de teléfono inválido');
            return false;
        }
        $this->guardarLog("Datos de paciente ID {$pacienteId} actualizados");
        return true;
    }

    public function consultar_historialClinico() {
        $historialClinico = "Hipertensión diagnosticada en 2024, alergia a penicilina, última consulta: 15/04/2026";
        $this->guardarLog("Historial clínico consultado por sistema");
        return $historialClinico;
    }

    public function clasificar_categoriaPaciente() {
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
        $correoElectronico = "paciente@sistema.com";
        if (!filter_var($correoElectronico, FILTER_VALIDATE_EMAIL)) {
            log_message('error', "Correo inválido: {$correoElectronico}");
            return false;
        }
        $this->guardarLog("Correo electrónico de paciente validado: {$correoElectronico}");
        return true;
    }

    public function registrar_contacto() {
        $contactoEmergencia = [
            'nombre'    => 'Familiar del Paciente',
            'telefono'  => '0988887777',
            'parentesco'=> 'Familiar directo'
        ];
        if (empty($contactoEmergencia['nombre']) || empty($contactoEmergencia['telefono'])) {
            return false;
        }
        $this->guardarLog("Contacto de emergencia registrado en sistema");
        return true;
    }

    // ============================================================
    // 5. Ingeniería de Ofertas: Diseño de Servicios de Atención
    // ============================================================
    public function crear_tipoPlanAtencion() {
        $planes = ['General', 'Preferencial', 'VIP', 'Empresarial'];
        $tipoPlanAtencion = "General";
        $configuracionPlan = [
            'General'    => ['duracion' => 30, 'costo' => 25.50],
            'Preferencial'=> ['duracion' => 45, 'costo' => 40.00]
        ];
        if (isset($configuracionPlan[$tipoPlanAtencion])) {
            $this->guardarLog("Plan {$tipoPlanAtencion} configurado con datos del módulo atencion");
        }
        return $tipoPlanAtencion;
    }

    public function asignar_horarioDisponible() {
        $horarioDisponible = "08:00–12:00";
        $horariosOcupados  = ['09:00', '10:30'];
        $horarioInicio     = explode('–', $horarioDisponible)[0];
        if (in_array($horarioInicio, $horariosOcupados)) {
            $horarioDisponible = "14:00–18:00";
        }
        return $horarioDisponible;
    }

    public function gestionar_promocionActiva() {
        $promocionActiva  = "Descuento 10% en primera consulta";
        $fechaExpiracion  = strtotime('2026-12-31');
        if (time() > $fechaExpiracion) {
            $promocionActiva = "Sin promociones activas";
        }
        return $promocionActiva;
    }

    public function definir_nivelPersonalizacion() {
        $preferenciasPaciente = [
            'horario_preferido'=> 'mañana',
            'medico_preferido' => 'Dr. Gómez',
            'notificaciones'   => true
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
        $idCita   = "Cita #" . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        $fechaCita = date('Y-m-d', strtotime('+3 days'));
        $horaCita  = "10:00";
        $cita = [
            'id'     => $idCita,
            'fecha'  => $fechaCita,
            'hora'   => $horaCita,
            'estado' => 'Pendiente',
            'agendado'=> date('Y-m-d H:i:s')
        ];
        $this->guardarLog("Cita agendada en sistema: " . json_encode($cita));
        return true;
    }

    public function cancelar_cita() {
        $idCita  = "Cita #001";
        $motivo  = "Solicitud del paciente";
        $estadoCita = "Cancelada";
        $this->guardarLog("Cita {$idCita} cancelada. Estado: {$estadoCita}. Motivo: {$motivo}");
        return true;
    }

    public function reprogramar_cita() {
        $idCita    = "Cita #001";
        $nuevaFecha = date('Y-m-d', strtotime('+7 days'));
        $nuevaHora  = "11:30";
        $disponible = true;
        if ($disponible) {
            $this->guardarLog("Cita {$idCita} reprogramada para {$nuevaFecha} a las {$nuevaHora}");
            return true;
        }
        return false;
    }

    public function actualizar_estadoCita() {
        $idCita       = "Cita #001";
        $estadoCita   = "Atendida";
        $estadosValidos = ['Pendiente', 'Confirmada', 'Atendida', 'Cancelada', 'No Asistió'];
        if (!in_array($estadoCita, $estadosValidos)) {
            $estadoCita = 'Pendiente';
        }
        $this->guardarLog("Estado de cita {$idCita} actualizado a: {$estadoCita}");
        return $estadoCita;
    }

    public function enviar_recordatorio() {
        $tipoRecordatorio  = "SMS";
        $numeroTelefono    = "0991234567";
        $mensaje           = "Recordatorio: Su cita médica es en 24 horas. Por favor confirme asistencia.";
        $canalesDisponibles = ['SMS', 'WhatsApp', 'Email', 'Notificación App'];
        if (!in_array($tipoRecordatorio, $canalesDisponibles)) {
            $tipoRecordatorio = 'SMS';
        }
        $this->guardarLog("Recordatorio enviado vía {$tipoRecordatorio} al número {$numeroTelefono}");
        return true;
    }

    public function registrar_nivelSatisfaccion() {
        $nivelSatisfaccion = 4.5;
        if ($nivelSatisfaccion < 1) { $nivelSatisfaccion = 1; }
        if ($nivelSatisfaccion > 5) { $nivelSatisfaccion = 5; }
        if ($nivelSatisfaccion >= 4.5) {
            $categoria = "Excelente";
        } elseif ($nivelSatisfaccion >= 3.5) {
            $categoria = "Buena";
        } elseif ($nivelSatisfaccion >= 2.5) {
            $categoria = "Regular";
        } else {
            $categoria = "Mala";
        }
        $this->guardarLog("Satisfacción de cita registrada: {$nivelSatisfaccion}/5 ({$categoria})");
        return $nivelSatisfaccion;
    }

    public function asignar_paciente() {
        $idPaciente = session()->get('user_id') ?? 1;
        $idCita     = "Cita #001";
        if ($idPaciente <= 0) {
            log_message('error', 'ID de paciente inválido al asignar cita');
            return false;
        }
        $this->guardarLog("Paciente ID {$idPaciente} asignado a cita {$idCita}");
        return true;
    }

    public function asignar_servicio() {
        $idServicio = 101;
        $idCita     = "Cita #001";
        if ($idServicio <= 0) {
            log_message('error', 'ID de servicio inválido');
            return false;
        }
        $this->guardarLog("Servicio ID {$idServicio} (Consulta general) asignado a {$idCita}");
        return true;
    }

    // ============================================================
    // 7. Automatización e Infraestructura digital
    // ============================================================
    public function registrar_usuario() {
        $nombreUsuario = "admin";
        $estadoUsuario = "Activo";
        if (strlen($nombreUsuario) < 4) {
            log_message('error', 'Nombre de usuario muy corto');
            return false;
        }
        $usuariosExistentes = ['admin', 'medico1', 'recepcion'];
        if (in_array($nombreUsuario, $usuariosExistentes)) {
            log_message('warning', "Usuario {$nombreUsuario} ya está registrado en el sistema");
            return false;
        }
        $this->guardarLog("Usuario del sistema registrado: {$nombreUsuario} — Estado: {$estadoUsuario}");
        return true;
    }

    public function autenticar_usuario() {
        $username       = "admin";
        $usuarioValido  = ($username === "admin");
        $passwordValida = true;
        if ($usuarioValido && $passwordValida) {
            session()->set('usuario_autenticado', true);
            session()->set('username', $username);
            $this->guardarLog("Usuario {$username} autenticado exitosamente");
            return true;
        }
        log_message('error', "Intento de autenticación fallido para: {$username}");
        return false;
    }

    public function asignar_rolUsuario() {
        $rolUsuario  = "administrador";
        $rolesValidos = ['administrador', 'médico', 'recepcionista', 'enfermero', 'paciente'];
        if (!in_array($rolUsuario, $rolesValidos)) {
            $rolUsuario = 'paciente';
            log_message('warning', "Rol no válido, asignando rol paciente por defecto");
        }
        session()->set('rol_usuario', $rolUsuario);
        $this->guardarLog("Rol de acceso asignado: {$rolUsuario}");
        return true;
    }

    public function administrar_baseDatos() {
        $motorBaseDatos = "MySQL";
        $configuracion  = [
            'host'     => 'localhost',
            'puerto'   => 3306,
            'database' => 'patients',
            'motor'    => $motorBaseDatos
        ];
        $conectado = true;
        if (!$conectado) {
            log_message('critical', "Error de conexión a {$motorBaseDatos} en " . $configuracion['host']);
            return false;
        }
        $this->guardarLog("Conexión a BD administrada: {$motorBaseDatos} — Base: {$configuracion['database']}");
        return true;
    }

    public function validar_nivelSeguridad() {
        $nivelSeguridad = "Alta";
        $checks = [
            'sesion_activa'  => session()->get('logged_in') === true,
            'token_valido'   => true,
            'ip_autorizada'  => true,
            'https_activo'   => true
        ];
        $cumple = !in_array(false, $checks);
        if (!$cumple) {
            $nivelSeguridad = "Baja";
            log_message('critical', 'Validación de seguridad fallida en sistema de citas');
        }
        return $nivelSeguridad;
    }

    public function gestionar_tipoIntegracion() {
        $tipoIntegracion = "API externa";
        $integraciones = [
            'API externa'            => 'https://api.salud.gob.ec/v1',
            'Sistema interno'        => 'http://localhost/patients',
            'Plataforma salud'       => 'https://salud.gob.ec/platform'
        ];
        if (!isset($integraciones[$tipoIntegracion])) {
            $tipoIntegracion = 'Sistema interno';
        }
        $this->guardarLog("Tipo de integración gestionado: {$tipoIntegracion}");
        return true;
    }

    // ============================================================
    // 8. Power-Team & Delegación Estratégica
    // ============================================================
    public function registrar_medico() {
        $idMedico        = 10;
        $nombreMedico    = "Dr. Juan Carlos Gómez";
        $especialidad    = "Cardiología";
        $medicosExistentes = [5, 8, 12];
        if (in_array($idMedico, $medicosExistentes)) {
            $idMedico = max($medicosExistentes) + 1;
        }
        $medico = [
            'id'           => $idMedico,
            'nombre'       => $nombreMedico,
            'especialidad' => $especialidad,
            'registro'     => 'RM-' . date('Y') . '-' . $idMedico
        ];
        $this->guardarLog("Médico registrado en personal: " . json_encode($medico));
        return true;
    }

    public function registrar_personal() {
        $idPersonal    = 20;
        $nombrePersonal = "";
        $cargo          = "";
        if (empty($nombrePersonal) || empty($cargo)) {
            log_message('warning', 'Intento de registro de personal con datos incompletos');
            return false;
        }
        $personal = [
            'id'          => $idPersonal,
            'nombre'      => $nombrePersonal,
            'cargo'       => $cargo,
            'departamento'=> 'Atención al Paciente'
        ];
        $this->guardarLog("Personal registrado: " . json_encode($personal));
        return true;
    }

    public function asignar_especialidadMedica() {
        $especialidadMedica  = "Cardiología";
        $especialidadesValidas = [
            'Cardiología', 'Pediatría', 'Ginecología',
            'Traumatología', 'Dermatología', 'Medicina General', 'Psicología'
        ];
        if (!in_array($especialidadMedica, $especialidadesValidas)) {
            $especialidadMedica = 'Medicina General';
            log_message('warning', "Especialidad no válida, asignando Medicina General");
        }
        $this->guardarLog("Especialidad asignada al médico: {$especialidadMedica}");
        return true;
    }

    public function asignar_horarioLaboral() {
        $horarioLaboral = "08:00–16:00";
        if (!preg_match('/^\d{2}:\d{2}–\d{2}:\d{2}$/', $horarioLaboral)) {
            $horarioLaboral = "09:00–17:00";
            log_message('warning', "Formato de horario inválido, usando horario estándar");
        }
        $partes = explode('–', $horarioLaboral);
        $inicio = strtotime($partes[0]);
        $fin    = strtotime($partes[1]);
        $horas  = ($fin - $inicio) / 3600;
        $this->guardarLog("Horario laboral asignado: {$horarioLaboral} ({$horas} horas diarias)");
        return $horarioLaboral;
    }

    public function evaluar_nivelDesempeno() {
        $nivelDesempeno = 95.5;
        if ($nivelDesempeno < 0)   { $nivelDesempeno = 0; }
        if ($nivelDesempeno > 100) { $nivelDesempeno = 100; }
        if ($nivelDesempeno >= 90) {
            $categoria = "Excelente";
            $bono      = 500;
        } elseif ($nivelDesempeno >= 75) {
            $categoria = "Bueno";
            $bono      = 250;
        } elseif ($nivelDesempeno >= 60) {
            $categoria = "Regular";
            $bono      = 100;
        } else {
            $categoria = "Necesita mejora";
            $bono      = 0;
        }
        $this->guardarLog("Desempeño evaluado: {$nivelDesempeno}% — {$categoria} — Bono: \${$bono}");
        return $nivelDesempeno;
    }

    public function asignar_tipoRol() {
        $tipoRol       = "Médico";
        $rolesPosibles = ['Médico', 'Enfermero', 'Administrativo', 'Directivo', 'Técnico'];
        if (!in_array($tipoRol, $rolesPosibles)) {
            $tipoRol = 'Administrativo';
            log_message('warning', "Rol no reconocido, asignando Administrativo por defecto");
        }
        $permisos = [
            'Médico'         => ['citas', 'historial', 'recetas', 'pacientes'],
            'Administrativo' => ['citas', 'facturacion', 'reportes', 'servicios']
        ];
        $permisosAsignados = $permisos[$tipoRol] ?? ['consultas_basicas'];
        $this->guardarLog("Rol '{$tipoRol}' asignado — Permisos: " . implode(', ', $permisosAsignados));
        return true;
    }

    // ============================================================
    // Métodos auxiliares privados
    // ============================================================
    private function guardarLog($mensaje) {
        log_message('info', '[SystemLogic] ' . $mensaje);
    }
}
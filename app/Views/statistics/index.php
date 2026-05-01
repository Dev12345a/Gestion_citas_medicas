<?php include(APPPATH . 'Views/header.php'); ?>

<?php
$statusLabel = ['scheduled'=>'Agendada','confirmed'=>'Confirmada','completed'=>'Completada','cancelled'=>'Cancelada','no_show'=>'No asistió'];
$statusColors = ['scheduled'=>'#6c757d','confirmed'=>'#0d6efd','completed'=>'#198754','cancelled'=>'#dc3545','no_show'=>'#fd7e14'];
?>

<div class="container-fluid mt-2 px-4">
    <div class="mb-4">
        <h1 class="fw-bold text-primary"><i class="fas fa-chart-bar me-2"></i>Dashboard Estadístico</h1>
        <p class="text-muted">Resumen del Sistema de Gestión de Citas Médicas</p>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background:linear-gradient(135deg,#667eea,#764ba2);">
                <div class="card-body text-white d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-1">Total de Citas</h6>
                        <h2 class="mb-0"><?= $totalAppointments ?></h2>
                    </div>
                    <i class="fas fa-calendar-alt fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background:linear-gradient(135deg,#f093fb,#f5576c);">
                <div class="card-body text-white d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-1">Citas Hoy</h6>
                        <h2 class="mb-0"><?= $todayAppointments ?></h2>
                    </div>
                    <i class="fas fa-calendar-day fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background:linear-gradient(135deg,#4facfe,#00f2fe);">
                <div class="card-body text-white d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-1">Esta Semana</h6>
                        <h2 class="mb-0"><?= $weekAppointments ?></h2>
                    </div>
                    <i class="fas fa-calendar-week fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background:linear-gradient(135deg,#fa709a,#fee140);">
                <div class="card-body text-white d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-1">Completadas</h6>
                        <h2 class="mb-0"><?= $byStatus['completed'] ?></h2>
                        <?php if ($totalAppointments > 0): ?>
                            <small class="text-white-50"><?= round($byStatus['completed']/$totalAppointments*100,1) ?>%</small>
                        <?php endif; ?>
                    </div>
                    <i class="fas fa-check-circle fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Fila 2: Gráficos de citas -->
    <div class="row mb-4">
        <!-- Por Estado (dona) -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-chart-pie me-2 text-primary"></i>Citas por Estado</h5>
                </div>
                <div class="card-body" style="height:320px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Por Especialidad (barras) -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-hospital me-2 text-success"></i>Citas por Especialidad</h5>
                </div>
                <div class="card-body" style="height:320px;">
                    <canvas id="specialtyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Fila 3: Evolución mensual + Top doctores -->
    <div class="row mb-4">
        <!-- Evolución mensual -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-chart-line me-2 text-info"></i>Evolución de Citas (últimos 6 meses)</h5>
                </div>
                <div class="card-body" style="height:320px;">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Doctores -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-trophy me-2 text-warning"></i>Top Doctores</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($topDoctors)): ?>
                        <div class="text-center text-muted py-4">Sin datos disponibles</div>
                    <?php else: ?>
                        <?php foreach ($topDoctors as $i => $doc): ?>
                            <?php $pct = $totalAppointments > 0 ? round($doc['total']/$totalAppointments*100,1) : 0; ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div>
                                        <span class="badge bg-secondary me-2">#<?= $i+1 ?></span>
                                        <strong>Dr(a). <?= esc($doc['doctor_name']) ?></strong>
                                        <small class="text-muted d-block ms-4"><?= esc($doc['specialty_name']) ?></small>
                                    </div>
                                    <h5 class="mb-0 text-primary"><?= $doc['total'] ?></h5>
                                </div>
                                <div class="progress" style="height:6px;">
                                    <div class="progress-bar bg-primary" style="width:<?= $pct ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Fila 4: Totales de pacientes y doctores -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="p-3 rounded" style="background:linear-gradient(45deg,#11998e,#38ef7d);">
                                <i class="fas fa-users fa-2x text-white mb-2"></i>
                                <h4 class="text-white mb-0"><?= $totalPatients ?></h4>
                                <small class="text-white-50">Total Pacientes</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 rounded" style="background:linear-gradient(45deg,#f7971e,#ffd200);">
                                <i class="fas fa-heartbeat fa-2x text-white mb-2"></i>
                                <h4 class="text-white mb-0"><?= $activePatients ?></h4>
                                <small class="text-white-50">Pacientes Activos</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 rounded" style="background:linear-gradient(45deg,#4776e6,#8e54e9);">
                                <i class="fas fa-user-md fa-2x text-white mb-2"></i>
                                <h4 class="text-white mb-0"><?= $totalDoctors ?></h4>
                                <small class="text-white-50">Doctores</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 rounded" style="background:linear-gradient(45deg,#fc4a1a,#f7b733);">
                                <i class="fas fa-times-circle fa-2x text-white mb-2"></i>
                                <h4 class="text-white mb-0"><?= $byStatus['cancelled'] + $byStatus['no_show'] ?></h4>
                                <small class="text-white-50">Canceladas / No asistió</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
Chart.defaults.font.family = "'Public Sans', sans-serif";

// Gráfico de Estado (dona)
new Chart(document.getElementById('statusChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: [<?php foreach ($statusLabel as $k => $v): ?>'<?= $v ?>',<?php endforeach; ?>],
        datasets: [{
            data: [<?php foreach (array_keys($statusLabel) as $k): ?><?= $byStatus[$k] ?? 0 ?>,<?php endforeach; ?>],
            backgroundColor: [<?php foreach ($statusColors as $c): ?>'<?= $c ?>',<?php endforeach; ?>],
            borderWidth: 3, borderColor: '#fff'
        }]
    },
    options: { responsive:true, maintainAspectRatio:false,
        plugins: { legend: { position:'bottom', labels:{ padding:15, usePointStyle:true } } }
    }
});

// Gráfico de Especialidad (barras)
new Chart(document.getElementById('specialtyChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: [<?php foreach ($bySpecialty as $row): ?>'<?= esc($row['specialty_name']) ?>',<?php endforeach; ?>],
        datasets: [{
            label: 'Citas',
            data: [<?php foreach ($bySpecialty as $row): ?><?= $row['total'] ?>,<?php endforeach; ?>],
            backgroundColor: ['#667eea','#f5576c','#4facfe','#fa709a','#43e97b','#f093fb','#fd7e14','#0dcaf0'],
            borderRadius: 6
        }]
    },
    options: { responsive:true, maintainAspectRatio:false,
        plugins:{ legend:{ display:false } },
        scales:{ y:{ beginAtZero:true, ticks:{ stepSize:1 } } }
    }
});

// Gráfico Mensual (línea)
new Chart(document.getElementById('monthlyChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: [<?php foreach ($byMonth as $m): ?>'<?= $m['month'] ?>',<?php endforeach; ?>],
        datasets: [{
            label: 'Citas por Mes',
            data: [<?php foreach ($byMonth as $m): ?><?= $m['total'] ?>,<?php endforeach; ?>],
            borderColor: '#667eea', backgroundColor: 'rgba(102,126,234,0.1)',
            borderWidth: 3, fill: true, tension: 0.4,
            pointBackgroundColor: '#667eea', pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 6
        }]
    },
    options: { responsive:true, maintainAspectRatio:false,
        plugins:{ legend:{ display:false } },
        scales:{ y:{ beginAtZero:true, ticks:{ stepSize:1 } } }
    }
});
</script>

<?php include(APPPATH . 'Views/footer.php'); ?>
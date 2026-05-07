</div>
</div>

</div>
</div>
<!--   Core JS Files   -->
<script src="<?= base_url('public/assets/js/core/jquery-3.7.1.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/core/bootstrap.min.js') ?>"></script>

<!-- jQuery Scrollbar -->
<script src="<?= base_url('public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>

<!-- Chart JS -->
<script src="<?= base_url('public/assets/js/plugin/chart.js/chart.min.js') ?>"></script>

<!-- jQuery Sparkline -->
<script src="<?= base_url('public/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') ?>"></script>

<!-- Chart Circle -->
<script src="<?= base_url('public/assets/js/plugin/chart-circle/circles.min.js') ?>"></script>

<!-- Datatables -->
<script src="<?= base_url('public/assets/js/plugin/datatables/datatables.min.js') ?>"></script>

<!-- Bootstrap Notify -->
<script src="<?= base_url('public/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>

<!-- jQuery Vector Maps -->
<script src="<?= base_url('public/assets/js/plugin/jsvectormap/jsvectormap.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/plugin/jsvectormap/world.js') ?>"></script>

<!-- Sweet Alert -->
<script src="<?= base_url('public/assets/js/plugin/sweetalert/sweetalert.min.js') ?>"></script>

<!-- Kaiadmin JS -->
<script src="<?= base_url('public/assets/js/kaiadmin.min.js') ?>"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTable si existe en la página
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            "pageLength": 25,
            "responsive": true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    }
});
</script>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    <?php if (session()->getFlashdata('success')): ?>
        toastr.success('<?= addslashes(session()->getFlashdata('success')) ?>', 'Éxito', {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        toastr.error('<?= addslashes(session()->getFlashdata('error')) ?>', 'Error', {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "7000"
        });
    <?php endif; ?>
</script>

</body>

</html>
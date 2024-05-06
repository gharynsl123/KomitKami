<script src="../../assets/js/core/popper.min.js"></script>
<script src="../../assets/js/core/bootstrap.min.js"></script>
<script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/chartjs.min.js"></script>
<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>

<script>
$(document).ready(function() {
    $('#dataTableDefault').DataTable({
        "language": {
            "sEmptyTable":      "Tidak ada data yang tersedia pada tabel ini",
            "sProcessing":      "Sedang memproses...",
            "sLengthMenu":      "Tampilkan _MENU_ entri",
            "sZeroRecords":     "Tidak ditemukan data yang sesuai",
            "sInfo":            "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":       "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered":    "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":     "",
            "sSearch":          "Cari:",
            "sUrl":             "",
            "oPaginate": {
                "sFirst":       "Pertama",
                "sPrevious":    "Sebelumnya",
                "sNext":        "Selanjutnya",
                "sLast":        "Terakhir"
            },
            "oAria": {
                "sSortAscending":  ": aktifkan untuk mengurutkan kolom secara ascending",
                "sSortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
            }
        },
        "info": true,
        "ordering": false,
        "lengthChange": false,
        "pageLength": 6,
        "searching": true
    });
});
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../assets/js/material-dashboard.min.js?v=3.1.0"></script>
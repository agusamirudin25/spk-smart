<!-- Footer -->
<div class="hk-footer-wrap container-fluid">
    <footer class="footer">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p>Sistem Pendukung Keputusan Menentukan Ekstrakurikuler Siswa © <?= date('Y') ?></p>
            </div>
        </div>
    </footer>
</div>
<!-- /Footer -->
</div>
<!-- /Main Content -->

</div>
<!-- /HK Wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('assets/vendors/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

<!-- Slimscroll JavaScript -->
<script src="<?= base_url('assets/') ?>/dist/js/jquery.slimscroll.js"></script>

<!-- Fancy Dropdown JS -->
<script src="<?= base_url('assets/') ?>/dist/js/dropdown-bootstrap-extended.js"></script>

<!-- FeatherIcons JavaScript -->
<script src="<?= base_url('assets/') ?>/dist/js/feather.min.js"></script>

<!-- Toggles JavaScript -->
<script src="<?= base_url('assets/') ?>/vendors/jquery-toggles/toggles.min.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/toggle-data.js"></script>

<!-- Toastr JS -->
<script src="<?= base_url('assets/') ?>/vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<script src="<?= base_url('assets/') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>/vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>

<!-- Init JavaScript -->
<script src="<?= base_url('assets/') ?>/dist/js/init.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "",
                searchPlaceholder: "Search",
                sLengthMenu: "_MENU_items"

            }
        });
    });

    function delete_data(id, ajax) {
        Swal.fire({
            title: "SPK Menentukan Ekstrakurikuler Siswa",
            text: "Apakah Anda Yakin menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                var string = 'id=' + id;
                $.ajax({
                    type: 'POST',
                    url: "<?= url() ?>" + ajax,
                    data: string,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            Swal.fire(
                                "SPK Menentukan Ekstrakurikuler Siswa",
                                data.msg,
                                'success'
                            ).then(function() {
                                window.location = "<?= base_url() ?>" + data.page;
                            })
                        }
                    }
                });

            }
        })
    }
</script>

</body>

</html>
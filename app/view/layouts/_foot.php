 <!-- Footer START -->
 <footer class="footer">
     <div class="footer-content">
         <p class="m-b-0">Copyright © <?= date('Y') ?> Sistem Pendukung Keputusan Penilaian Kinerja Guru.</p>
     </div>
 </footer>
 <!-- Footer END -->

 </div>
 <!-- Page Container END -->
 </div>
 </div>

 <script src="<?= base_url('') ?>assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.js"></script>

<script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });

        function delete_data(id, ajax) {
            Swal.fire({
                title: "SPK Penilaian Kinerja Guru",
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
                                    "SPK Penilaian Kinerja Guru",
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
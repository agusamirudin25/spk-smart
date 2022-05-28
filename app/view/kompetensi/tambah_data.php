<div class="main-content">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Tambah Kompetensi</h4>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form autocomplete="off" id="formTambah">
                                <div class="form-group row">
                                    <label for="kode_kompetensi" class="col-sm-2 col-form-label">Kode</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" readonly value="<?= $kode_otomatis ?>" name="kode_kompetensi" id="kode_kompetensi" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kompetensi" class="col-sm-2 col-form-label">Nama Kompetensi</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukan Nama kompetensi" name="kompetensi" id="kompetensi" required>
                                    </div>
                                </div>
                              
                                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->
</div>
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/helpers.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#formTambah').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url: '<?= url(); ?>kompetensi/proses_tambah_kompetensi',
                    type: "post",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.msg,
                            }).then(function() {
                                window.location = "<?= url() ?>" + response.page;
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.msg,
                            })
                        }
                    }
                });
            });
        });
    </script>
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ubah Data Alternatif</h4>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form autocomplete="off" id="formUbah">
                                <div class="form-group row">
                                    <label for="kode_alternatif" class="col-sm-2 col-form-label">Kode</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" readonly value="<?= $alternatif->kode_alternatif ?>" name="kode_alternatif" id="kode_alternatif" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_alternatif" class="col-sm-2 col-form-label">Nama alternatif</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukan Nama alternatif" value="<?= $alternatif->nama_alternatif ?>" name="nama_alternatif" id="nama_alternatif" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="prestasi" class="col-sm-2 col-form-label">Prestasi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="prestasi" id="prestasi" cols="30" rows="4" required placeholder="Masukan prestasi yang sudah didapat oleh ekstrakurikuler"><?= $alternatif->prestasi ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="waktu_latihan" class="col-sm-2 col-form-label">Waktu Latihan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="waktu_latihan" id="waktu_latihan" cols="30" rows="4" required placeholder="Masukan waktu latihan ekstrakurikuler"><?= $alternatif->waktu_latihan ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="submit">Ubah</button>
                                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->

    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/helpers.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#formUbah').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url: '<?= url(); ?>alternatif/proses_ubah_alternatif',
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
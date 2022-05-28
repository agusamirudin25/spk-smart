<div class="main-content">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ubah Data Kriteria</h4>
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
                                    <label for="kode_kriteria" class="col-sm-2 col-form-label">Kode</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" readonly value="<?= $kriteria->kode_kriteria ?>" name="kode_kriteria" id="kode_kriteria" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukan Nama Kriteria" value="<?= $kriteria->nama_kriteria ?>" name="nama_kriteria" id="nama_kriteria" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="tipe" id="tipe" required>
                                            <?php foreach($tipe as $row) : ?>
                                                <option <?= $kriteria->tipe == $row ? 'selected' : null ?> value="<?= $row ?>"><?= $row ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" value="<?= $kriteria->bobot ?>" placeholder="Masukan Bobot" name="bobot" id="bobot" required>
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
                    url: '<?= url(); ?>kriteria/proses_ubah_kriteria',
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
<div class="main-content">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ubah Data Guru</h4>
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
                                        <input class="form-control" type="text" readonly value="<?= $guru->kode_alternatif ?>" name="kode_alternatif" id="kode_alternatif" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="<?= $guru->nip ?>" type="text" placeholder="Masukan NIP" name="nip" id="nip" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="<?= $guru->nama_lengkap ?>" type="text" placeholder="Masukan nama lengkap" name="nama_lengkap" id="nama_lengkap" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                            <option <?= $guru->jenis_kelamin == "L" ? "selected" : null  ?> value="L">Laki-laki</option>
                                            <option <?= $guru->jenis_kelamin == "P" ? "selected" : null  ?> value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="<?= $guru->tempat_lahir ?>" placeholder="Masukan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" value="<?= $guru->tanggal_lahir ?>" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pendidikan" id="pendidikan" required>
                                            <?php foreach($pendidikan as $row) : ?>
                                                <option <?= $guru->pendidikan == $row ? 'selected' : null ?> value="<?= $row ?>"><?= $row ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pangkat_golongan" class="col-sm-2 col-form-label">Pangkat/Golongan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="<?= $guru->pangkat_golongan ?>" placeholder="Masukan Pangkat/Golongan" name="pangkat_golongan" id="pangkat_golongan" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" value="<?= $guru->tanggal_masuk ?>" placeholder="Masukan Tanggal Masuk" name="tanggal_masuk" id="tanggal_masuk" required>
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
                    url: '<?= url(); ?>guru/proses_ubah_guru',
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
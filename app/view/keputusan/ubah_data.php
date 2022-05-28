<div class="main-content">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ubah Data Penilaian</h4>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form id="formUbah" method="post" autocomplete="off">
                                <input type="hidden" name="kode_alternatif" value="<?= $keputusan->kd_alternatif ?>">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" disabled class="form-control" id="nip" value="<?= $keputusan->nip ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Nama</label>
                                    <input type="text" disabled class="form-control" id="nama" value="<?= $keputusan->nama_lengkap ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Pangkat/Golongan</label>
                                    <input type="text" disabled class="form-control" id="pangkat_golongan" value="<?= $keputusan->pangkat_golongan ?>">
                                </div>
                                <?php foreach ($kriteria as $row) : ?>
                                    <div class="form-group">
                                        <label><?= $row['kode_kriteria'] . ' - ' . $row['nama_kriteria'] ?></label>
                                        <input type="number" class="form-control" id="<?= $row['kode_kriteria'] ?>" name="nilai[]" placeholder="Nilai Kriteria <?= $row['nama_kriteria'] ?>" required <?= in_array($row['kode_kriteria'], $arrKriteria) ? 'disabled' : null ?> value="<?= $keputusan->{$row['kode_kriteria']} ?>">
                                        <?php if (!in_array($row['kode_kriteria'], $arrKriteria)) : ?>
                                            <input type="hidden" name="kd_kriteria[]" value="<?= $row['kode_kriteria'] ?>">
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
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
                    url: '<?= url(); ?>keputusan/proses_ubah_penilaian',
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
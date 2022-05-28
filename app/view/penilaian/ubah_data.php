<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ubah Penilaian</h4>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-4">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="nip">Ekstrakurikuler</label>
                                    <input type="text" disabled class="form-control" id="nip" value="<?= $alternatif->nama_alternatif ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Prestasi</label>
                                    <textarea disabled name="" class="form-control" id="" cols="30" rows="4"><?= $alternatif->prestasi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nip">Waktu Latihan</label>
                                    <textarea disabled name="" class="form-control" id="" cols="30" rows="2"><?= $alternatif->waktu_latihan ?></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-8">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form id="formUbah" method="post" autocomplete="off">
                                <input type="hidden" name="kode_alternatif" value="<?= $alternatif->kode_alternatif ?>">
                                <?php foreach ($kriteria as $key => $row) : ?>
                                    <input type="hidden" readonly class="form-control" id="kode_<?= $row['kode_kriteria'] ?>" name="kode_kriteria[]" value="<?= $row['kode_kriteria'] ?>">
                                    <div class="form-group">
                                        <label><?= ($key + 1) . '. ' . $row['nama_kriteria'] ?></label>
                                        <div class="row">
                                            <?php foreach ($row['opsi'] as $key_opsi => $opsi) : ?>
                                                <div class="col mt-15">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="jawaban_<?= $key + 1 ?>" id="radio<?= $key . $key_opsi ?>" value="<?= $opsi['nilai'] ?>" required class="custom-control-input" <?= $opsi['checked'] ?>>
                                                        <label class="custom-control-label" for="radio<?= $key . $key_opsi ?>"><?= $opsi['opsi'] ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
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
                    url: '<?= url(); ?>penilaian/proses_ubah_penilaian',
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
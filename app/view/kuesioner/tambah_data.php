<div class="main-content">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Isi Kuesioner</h4>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-3">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" disabled class="form-control" id="nip" value="<?= $guru->nip ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Nama</label>
                                    <input type="text" disabled class="form-control" id="nama" value="<?= $guru->nama_lengkap ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Pangkat/Golongan</label>
                                    <input type="text" disabled class="form-control" id="pangkat_golongan" value="<?= $guru->pangkat_golongan ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-9">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form id="formTambah" method="post" autocomplete="off">
                                <input type="hidden" name="kode_alternatif" value="<?= $guru->kode_alternatif ?>">
                                <?php foreach ($kompetensi as $key => $row) : ?>
                                    <input type="hidden" readonly class="form-control" id="kode_<?= $row['kode_kompetensi'] ?>" name="kode_kompetensi[]" value="<?= $row['kode_kompetensi'] ?>">
                                    <div class="form-group">
                                        <label><?= ($key + 1) . '. ' . $row['kompetensi'] ?></label>
                                        <div class="form-row">
                                            <?php foreach ($options as $key_opsi => $opsi) : ?>
                                                <div class="col">
                                                    <div class="radio">
                                                        <input type="radio" name="jawaban_<?= $key + 1 ?>" id="radio<?= $key . $key_opsi ?>" value="<?= $opsi['nilai'] ?>" required>
                                                        <label for="radio<?= $key . $key_opsi ?>">
                                                            <?= $opsi['opsi'] ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
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
            console.log(e);
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: '<?= url(); ?>kuesioner/proses_tambah_kuesioner',
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
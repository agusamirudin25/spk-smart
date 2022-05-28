<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <div class="card">
        <div class="card-body">
            <div class="row mb-20">
                <div class="col-md-12 d-flex justify-content-between">
                    <h4>Data Alternatif</h4>
                    <a href="<?= url('alternatif/tambah_alternatif') ?>" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="m-t-25">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Alternatif</th>
                            <th>Prestasi</th>
                            <th>Waktu Latihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alternatif as $row) : ?>
                            <tr>
                                <td><?= $row['kode_alternatif'] ?></td>
                                <td><?= $row['nama_alternatif'] ?></td>
                                <td><?= $row['prestasi'] ?></td>
                                <td><?= $row['waktu_latihan'] ?></td>
                                <td>
                                    <a class="btn btn-primary waves-effect waves-light" href="<?= url('alternatif/ubah_alternatif/' . $row['kode_alternatif']) ?>" role="button">Ubah</a>
                                    <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode_alternatif'] ?>', 'alternatif/hapus_alternatif')" role="button">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
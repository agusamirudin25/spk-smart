<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <div class="card">
        <div class="card-body">
            <div class="row mb-20">
                <div class="col-md-12 d-flex justify-content-between">
                    <h4>Data Kriteria</h4>
                    <a href="<?= url('kriteria/tambah_kriteria') ?>" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="m-t-25">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Tipe</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kriteria as $row) : ?>
                            <tr>
                                <td><?= $row['kode_kriteria'] ?></td>
                                <td><?= $row['nama_kriteria'] ?></td>
                                <td><?= $row['tipe'] ?></td>
                                <td><?= $row['bobot'] ?></td>
                                <td>
                                    <a class="btn btn-primary waves-effect waves-light" href="<?= url('kriteria/ubah_kriteria/' . $row['kode_kriteria']) ?>" role="button">Ubah</a>
                                    <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode_kriteria'] ?>', 'kriteria/hapus_kriteria')" role="button">Hapus</a>
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
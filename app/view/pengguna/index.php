<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <div class="card">
        <div class="card-body">
            <div class="row mb-20">
                <div class="col-md-12 d-flex justify-content-between">
                    <h4>Data Pengguna</h4>
                    <a href="<?= url('Pengguna/tambah_pengguna') ?>" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="m-t-25">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS/NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pengguna as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['kode_pengguna'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td>
                                    <a class="btn btn-primary waves-effect waves-light" href="<?= url('Pengguna/ubah_pengguna/' . $row['kode_pengguna']) ?>" role="button">Ubah</a>
                                    <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode_pengguna'] ?>', 'Pengguna/hapus_pengguna')" role="button">Hapus</a>
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
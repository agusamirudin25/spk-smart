<!-- page css -->
<link href="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Data Pengguna</h4>
            <a href="<?= url('Pengguna/tambah_pengguna') ?>" class="btn btn-primary">Tambah Data</a>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pengguna as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nip'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['jabatan'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td>
                                    <a class="btn btn-primary waves-effect waves-light" href="<?= url('Pengguna/ubah_pengguna/' . $row['nip']) ?>" role="button">Ubah</a>
                                    <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['nip'] ?>', 'Pengguna/hapus_pengguna')" role="button">Hapus</a>
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
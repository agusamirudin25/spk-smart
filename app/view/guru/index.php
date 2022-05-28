<!-- page css -->
<link href="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Data Guru</h4>
            <a href="<?= url('guru/tambah_guru') ?>" class="btn btn-primary">Tambah Data</a>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Pendidikan</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guru as $row) : ?>
                            <tr>
                                <td><?= $row['kode_alternatif'] ?></td>
                                <td><?= $row['nip'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['tempat_lahir'] . ', ' . tgl_indo($row['tanggal_lahir']) ?></td>
                                <td><?= $row['pendidikan'] ?></td>
                                <td><?= tgl_indo($row['tanggal_masuk']) ?></td>
                                <td>
                                    <a class="btn btn-primary waves-effect waves-light" href="<?= url('guru/ubah_guru/' . $row['kode_alternatif']) ?>" role="button">Ubah</a>
                                    <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode_alternatif'] ?>', 'guru/hapus_guru')" role="button">Hapus</a>
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
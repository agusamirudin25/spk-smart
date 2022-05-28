<!-- page css -->
<link href="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Data Kompetensi</h4>
            <a href="<?= url('kompetensi/tambah_kompetensi') ?>" class="btn btn-primary">Tambah Data</a>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama kompetensi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kompetensi as $row) : ?>
                            <tr>
                                <td><?= $row['kode_kompetensi'] ?></td>
                                <td><?= $row['kompetensi'] ?></td>
                                <td>
                                    <a class="btn btn-primary waves-effect waves-light" href="<?= url('kompetensi/ubah_kompetensi/' . $row['kode_kompetensi']) ?>" role="button">Ubah</a>
                                    <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode_kompetensi'] ?>', 'kompetensi/hapus_kompetensi')" role="button">Hapus</a>
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
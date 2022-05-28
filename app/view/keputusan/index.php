<!-- page css -->
<link href="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Nilai Keputusan Awal</h4>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                            <th>K4</th>
                            <th>K5</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($penilaian as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['K1'] ?></td>
                                <td><?= $row['K2'] ?></td>
                                <td><?= $row['K3'] ?></td>
                                <td><?= $row['K4'] ?></td>
                                <td><?= $row['K5'] ?></td>
                                <td class="<?= ($row['status'] == 1) ? 'bg-success text-white' : 'bg-danger text-white' ?>"><?php echo ($row['status'] == 1) ? 'Sudah Lengkap' : 'Belum Lengkap' ?></td>
                                <?php if ($row['status'] == 1) : ?>
                                    <td>
                                        <a class="btn btn-success" href="<?= url('keputusan/ubah_penilaian/' . $row['kode']) ?>" role="button">Ubah</a>
                                        <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode'] ?>', 'keputusan/hapus_penilaian')" role="button">Hapus</a>
                                    </td>
                                    <?php else : ?>
                                        <td>
                                        <a class="btn btn-primary" href="<?= url('keputusan/tambah_penilaian/' . $row['kode']) ?>" role="button">Tambah</a>
                                        <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['kode'] ?>', 'keputusan/hapus_penilaian')" role="button">Hapus</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                </table>
            </div>
            <div class="row m-t-25">
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="<?= url('keputusan/buat_keputusan') ?>" class="btn btn-primary">Buat Keputusan</a>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
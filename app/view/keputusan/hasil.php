<!-- page css -->
<link href="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Hasil Keputusan</h4>
            <span class="badge badge-success">Waktu Proses SAW = <?= round($waktu, 2, PHP_ROUND_HALF_UP); ?> detik</span>
            <div class="m-t-25">
                <table id="data-tables" class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Persentase</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($hasil as $row) : ?>
                            <tr>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['nilai'] ?></td>
                                <td><?= $row['persen'] ?></td>
                                <td><?= $no++ ?></td>
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
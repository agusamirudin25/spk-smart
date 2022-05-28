<div class="container-fluid mt-xl-50 mt-sm-30 mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-between mb-10">
                <h4>Hasil Keputusan</h4>
                <a href="<?= base_url('Laporan/generate') ?>" class="btn btn-info">Cetak Laporan</a>
            </div>
            <div class="m-t-25">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Ekstrakurikuler</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($hasil as $row) : ?>
                            <tr>
                                <td><?= $row['kode_pengguna'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['nama_alternatif'] ?></td>
                                <td><?= round($row['nilai'] * 100, 2)  . '%' ?></td>
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
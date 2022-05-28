<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                </table>
            </div>
            <?php if($status_tombol) : ?>
            <div class="row m-t-25">
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="<?= url('keputusan/buat_keputusan') ?>" class="btn btn-primary">Buat Keputusan</a>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
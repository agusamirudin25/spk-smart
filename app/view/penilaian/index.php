<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <div class="card">
        <div class="card-body">
            <h4>Penilaian</h4>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ekstrakurikuler</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                         foreach ($penilaian as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_alternatif'] ?></td>
                                <td>
                                    <?php if($row['status'] == 1) : ?>
                                        <a class="btn btn-success" href="<?= url('penilaian/ubah_penilaian/' . $row['kode_alternatif']) ?>" role="button">Ubah Penilaian</a>
                                    <?php else : ?>
                                        <a href="<?= url('penilaian/tambah_penilaian/') . '/' . $row['kode_alternatif'] ?>" class="btn btn-primary">Isi Penilaian</a>
                                    <?php endif; ?>
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
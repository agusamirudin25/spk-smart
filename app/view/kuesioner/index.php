<!-- page css -->
<link href="<?= base_url('') ?>assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Data Kuesioner</h4>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Pangkat/Golongan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                         foreach ($kuesioner as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nip'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['pangkat_golongan'] ?></td>
                                <td>
                                    <?php if($row['nilai']) : ?>
                                        <a class="btn btn-success" href="<?= url('kuesioner/ubah_kuesioner/' . $row['kode_alternatif']) ?>" role="button">Ubah Kuesioner</a>
                                    <?php else : ?>
                                        <a href="<?= url('kuesioner/tambah_kuesioner/') . '/' . $row['kode_alternatif'] ?>" class="btn btn-primary">Isi Kuesioner</a>
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
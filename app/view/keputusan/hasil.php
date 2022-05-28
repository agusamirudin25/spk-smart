<div class="container-fluid mt-xl-50 mt-sm-30 mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3>Hasil Keputusan oleh SMART</h3>
            <hr>
            <div class="card card-lg">
                <h6 class="card-header">
                    Hasil Normalisasi Bobot Kriteria
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        <div class="media pb-0">
                            <table id="data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Normalisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($normalisasi as $row) : ?>
                                        <tr>
                                            <td><?= $row['kode'] ?></td>
                                            <td><?= $row['kriteria'] ?></td>
                                            <td><?= $row['bobot'] ?></td>
                                            <td><?= $row['nilai'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-lg">
                <h6 class="card-header">
                    Hasil Nilai Utility
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        <div class="media pb-0">
                            <table id="data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Alternatif</th>
                                        <?php foreach ($kriteria as $ctr) : ?>
                                            <th><?= $ctr['kode_kriteria']; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alternatif as $row) : ?>
                                        <tr>
                                            <td><?= $row['kode_alternatif'] ?></td>
                                            <td><?= $row['nama_alternatif'] ?></td>
                                            <?php foreach ($kriteria as $c) : ?>
                                                <td><?= $nilai_utility[$row['kode_alternatif']]['nilai' . $c['kode_kriteria']]; ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-lg">
                <h6 class="card-header">
                    Hasil Nilai Akhir
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        <div class="media pb-0">
                            <table id="data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Alternatif</th>
                                        <th>Nilai Akhir</th>
                                        <th>Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php rsort($nilai_akhir); ?>
                                    <?php $count = 0; ?>
                                    <?php foreach ($alternatif as $a) : ?>
                                        <?php foreach ($alternatif as $alter) : ?>
                                            <?php if ($alter['kode_alternatif'] === $nilai_akhir[$count]['kode']) : ?>
                                                <tr>
                                                    <td><?= $nilai_akhir[$count]['kode']; ?></th>
                                                    <td><?= $alter['nama_alternatif']; ?></td>
                                                    <td><?= $nilai_akhir[$count]['nilai']; ?></td>
                                                    <td><?= $i = $count + 1; ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php ++$count; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-lg">
                <h6 class="card-header">
                    Kesimpulan
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        <div class="media pb-0">
                           <p>Berdasarkan hasil perhitungan metode Simple Multi-Attribute Rating Technique (SMART) maka alternatif ekstrakurikuler <strong><?= $keputusan->nama_alternatif . " (" . $keputusan->kode_alternatif . ")" ?></strong> merupakan alternatif ekstrakurikuler yang tepat dengan nilai akhir <strong><?= $nilai_akhir[0]['nilai'] ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<?php
function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3"><i class="fa fa-trophy" style="color: #ffd700;"></i> Data Prestasi </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prestasi</th>
                            <th>Penyelenggara</th>
                            <th>No. Piagam / Sertifikat</th>
                            <th>Tanggal</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($prestasi as $data) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $data["peringkat"]; ?> - <?= $data["prestasi"]; ?> - <?= $data["tingkat"]; ?></td>
                                <td><?= $data["penyelenggara"]; ?></td>
                                <td><?= $data["no_piagam"]; ?></td>
                                <td><?= tanggal_indo($data["tanggal_piagam"]) ?></td>
                                <td>Lihat Bukti</td>
                            </tr>
                        <?php $no++;
                        endforeach ?>
                        <?php if ($no <= 1) : ?>
                            <tr>
                                <td class="text-center lead" colspan="10">Tidak Ada Data Prestasi !</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.col -->
</div>
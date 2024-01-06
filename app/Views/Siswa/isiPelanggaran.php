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
                <h3 class="card-title p-3"><i class="fa fa-gavel" style="color: #dc3545;"></i> Data Pelanggaran </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Pelanggaran</th>
                            <th>Poin</th>
                            <th>Keterangan</th>
                            <th>Penindak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $total_poin = 0;
                        foreach ($pelanggaran as $data) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $data["tanggal"]; ?></td>
                                <td>
                                    <p class="text-danger"><?= $data["jenis_pelanggaran"]; ?></p>
                                </td>
                                <td>
                                    <p class="text-danger"><?= $data["poin"]; ?></p>
                                </td>
                                <td><?= $data["ket"]; ?></td>
                                <td><?= $data["nama_ptk"]; ?></td>
                            </tr>

                        <?php $total_poin = $total_poin + $data["poin"];
                            $no++;
                        endforeach ?>
                        <?php if ($no <= 1) : ?>
                            <tr>
                                <td class="text-center lead" colspan="10">Tidak Ada Data Pelanggaran !</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                    <?php if ($no > 1) : ?>
                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align: right;">
                                    <p>Total Poin Pelanggaran</p>
                                </th>
                                <th>
                                    <p class="text-danger"><?= $total_poin; ?></p>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    <?php endif ?>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.col -->
</div>
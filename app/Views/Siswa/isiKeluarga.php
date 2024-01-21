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
<div class="card-body table-responsive p-0">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Hubungan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($keluarga as $data) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $data["nik"]; ?></td>
                    <td><?= $data["nama_kel"]; ?></td>
                    <td><?= $data["hubungan_kel"]; ?></td>
                    <td><?php if ($data["jk_kel"] == "L") echo "Laki-laki";
                        else echo "Perempuan";  ?></td>
                    <td><?= $data["tempat_lahir_kel"]; ?>, <?= tanggal_indo($data["tanggal_lahir_kel"]); ?></td>
                    <td><?= $data["no_hp"]; ?></td>
                    <td>
                        <a class="btn btn-flat btn-warning btn-sm" onclick="edit('<?= $data['id_kel'] ?>')">edit</a>
                        <a class="btn btn-flat btn-danger btn-sm" onclick="hapus('<?= $data['id_kel'] ?>')">hapus</i></a>
                    </td>
                </tr>
            <?php $no++;
            endforeach ?>
            <?php if ($no <= 1) : ?>
                <tr>
                    <td class="text-center lead" colspan="10">Tidak Ada Data !</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
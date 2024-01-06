<div class="card-body p-0">
    <table class="table">
        <tbody>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><?= $siswa[0]["nisn"]; ?></td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><?= $siswa[0]["nis"]; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <?php if ($siswa[0]["nama_kelas"] != "") : ?>
                    <td><?= $siswa[0]["nama_kelas"] ?></td>
                <?php else : ?>
                    <td class='text-warning'>--tidak ada data--</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Tahun Masuk</td>
                <td>:</td>
                <td><?= $siswa[0]["tahun_masuk"]; ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $siswa[0]["nik"]; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $siswa[0]["nama"]; ?></td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>
                    <?= $siswa[0]["tempat_lahir"]; ?>, <?= $tanggal_indo; ?>
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                    <?php if ($siswa[0]["jk"] == "L") echo "Laki-laki";
                    else echo "Perempuan";  ?>
                </td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?= $siswa[0]["agama"]; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $siswa[0]["alamat"]; ?></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td><?= $siswa[0]["no_hp"]; ?></td>
            </tr>
            <tr>
                <td>Alamat Orang Tua</td>
                <td>:</td>
                <td><?= $siswa[0]["alamat_ortu"]; ?></td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>:</td>
                <td><?= $siswa[0]["nama_ayah"]; ?></td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td><?= $siswa[0]["nama_ibu"]; ?></td>
            </tr>
            <tr>
                <td>Sekolah Asal</td>
                <td>:</td>
                <td><?= $siswa[0]["sekolah_asal"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>
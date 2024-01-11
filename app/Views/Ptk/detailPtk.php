<div class="card-body p-0">
    <table class="table">
        <tbody>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $ptk[0]["nik_ptk"]; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php if ($ptk[0]["gelar_depan"] != "") echo $ptk[0]["gelar_depan"] . ". ";
                    echo $ptk[0]["nama_ptk"];
                    if ($ptk[0]["gelar_belakang"] != "") echo ", " . $ptk[0]["gelar_belakang"] ?></td>
            </tr>
            <tr>
                <td>Status Kepegawaian</td>
                <td>:</td>
                <td><?= $ptk[0]["status_pegawai"]; ?></td>
            </tr>
            <tr>
                <td>NIP / NIPPPK</td>
                <td>:</td>
                <?php if ($ptk[0]["nip"] != "") : ?>
                    <td><?= $ptk[0]["nip"] ?></td>
                <?php else : ?>
                    <td class='text-warning'>--tidak ada data--</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>NUPTK</td>
                <td>:</td>
                <?php if ($ptk[0]["nuptk"] != "") : ?>
                    <td><?= $ptk[0]["nuptk"] ?></td>
                <?php else : ?>
                    <td class='text-warning'>--tidak ada data--</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <?php if ($ptk[0]["tmp_lahir_ptk"] != "") : ?>
                    <td><?= $ptk[0]["tmp_lahir_ptk"]; ?>, <?= $tanggal_indo; ?></td>
                <?php else : ?>
                    <td class='text-warning'>--tidak ada data--</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                    <?php if ($ptk[0]["jk_ptk"] == "L") echo "Laki-laki";
                    else echo "Perempuan";  ?>
                </td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <?php if ($ptk[0]["agama_ptk"] != "") : ?>
                    <td><?= $ptk[0]["agama_ptk"] ?></td>
                <?php else : ?>
                    <td class='text-warning'>--tidak ada data--</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <?php if ($ptk[0]["alamat_ptk"] != "") : ?>
                    <td><?= $ptk[0]["alamat_ptk"] ?></td>
                <?php else : ?>
                    <td class='text-warning'>--tidak ada data--</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td><?= $ptk[0]["no_hp_ptk"]; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $ptk[0]["email"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>
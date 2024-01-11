<table class="table">
    <tbody>
        <tr>
            <td>NPSN</td>
            <td>:</td>
            <td><?= $sekolah["npsn"]; ?></td>
        </tr>
        <tr>
            <td>Nama Sekolah</td>
            <td>:</td>
            <td><?= $sekolah["nama_sekolah"]; ?></td>
        </tr>
        <tr>
            <td>NSS</td>
            <td>:</td>
            <?php if ($sekolah["nss"] != "") : ?>
                <td><?= $sekolah["nss"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <?php if ($sekolah["status"] != "") : ?>
                <td><?= $sekolah["status"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>No. SK. Pendirian</td>
            <td>:</td>
            <?php if ($sekolah["no_sk_pendirian"] != "") : ?>
                <td><?= $sekolah["no_sk_pendirian"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Tanggal SK Pendirian</td>
            <td>:</td>
            <?php if ($sekolah["tgl_sk"] != "") : ?>
                <td><?= $sekolah["tgl_sk"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <?php if ($sekolah["alamat_sekolah"] != "") : ?>
                <td><?= $sekolah["alamat_sekolah"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Telephone</td>
            <td>:</td>
            <?php if ($sekolah["telp"] != "") : ?>
                <td><?= $sekolah["telp"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Kode POS</td>
            <td>:</td>
            <td><?= $sekolah["kode_pos"]; ?></td>
        </tr>
        <tr>
            <td>Email Sekolah</td>
            <td>:</td>
            <?php if ($sekolah["email"] != "") : ?>
                <td><?= $sekolah["email"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Nama Kepala Sekolah</td>
            <td>:</td>
            <?php if ($sekolah["kepsek"] != "") : ?>
                <td><?= $sekolah["kepsek"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
        <tr>
            <td>NIP Kepala Sekolah</td>
            <td>:</td>
            <?php if ($sekolah["nip_kepsek"] != "") : ?>
                <td><?= $sekolah["nip_kepsek"] ?></td>
            <?php else : ?>
                <td class='text-warning'>--tidak ada data--</td>
            <?php endif ?>
        </tr>
    </tbody>
</table>
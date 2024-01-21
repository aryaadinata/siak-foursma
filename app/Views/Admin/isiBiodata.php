<?php
$session = \Config\Services::session();
if (!empty($session->getFlashdata('foto'))) {
    $classFoto = "is-invalid";
    $pesanFoto = $session->getFlashdata('foto');
} else {
    $classFoto = "";
    $pesanFoto = "";
}
if (!empty($session->getFlashdata('suksesupload'))) {
    $alert = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                  Upload Foto Berhasil !
                </div>';
} else {
    $alert = '';
}
?>
<div class="col-md-9">
    <div class="card card-default">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3"><i class="fas fa-user" style="color: #1b3e72;"></i> Biodata Siswa</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a href="#" class="nav-link btn btn-flat bg-gray" onclick=datasiswa()><i class=" fas fa-arrow-left"></i> Kembali</a></li>
                <li class="nav-item"><a href="#" class="nav-link btn btn-flat bg-pink tomboledit" onclick=edit(<?= $siswa[0]["nisn"] ?>)><i class=" fas fa-pencil-alt"></i> Edit Biodata</a></li>
            </ul>
        </div>
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
                        <td><?= $siswa[0]["tahun_masuk"] ?></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <?php if ($siswa[0]["nik"] != "") : ?>
                            <td><?= $siswa[0]["nik"] ?></td>
                        <?php else : ?>
                            <td class='text-warning'>--tidak ada data--</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $siswa[0]["nama"]; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>:</td>
                        <?php if ($siswa[0]["tempat_lahir"] != "" && $tanggal_indo != "") : ?>
                            <td>
                                <?= $siswa[0]["tempat_lahir"]; ?>, <?= $tanggal_indo; ?>
                            </td>
                        <?php else : ?>
                            <td class='text-warning'>--tidak ada data--</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <?php if ($siswa[0]["tempat_lahir"] != "" && $tanggal_indo != "") : ?>
                            <td>
                                <?php if ($siswa[0]["jk"] == "L") echo "Laki-laki";
                                else echo "Perempuan";  ?>
                            </td>
                        <?php else : ?>
                            <td class='text-warning'>--tidak ada data--</td>
                        <?php endif ?>
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
                        <td>Alamat Orang Tua</td>
                        <td>:</td>
                        <td><?= $siswa[0]["alamat_ortu"]; ?></td>
                    </tr>
                    <tr>
                        <td>Sekolah Asal</td>
                        <td>:</td>
                        <td><?= $siswa[0]["sekolah_asal"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa fa-image" style="color: #1b3e72;"></i>
                Pas Foto
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="text-center">
                <?php if ($siswa[0]["foto"] != "") : ?>
                    <img class="rounded img-fluid" src="../../dist/img/pasfoto/<?= $siswa[0]["foto"]; ?>" alt="Photo" height="320" width="160">
                <?php else : ?>
                    <img class="rounded img-fluid" src="../../dist/img/pasfoto/none.jpg" alt="Photo" height="320" width="160">
                <?php endif ?>
            </div>
        </div>
        <!-- /.card-body -->
        <!-- /card-footer -->
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</div>
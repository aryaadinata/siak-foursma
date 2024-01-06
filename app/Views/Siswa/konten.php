<?php if ($siswa[0]['tunggakan'] != 0) : ?>
    <script>
        Swal.fire({
            position: 'mid',
            toast: false,
            icon: 'error',
            title: 'Fitur Download SKL Nonaktif',
            text: 'Silakan menghubungi sekolah untuk konfirmasi !',
            showConfirmButton: false,
            showCloseButton: true,
        });
    </script>
<?php endif ?>

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Data Siswa</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Nama Lengkap</dt>
                            <dd class="col-sm-8"><?= $siswa[0]["nama"] ?></dd>
                            <dt class="col-sm-4">NIS</dt>
                            <dd class="col-sm-8"><?= $siswa[0]["nis"] ?></dd>
                            <dt class="col-sm-4">NISN</dt>
                            <dd class="col-sm-8"><?= $siswa[0]["nisn"] ?></dd>
                            <dt class="col-sm-4">Tempat, Tanggal Lahir</dt>
                            <dd class="col-sm-8"><?= $siswa[0]["tempat_lahir"] ?>, <?= $siswa[0]["tanggal_lahir"] ?></dd>
                            <dt class="col-sm-4">Peminatan</dt>
                            <dd class="col-sm-8"><?= $siswa[0]["nama_peminatan"] ?></dd>
                            <dt class="col-sm-4">Kelas</dt>
                            <dd class="col-sm-8"><?= $siswa[0]["nama_rombel"] ?></dd>
                            <?php if ($siswa[0]['tunggakan'] == 0) : ?>
                                <dt class="col-sm-4">Download SKL</dt>
                                <dd class="col-sm-8"><img src="data:image/png;base64,<?php echo $gambar; ?>"></img><br></dd>
                                <dd class="col-sm-8 offset-sm-4"><a href="https://drive.google.com/file/d/<?= $siswa[0]['link'] ?>/view" class="btn btn-primary btn-sm" target="_blank">Download SKL</a></dd>
                            <?php endif ?>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-success alert-dismissible">
                    <h5><i class="icon fas fa-check"></i> Selamat</h5>
                    Anda telah dinyatakan <b>LULUS</b> dari <?= $sekolah[0]["nama_sekolah"] ?> pada tanggal <?= $sekolah[0]["tanggal_pengesahan"] ?>, setelah memenuhi semua kriteria yang disyaratkan sesuai dengan Perundang-undangan.
                    <p></p>
                    <p>Klik "Download SKL" atau scan kode QR untuk download Surat Keterangan Lulus</p>
                </div>
            </div>
            <?php if ($siswa[0]['tunggakan'] == 0) : ?>
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Surat Keterangan Lulus</h5>
                        </div>
                        <div class="card-body">
                            <iframe src="https://drive.google.com/file/d/<?= $siswa[0]['link'] ?>/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
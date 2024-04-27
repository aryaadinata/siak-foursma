<?php

use PhpParser\Node\Stmt\Echo_;
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kunjungan Perpustakaan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- sweet Alert -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <style>
        body {
            -webkit-touch-callout: none;
            /* Untuk iOS */
            -webkit-user-select: none;
            /* Untuk Chrome, Safari, dan Opera */
            -khtml-user-select: none;
            /* Untuk Konqueror */
            -moz-user-select: none;
            /* Untuk Firefox */
            -ms-user-select: none;
            /* Untuk Internet Explorer/Edge */
            user-select: none;
        }

        .table-scrollable {
            max-height: 80px;
            /* Sesuaikan tinggi maksimum sesuai kebutuhan Anda */
            overflow-y: auto;
        }

        .container {
            /* margin-left: 2%;
            margin-right: 2px; */
            max-width: 100%;
        }

        th,
        .tengah {
            text-align: center;
        }

        #preview {
            width: 100%;
            /* Lebar video 100% dari lebar card */
            height: auto;
            /* Sesuaikan tinggi secara otomatis */
            padding-top: 0px;
            padding-bottom: 20px;
        }

        #scan-btn {
            margin-top: 10px;
            /* Berikan jarak atas untuk tombol */
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="<?= base_url() ?>/index3.html" class="navbar-brand">
                    <img src="<?= base_url() ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Perpustakaan Foursma</span>
                </a>


                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Selamat Datang <small>di Perpustakaan Foursma</small></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-primary card-outline">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3"><i class="fa fa-qrcode"></i> SCAN QR</h3>
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item dropdown">
                                            <select class="form-control" id="cameraDropdown"></select>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <video id="preview"></video>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor Anggota</label>
                                        <?= csrf_field(); ?>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" placeholder="Masukkan Nomor Anggota" name="nisn" id="nisn">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info btn-flat kunjungan" id="btnMasuk">Masuk</button>
                                            </span>
                                            <div class="invalid-feedback errorNoAnggota"></div>
                                        </div>
                                    </div>
                                    <p>Perhatian : <code>Jika Scan QR Gagal, Masukkan Nomor Anggota Perpustakaan</code></p>
                                </div>
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-2">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile" style="text-align: center;">
                                    <div style="width: 80%; height: 0; padding-bottom: 80%; position: relative; overflow: hidden; display: inline-block;">
                                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/dist/img/pasfoto/none.jpg" id="profileImage" alt="User profile picture" style="position: absolute; width: 100%; height: 100%; object-fit: cover; display: block; margin: auto;">
                                    </div>
                                    <h3 class="profile-username text-center nama">Nama Pengunjung</h3>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b class="float-left">No Anggota</b>
                                            <a class="float-right nisn"></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b class="float-left">Jam Kunjungan</b>
                                            <a class="float-right jam"></a>
                                        </li>
                                    </ul>
                                    <!-- <button href="#" class="btn btn-primary btn-block" onclick="pengunjung(7475646346)"><b>test</b></button> -->
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Daftar Pengunjung Perpustakaan - <?= date("d/m/Y") ?></h5>
                                </div>
                                <div class="card-body table-responsive p-0 viewdata" style="height: 480px;">
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class=" control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                SMA Negeri 4 Singaraja
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024 | Developed with 💗 by <a href="https://adminlte.io">Arya Adinata</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>
    <script src="<?= base_url() ?>/dist/js/md5.min.js"></script>
    <audio id="scan-success-sound" src="<?= base_url() ?>/sound/scan.mp3"></audio>
    <script src="<?= base_url() ?>/dist/js/instascan.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successSound = document.getElementById('scan-success-sound');
            const cameraDropdown = document.getElementById('cameraDropdown');
            let scanner = null; // Declare scanner globally

            function playScanSuccessSound() {
                successSound.play();
            }

            function handleScan(content) {
                playScanSuccessSound();
                pengunjung(content);
            }

            function startScan(cameras) {
                if (!scanner) {
                    scanner = new Instascan.Scanner({
                        video: document.getElementById('preview')
                    });

                    scanner.addListener('scan', handleScan);
                }

                populateCameraDropdown(cameras);

                const selectedCameraIndex = parseInt(cameraDropdown.value);
                startScanner(cameras[selectedCameraIndex]);
            }

            function populateCameraDropdown(cameras) {
                if (cameraDropdown && cameras) { // Check if cameras is defined
                    cameraDropdown.innerHTML = ''; // Clear existing options

                    cameras.forEach(function(camera, index) {
                        const option = document.createElement('option');
                        option.value = index;
                        option.text = camera.name || `Camera ${index + 1}`;
                        cameraDropdown.appendChild(option);
                    });

                    cameraDropdown.addEventListener('change', function() {
                        const selectedCameraIndex = parseInt(cameraDropdown.value);
                        stopScanner();
                        startScanner(cameras[selectedCameraIndex]);
                    });
                } else {
                    console.error('Camera tidak ditemukan atau tidak tersedia.');
                }
            }

            function startScanner(camera) {
                const video = document.getElementById('preview');
                const cameraId = camera.id ? {
                    exact: camera.id
                } : undefined;

                navigator.mediaDevices.getUserMedia({
                        video: cameraId
                    })
                    .then(function(stream) {
                        video.srcObject = stream;
                        scanner.start(camera);
                    })
                    .catch(function(error) {
                        console.error('Error accessing camera:', error);
                    });
            }

            function stopScanner() {
                if (scanner) {
                    scanner.stop();
                    const video = document.getElementById('preview');
                    const stream = video.srcObject;
                    const tracks = stream.getTracks();

                    tracks.forEach(track => track.stop());
                    video.srcObject = null;
                }
            }

            // Fetch cameras and start the scanner
            Instascan.Camera.getCameras().then(function(cameras) {
                startScan(cameras);
            }).catch(function(e) {
                console.error(e);
                // Handle the error or provide a fallback action
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            datapengunjung();
        });

        function pengunjung(id) {
            $.ajax({
                type: "post",
                url: "<?= site_url('Perpustakaan/ambilpengunjung') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                beforeSend: function() {},
                success: function(response) {
                    console.log('pengunjung function called with id:', id);
                    if (response.jenis == 0) {
                        if (response.data.length > 0) {
                            // Data found
                            inputpengunjung(response.data[0].nisn, response.jenis)
                            Swal.fire({
                                position: 'top',
                                toast: 'false',
                                icon: 'success',
                                title: "Sukses",
                                text: "Selamat Berkunjung di Perpustakaan SMA Negeri 4 Singaraja",
                                showConfirmButton: false,
                                timer: 3000
                            });

                            $('.nama').html(response.data[0].nama);
                            $('.nisn').html(response.data[0].nisn);
                            $('.kelas').html(response.data[0].nama_kelas);
                            $('.jam').html(response.data[0].jam);
                            var fotoSrc = response.data[0].foto ? "<?= base_url() ?>/dist/img/pasfoto/" + response.data[0].foto : "<?= base_url() ?>/dist/img/pasfoto/none.jpg";
                            $('#profileImage').attr('src', fotoSrc);

                            // Menyembunyikan profil setelah 5 detik
                            setTimeout(function() {
                                $('.nama').html("Nama Pengunjung");
                                $('.nisn').html("");
                                $('.kelas').html("");
                                $('.jam').html("");
                                $('#profileImage').attr('src', "<?= base_url() ?>/dist/img/pasfoto/none.jpg");
                            }, 3000); // 3000 milidetik atau 5 detik
                        }
                    } else if (response.jenis == 1) {
                        if (response.data.length > 0) {
                            // Data found
                            inputpengunjung(response.data[0].nik_ptk, response.jenis)
                            Swal.fire({
                                position: 'top',
                                toast: 'false',
                                icon: 'success',
                                title: "Sukses",
                                text: "Selamat Berkunjung di Perpustakaan SMA Negeri 4 Singaraja",
                                showConfirmButton: false,
                                timer: 3000
                            });

                            $('.nama').html(response.data[0].nama_ptk);
                            $('.nisn').html(response.data[0].nik_ptk);
                            $('.jam').html(response.data[0].jam);
                            var fotoSrc = response.data[0].foto ? "<?= base_url() ?>/dist/img/pasfotoptk/" + response.data[0].foto : "<?= base_url() ?>/dist/img/pasfoto/none.jpg";
                            $('#profileImage').attr('src', fotoSrc);

                            // Menyembunyikan profil setelah 5 detik
                            setTimeout(function() {
                                $('.nama').html("Nama Pengunjung");
                                $('.nisn').html("");
                                $('.jam').html("");
                                $('#profileImage').attr('src', "<?= base_url() ?>/dist/img/pasfoto/none.jpg");
                            }, 3000); // 3000 milidetik atau 5 detik
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Peringatan',
                            text: "Data anggota perpustakaan tidak ditemukan",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Status Code: " + xhr.status);
                    console.error("Error Message: " + error);
                }
            });
        }

        function datapengunjung() {
            $.ajax({
                type: "post",
                url: "<?= site_url('Perpustakaan/ambildatapengunjung') ?>",
                dataType: "json",
                beforeSend: function() {
                    $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
                },
                success: function(response) {
                    $('.viewdata').html(response.data);
                },
                error: function(xhr, status, error) {
                    console.error("Status Code: " + xhr.status);
                    console.error("Error Message: " + error);
                }
            });
        }

        function inputpengunjung(id, jenis) {
            $.ajax({
                type: "post",
                url: "<?= site_url('Perpustakaan/inputpengunjung') ?>",
                data: {
                    id: id,
                    jenis: jenis
                },
                dataType: "json",
                success: function(response) {
                    datapengunjung();
                },
                error: function(xhr, status, error) {
                    console.error("Status Code: " + xhr.status);
                    console.error("Error Message: " + error);
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk button "Masuk"
            var btnMasuk = document.getElementById('btnMasuk');
            var inputNisn = document.getElementById('nisn');

            if (btnMasuk) {
                btnMasuk.addEventListener('click', function() {
                    handleMasuk();
                });
            }

            if (inputNisn) {
                // Event listener untuk input NISN
                inputNisn.addEventListener('keydown', function(event) {
                    // Check if the key pressed is Enter (key code 13)
                    if (event.key === 'Enter') {
                        handleMasuk();
                    }
                });
            }

            function handleMasuk() {
                // Mendapatkan nilai dari input nisn
                var nisnValue = inputNisn.value;

                // Validasi form - cek apakah input kosong
                if (!nisnValue.trim()) {
                    // Jika input kosong, tampilkan pesan atau lakukan aksi yang sesuai
                    $("#nisn").addClass("is-invalid");
                    $(".errorNoAnggota").html("Nomor Anggota wajib diisi !");
                    return; // Stop further execution
                } else {
                    $("#nisn").removeClass("is-invalid");
                    $(".errorNoAnggota").html("");
                }

                // Enkripsi NISN dengan MD5
                var encryptedNisn = md5(nisnValue);

                // Memanggil fungsi pengunjung dengan parameter nisn
                pengunjung(encryptedNisn);

                // Menghapus isi input setelah memanggil fungsi pengunjung
                inputNisn.value = '';
            }
        });

        // document.addEventListener("contextmenu", function(e) {
        //     e.preventDefault();
        // });

        // document.addEventListener("keydown", function(e) {
        //     // Check if Ctrl+C is pressed
        //     if (e.ctrlKey && e.shiftKey && e.key === "I") {
        //         e.preventDefault();
        //         alert("Tombol kombinasi dilarang.");
        //         // Atau Anda bisa tidak menampilkan alert dan hanya mencegah default action
        //         // e.preventDefault();
        //     }
        //     if (e.ctrlKey && e.key === "u") {
        //         e.preventDefault();
        //         alert("Tombol kombinasi dilarang.");
        //         // Atau Anda bisa tidak menampilkan alert dan hanya mencegah default action
        //         // e.preventDefault();
        //     }
        //     if (e.ctrlKey && e.key === "c") {
        //         e.preventDefault();
        //         alert("Tombol kombinasi dilarang.");
        //         // Atau Anda bisa tidak menampilkan alert dan hanya mencegah default action
        //         // e.preventDefault();
        //     }
        // });

        // window.addEventListener('beforeunload', function(event) {
        //     // Panggil fungsi lockAccount saat tab atau browser ditutup
        //     alert("Anda terdeteksi keluar aplikasi !");
        // });

        // // Fungsi untuk mendeteksi perubahan tab dan mencegahnya

        // function handleTabChange() {
        //     //lockAccount();
        //     alert("Anda terdeteksi keluar aplikasi !");
        // }

        // window.addEventListener("blur", function() {
        //     alert("Anda terdeteksi keluar aplikasi !");
        // });
    </script> -->
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>SIAK Foursma | Login</title>
    <link rel="icon" href="<?= base_url() ?>/dist/img/favicon.png" type="image/gif">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.css">
    <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Login</b> Siwatma</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sistem Informasi Siswa Terpadu Foursma</p>

                <?php if (!empty(session()->getFlashdata('fail')) && session()->getFlashdata('fail') == "akses") : ?>
                    <script>
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'error',
                            title: 'Akses Ditolak',
                            text: 'Mohon login terlebih dahulu !',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    </script>
                <?php elseif (!empty(session()->getFlashdata('fail')) && session()->getFlashdata('fail') == "gagal") : ?>
                    <script>
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'error',
                            title: 'Gagal Login',
                            text: 'Username atau Password Salah',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    </script>
                <?php endif ?>
                <form action="<?= base_url() ?>/Auth/cek_login" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="<?= set_value("username") ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" value="<?= set_value("password") ?>">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat" onclick="toggle()"><i class="fas fa-eye" id="eye"></i></button>
                                <script>
                                    var state = false;

                                    function toggle() {
                                        if (state) {
                                            document.getElementById("password").setAttribute("type", "password");
                                            document.getElementById("eye").setAttribute("class", "fas fa-eye");
                                            state = false;
                                        } else {
                                            document.getElementById("password").setAttribute("type", "text");
                                            document.getElementById("eye").setAttribute("class", "fas fa-eye-slash");
                                            state = true;
                                        }
                                    }
                                </script>
                            </span>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p class="mb-0 text-center">
                    Developed with ❤️ by <b>Arya Adinata</b>
                </p>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>

</body>

</html>
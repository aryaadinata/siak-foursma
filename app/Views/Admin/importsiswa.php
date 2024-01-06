 <?php
    $session = \Config\Services::session();
    if (!empty($session->getFlashdata('jurusan'))) {
        $classJurusan = "is-invalid";
        $pesanJurusan = $session->getFlashdata('jurusan');
    } else {
        $classJurusan = "";
        $pesanJurusan = "";
    }
    if (!empty($session->getFlashdata('kelas'))) {
        $classKelas = "is-invalid";
        $pesanKelas = $session->getFlashdata('kelas');
    } else {
        $classKelas = "";
        $pesanKelas = "";
    }
    if (!empty($session->getFlashdata('siswa'))) {
        $classSiswa = "is-invalid";
        $pesanSiswa = $session->getFlashdata('siswa');
    } else {
        $classSiswa = "";
        $pesanSiswa = "";
    }
    if (!empty($session->getFlashdata('tingkat'))) {
        $classTingkat = "is-invalid";
        $pesanTingkat = $session->getFlashdata('tingkat');
    } else {
        $classTingkat = "";
        $pesanTingkat = "";
    }
    if (!empty($session->getFlashdata('suksesimport'))) {
        $alert = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                  Import Data Berhasil !
                </div>';
    } else {
        $alert = '';
    }

    ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Data Siswa</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">Data Siswa</li>
                     </ol>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="card">
                         <div class="card-header d-flex p-0">
                             <h3 class="card-title p-3">Import Siswa</h3>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <?= form_open_multipart("Admin/importsiswa", ["class" => "formimport"]) ?>
                             <div class="card-body">
                                 <div class="form-group">
                                     <label>Tingkat</label>
                                     <select class="form-control <?= $classKelas ?>" name="tingkat" id="tingkat">
                                         <option disabled selected>--Pilih Tingkat--</option>
                                         <option value="1">X</option>
                                         <option value="2">XI</option>
                                         <option value="3">XII</option>
                                     </select>
                                     <div class="invalid-feedback"><?= $pesanTingkat ?></div>
                                 </div>
                                 <div class="form-group">
                                     <label>Jurusan</label>
                                     <select class="form-control <?= $classJurusan ?>" name="jurusan" id="jurusan">

                                     </select>
                                     <div class="invalid-feedback"><?= $pesanJurusan ?></div>
                                 </div>
                                 <div class="form-group">
                                     <label>Kelas</label>
                                     <select class="form-control <?= $classKelas ?>" name="kelas" id="kelas">
                                     </select>
                                     <div class="invalid-feedback"><?= $pesanKelas ?></div>
                                 </div>
                                 <div class="form-group ">
                                     <label>Pilih File</label>
                                     <div class="col-sm-8">
                                         <input type="file" name="siswa" id="siswa" class="<?= $classSiswa ?>">
                                         <div class="invalid-feedback"><?= $pesanSiswa ?></div>
                                     </div>
                                 </div>
                                 <?= $alert ?>
                             </div>
                             <!-- /.card-body -->

                             <div class="card-footer">
                                 <a href="/Admin/data_siswa" class="btn btn-default">Kembali</a>
                                 <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                             </div>
                             <?= form_close() ?>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                 </div>
                 <div class="col-lg-6">
                     <div class="alert alert-warning alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian !</h5>
                         Pastikan menggunakan file import yang sesuai
                         <br><br><a href="<?= base_url() ?>/template/import_siswa.xlsx" class="btn btn-sm btn-info">Download Template</a>
                     </div>
                 </div>
             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <script>
     $(document).ready(function() {
         $('#tingkat').change(function() {
             var id = $(this).val();
             $.ajax({
                 type: "POST",
                 url: "<?= base_url('Admin/pilihjurusan') ?>",
                 data: {
                     id_tingkat: id,
                 },
                 dataType: "JSON",
                 success: function(response) {
                     $('#jurusan').html(response);
                 }
             });
         });
     })
     $(document).ready(function() {
         $('#jurusan').change(function() {
             var id = $(this).val();
             $.ajax({
                 type: "POST",
                 url: "<?= base_url('Admin/pilihkelas') ?>",
                 data: {
                     id_jurusan: id,
                     id_tingkat: document.getElementById("tingkat").value
                 },
                 dataType: "JSON",
                 success: function(response) {
                     console.log(response);
                     $('#kelas').html(response);
                 }
             });
         });
     })
 </script>
 <!-- <script>
    $(document).ready(function() {
        $('.formimport').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $(".btnsimpan").attr("disabled", "disable");
                    $(".btnsimpan").html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function() {
                    $(".btnsimpan").removeAttr("disabled");
                    $(".btnsimpan").html("<i class='fa fa-save'></i> Simpan");
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.jurusan) {
                            $("#jurusan").addClass("is-invalid");
                            $(".errorJurusan").html(response.error.jurusan);
                        } else {
                            $("#jurusan").removeClass("is-invalid");
                            $(".errorJurusan").html('');
                        }
                        if (response.error.kelas) {
                            $("#kelas").addClass("is-invalid");
                            $(".errorKelas").html(response.error.kelas);
                        } else {
                            $("#kelas").removeClass("is-invalid");
                            $(".errorKelas").html('');
                        }
                        if (response.error.siswa) {
                            $("#siswa").addClass("is-invalid");
                            $(".errorSiswa").html(response.error.siswa);
                        } else {
                            $("#siswa").removeClass("is-invalid");
                            $(".errorSiswa").html('');
                        }
                    } else {                        
                        Swal.fire({
                            position: 'top',
                            toast: 'true',
                            icon: 'success',
                            title: 'Sukses',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        //datasiswa();
                    }
                },
                error: function(xhr, ajaxOption, trhownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
                }
            });
            return false;
        });
    });
</script> -->
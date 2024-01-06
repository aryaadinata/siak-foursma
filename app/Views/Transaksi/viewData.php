 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0"><?= $title ?></h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="/Admin">Dashboard</a></li>
             <li class="breadcrumb-item active"><?= $title ?></li>
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
         <div class="col-lg-12">
           <div class="card">
             <div class="card-header d-flex p-0">
               <h3 class="card-title p-3">Tabel <?= $title ?></h3>
               <ul class="nav nav-pills ml-auto p-2">
                 <li class="nav-item btn-primary"><a href="" class="nav-link tomboltambah" style="color:aliceblue"><i class="fas fa-plus"></i> Tambah</a></li>
               </ul>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <p class="card-text viewdata">

               </p>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
       </div>
       <!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <div class="viewmodal" style="display: none;"></div>
 <!-- <div class="viewmodaledit" style="display: none;"></div> -->

 <?php if ($title == "Tagihan") : ?>
   <script>
     function datatagihan() {
       $.ajax({
         url: "<?= site_url('Transaksi/ambiltagihan') ?>",
         dataType: "json",
         beforeSend: function() {
           $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
         },
         success: function(response) {
           $('.viewdata').html(response.data);
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       });
     }
     $(document).ready(function() {
       datatagihan();
       $('.tomboltambah').click(function(e) {
         e.preventDefault();
         $.ajax({
           url: "<?= site_url('Admin/formtambahtagihan') ?>",
           dataType: "json",
           beforeSend: function() {
             $(".tomboltambah").html('<i class="fas fa-spin fa-spinner"></i> Loading...</a>');
           },
           success: function(response) {
             $(".tomboltambah").html('<i class="fas fa-plius"></i> Tambah</a>');
             $('.viewmodal').html(response.data).show();
             $('#modaltambahtagihan').modal('show');
           }

         });
       })
     })

     function edit(id_jurusan) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/formeditjurusan') ?>",
         data: {
           id_jurusan: id_jurusan
         },
         dataType: "json",
         success: function(response) {
           if (response.data) {
             $('.viewmodal').html(response.data).show();
             $('#modaleditjurusan').modal('show');
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })
     }

     function hapus(id_jurusan) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/cekhapusjurusan') ?>",
         data: {
           id_jurusan: id_jurusan
         },
         dataType: "json",
         success: function(response) {
           if (response.error) {
             if (response.error.id_jurusan) {
               Swal.fire({
                 icon: 'error',
                 title: 'Peringatan',
                 text: response.error.id_jurusan,
                 showConfirmButton: true,
               });
             }
           } else {
             Swal.fire({
               title: `Yakin Hapus Jurusan Ini ?`,
               text: 'Jurusan yang terhapus tidak dapat dikembalikan !',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal',
             }).then((result) => {
               if (result.isConfirmed) {
                 $.ajax({
                   type: "post",
                   url: "<?= site_url('Admin/hapusjurusan') ?>",
                   data: {
                     id_jurusan: id_jurusan
                   },
                   dataType: "json",
                   success: function(response) {
                     if (response.sukses) {
                       Swal.fire({
                         position: 'top',
                         toast: 'false',
                         icon: 'success',
                         title: response.sukses,
                         showConfirmButton: false,
                         timer: 3000
                       });
                       datajurusan();
                     }
                   },
                   error: function(xhr, ajaxOption, trhownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
                   }
                 })
               }
             })
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })

     }
   </script>
 <?php elseif ($title == "Kelas") : ?>
   <script>
     function datakelas() {
       $.ajax({
         url: "<?= site_url('Admin/ambilkelas') ?>",
         dataType: "json",
         beforeSend: function() {
           $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
         },
         success: function(response) {
           $('.viewdata').html(response.data);
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       });
     }
     $(document).ready(function() {
       datakelas();

       $('.tomboltambah').click(function(e) {
         e.preventDefault();
         $.ajax({
           url: "<?= site_url('Admin/formtambahkelas') ?>",
           dataType: "json",
           success: function(response) {
             $('.viewmodal').html(response.data).show();
             $('#modaltambahkelas').modal('show');
           }

         });
       })
     })

     function edit(id_kelas) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/formeditkelas') ?>",
         data: {
           id_kelas: id_kelas
         },
         dataType: "json",
         success: function(response) {
           if (response.data) {
             $('.viewmodal').html(response.data).show();
             $('#modaleditkelas').modal('show');
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })
     }

     function siswa(id_kelas) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/modalsiswa') ?>",
         data: {
           id_kelas: id_kelas
         },
         dataType: "json",
         success: function(response) {
           if (response.data) {
             console.log(id_kelas)
             $('.viewmodal').html(response.data).show();
             $('#modalsiswa').modal('show');
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })
     }

     function hapus(id_kelas) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/cekhapuskelas') ?>",
         data: {
           id_kelas: id_kelas
         },
         dataType: "json",
         success: function(response) {
           if (response.error) {
             if (response.error.id_kelas) {
               Swal.fire({
                 icon: 'error',
                 title: 'Peringatan',
                 text: response.error.id_kelas,
                 showConfirmButton: true,
               });
             }
           } else {
             Swal.fire({
               title: `Yakin Hapus Kelas Ini ?`,
               text: 'Kelas yang terhapus tidak dapat dikembalikan !',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal',
             }).then((result) => {
               if (result.isConfirmed) {
                 $.ajax({
                   type: "post",
                   url: "<?= site_url('Admin/hapuskelas') ?>",
                   data: {
                     id_kelas: id_kelas
                   },
                   dataType: "json",
                   success: function(response) {
                     if (response.sukses) {
                       Swal.fire({
                         position: 'top',
                         toast: 'false',
                         icon: 'success',
                         title: response.sukses,
                         showConfirmButton: false,
                         timer: 3000
                       });
                       datakelas();
                     }
                   },
                   error: function(xhr, ajaxOption, trhownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
                   }
                 })
               }
             })
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })

     }
   </script>
 <?php elseif ($title == "Tahun Ajaran") : ?>
   <script>
     function datatahun() {
       $.ajax({
         url: "<?= site_url('Admin/ambiltahun') ?>",
         dataType: "json",
         beforeSend: function() {
           $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
         },
         success: function(response) {
           $('.viewdata').html(response.data);
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       });
     }
     $(document).ready(function() {
       datatahun();

       $('.tomboltambah').click(function(e) {
         e.preventDefault();
         $.ajax({
           url: "<?= site_url('Admin/formtambahtahun') ?>",
           dataType: "json",
           success: function(response) {
             $('.viewmodal').html(response.data).show();
             $('#modaltambahtahun').modal('show');
           }

         });
       })
     })

     function edit(id_tahun) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/formedittahun') ?>",
         data: {
           id_tahun: id_tahun
         },
         dataType: "json",
         success: function(response) {
           if (response.data) {
             $('.viewmodal').html(response.data).show();
             $('#modaledittahun').modal('show');
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })
     }

     function hapus(id_tahun) {
       $.ajax({
         type: "post",
         url: "<?= site_url('Admin/cekhapustahun') ?>",
         data: {
           id_tahun: id_tahun
         },
         dataType: "json",
         success: function(response) {
           if (response.error) {
             if (response.error.id_tahun) {
               Swal.fire({
                 icon: 'error',
                 title: 'Peringatan',
                 text: response.error.id_tahun,
                 showConfirmButton: true,
               });
             }
           } else {
             Swal.fire({
               title: `Yakin Hapus Tahun Ajaran Ini ?`,
               text: 'Tahun Ajaran yang terhapus tidak dapat dikembalikan !',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal',
             }).then((result) => {
               if (result.isConfirmed) {
                 $.ajax({
                   type: "post",
                   url: "<?= site_url('Admin/hapustahun') ?>",
                   data: {
                     id_tahun: id_tahun
                   },
                   dataType: "json",
                   success: function(response) {
                     if (response.sukses) {
                       Swal.fire({
                         position: 'top',
                         toast: 'false',
                         icon: 'success',
                         title: response.sukses,
                         showConfirmButton: false,
                         timer: 3000
                       });
                       datatahun();
                     }
                   },
                   error: function(xhr, ajaxOption, trhownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
                   }
                 })
               }
             })
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       })

     }
   </script>
 <?php endif ?>
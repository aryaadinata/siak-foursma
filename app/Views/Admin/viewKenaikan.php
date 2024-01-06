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
         <div class="col-md-5">
           <div class="card">
             <div class="card-header d-flex p-0">
               <h3 class="card-title p-3">Rombel</h3>
               <ul class="nav nav-pills ml-auto p-2">
                 <li class="nav-item dropdown">
                   <select class="form-control" id="kelas1">
                     <option value="" disabled selected>--Pilih Rombel--</option>
                     <?php foreach ($kelasasal as $row) : ?>
                       <option value="<?= $row['id_kelas'] ?>"><?= $row["nama_kelas"]; ?></option>
                     <?php endforeach ?>
                   </select>
                 </li>
               </ul>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <p class="card-text viewdata1">
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <div class="col-md-2">
           <div class="card">
             <div class="card-header text-center"> <!-- Tambahkan kelas text-center di sini -->
               <h3 class="card-title">Proses</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body row">
               <div class="col-md-12">
                 <button type="button" class="btn btn-danger btn-block btnnaik">Keluarkan <i class="fa fa-arrow-right"></i></button>
                 <button type="button" class="btn btn-primary btn-block btnkembali"><i class="fa fa-arrow-left"></i> Masukkan</button>
               </div>
               <!-- <div class="col-md-2">
               </div> -->
               <!-- /.card-body -->
             </div>
             <!-- /.card -->
           </div>
         </div>
         <!-- /.col (left) -->
         <div class="col-md-5">
           <div class="card">
             <div class="card-header d-flex p-0">
               <h3 class="card-title p-3">Data Siswa</h3>
               <!-- <ul class="nav nav-pills ml-auto p-2">
                 <li class="nav-item dropdown">
                   <select class="form-control" id="kelas2">
                     <option value="" disabled selected>--Pilih Kelas--</option>
                   </select>
                 </li>
               </ul> -->
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <p class="card-text viewdata2">
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col (right) -->
       </div>
       <!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <div class="viewmodal" style="display: none;"></div>
 <!-- <div class="viewmodaledit" style="display: none;"></div> -->

 <script>
   $(document).ready(function() {
     $('#kelas1').change(function() {
       var id = $(this).val();
       datasiswa1(id)
       $.ajax({
         type: "POST",
         url: "<?= base_url('Admin/kelastujuan') ?>",
         data: {
           id_kelas: id
         },
         dataType: "JSON",
         success: function(response) {
           $('#kelas2').html(response);
         }
       });
     });
   })

   $(document).ready(function() {
     datasiswa2();
   })

   function datasiswa1(id) {
     $.ajax({
       url: "<?= site_url('Admin/ambildata1') ?>",
       type: "POST",
       data: {
         id_kelas: id
       },
       dataType: "json",
       beforeSend: function() {
         $(".viewdata1").html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
       },
       success: function(response) {
         $('.viewdata1').html(response.data);
       }
     });
   }

   function datasiswa2() {
     $.ajax({
       url: "<?= site_url('Admin/ambildata2') ?>",
       type: "POST",
       //  data: {
       //    id_kelas: id
       //  },
       dataType: "json",
       beforeSend: function() {
         $(".viewdata2").html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
       },
       success: function(response) {
         $('.viewdata2').html(response.data);
       }
     });
   }

   $(document).ready(function() {
     $('.btnnaik').click(function() {
       var naikkelas = [];
       $('.checkItem1').each(function() {
         if ($(this).is(":checked")) {
           naikkelas.push($(this).val());
         }
       });
       $.ajax({
         url: "<?= site_url('Admin/naikkan') ?>",
         type: "POST",
         data: {
           naikkelas: naikkelas,
           //id_tujuan: document.getElementById("kelas2").value
         },
         dataType: "json",
         beforeSend: function() {
           $(".btnnaik").attr("disabled", "disable");
           $(".btnnaik").html('<i class="fas fa-spin fa-spinner"></i> Loading...');
         },
         success: function(response) {
           $(".btnnaik").removeAttr("disabled");
           $(".btnnaik").html('Keluarkan <i class="fa fa-arrow-right"></i>');
           if (response.error) {
             if (response.error.siswa) {
               Swal.fire({
                 position: 'top',
                 toast: 'false',
                 icon: 'warning',
                 title: 'Peringatan',
                 text: response.error.siswa,
                 showConfirmButton: false,
                 timer: 3000
               });
             }
           } else {
             Swal.fire({
               position: 'top',
               toast: 'false',
               icon: 'success',
               title: 'Sukses',
               text: response.sukses,
               showConfirmButton: false,
               timer: 3000
             });
             datasiswa1(document.getElementById("kelas1").value);
             datasiswa2();
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       });
     });
   })

   $(document).ready(function() {
     $('.btnkembali').click(function() {
       var naikkelas = [];
       $('.checkItem2').each(function() {
         if ($(this).is(":checked")) {
           naikkelas.push($(this).val());
         }
       });
       $.ajax({
         url: "<?= site_url('Admin/kembalikan') ?>",
         type: "POST",
         data: {
           naikkelas: naikkelas,
           id_asal: document.getElementById("kelas1").value
         },
         dataType: "json",
         beforeSend: function() {
           $(".btnkembali").attr("disabled", "disable");
           $(".btnkembali").html('<i class="fas fa-spin fa-spinner"></i> Loading...');
         },
         success: function(response) {
           $(".btnkembali").removeAttr("disabled");
           $(".btnkembali").html('<i class="fa fa-arrow-left"></i> Masukkan');
           if (response.error) {
             if (response.error.asal) {
               Swal.fire({
                 position: 'top',
                 toast: 'false',
                 icon: 'warning',
                 title: 'Peringatan',
                 text: response.error.asal,
                 showConfirmButton: false,
                 timer: 3000
               });
             } else if (response.error.siswa) {
               Swal.fire({
                 position: 'top',
                 toast: 'false',
                 icon: 'warning',
                 title: 'Peringatan',
                 text: response.error.siswa,
                 showConfirmButton: false,
                 timer: 3000
               });
             }
           } else {
             Swal.fire({
               position: 'top',
               toast: 'false',
               icon: 'success',
               title: 'Sukses',
               text: response.sukses,
               showConfirmButton: false,
               timer: 3000
             });
             datasiswa1(document.getElementById("kelas1").value);
             datasiswa2();
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       });
     });
   })
 </script>
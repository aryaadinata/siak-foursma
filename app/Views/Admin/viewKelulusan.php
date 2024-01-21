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
         <div class="col-md-12">
           <div class="card">
             <div class="card-header d-flex p-0">
               <h3 class="card-title p-3">Kelas</h3>
               <ul class="nav nav-pills ml-auto p-2">
                 <li class="nav-item dropdown">
                   <select class="form-control" id="kelas1">
                     <option disabled selected value="">--Pilih Kelas--</option>
                     <?php foreach ($kelasasal as $row) : ?>
                       <option value="<?= $row['id_kelas'] ?>"><?= $row["nama_kelas"]; ?></option>
                     <?php endforeach ?>
                   </select>
                 </li>
                 <li class="nav-item dropdown">
                   <button type="button" class="btn btn-flat btn-primary btn-block btnlulus">Luluskan</button>
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
         <!-- /.col (left) -->
         <div class="col-md-12">
           <div class="card">
             <div class="card-header d-flex p-0">
               <h3 class="card-title p-3">Data Siswa Lulus</h3>
               <ul class="nav nav-pills ml-auto p-2">
                 <li class="nav-item dropdown">
                   <select class="form-control" id="tahun">
                     <option disabled selected value="">--Pilih Tahun--</option>
                     <?php foreach ($tahun as $row) : ?>
                       <option value="<?= $row['tahun_akhir'] ?>"><?= $row['tahun_akhir'] ?></option>
                     <?php endforeach ?>
                   </select>
                 </li>
                 <li class="nav-item dropdown">
                   <button type="button" class="btn btn-flat btn-danger btn-block btnkembali">Batal Lulus</button>
                 </li>
               </ul>
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
     });
   })

   $(document).ready(function() {
     $('#tahun').change(function() {
       var id = $(this).val();
       datasiswa2(id);
     });
   });

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

   function datasiswa2(id) {
     $.ajax({
       url: "<?= site_url('Admin/ambildatalulus') ?>",
       type: "POST",
       data: {
         id_tahun: id,
       },
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
     $('.btnlulus').click(function() {
       var naikkelas = [];
       $('.checkItem1').each(function() {
         if ($(this).is(":checked")) {
           naikkelas.push($(this).val());
         }
       });
       $.ajax({
         url: "<?= site_url('Admin/luluskan') ?>",
         type: "POST",
         data: {
           naikkelas: naikkelas,
           id_tahun: document.getElementById("tahun").value,
         },
         dataType: "json",
         beforeSend: function() {

         },
         success: function(response) {
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
             } else if (response.error.tahun) {
               Swal.fire({
                 position: 'top',
                 toast: 'false',
                 icon: 'error',
                 title: 'Gagal',
                 text: response.error.tahun,
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
             datasiswa2(document.getElementById("tahun").value);
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
         url: "<?= site_url('Admin/batallulus') ?>",
         type: "POST",
         data: {
           naikkelas: naikkelas,
         },
         dataType: "json",
         beforeSend: function() {

         },
         success: function(response) {
           if (response.error) {
             if (response.error.tujuan) {
               Swal.fire({
                 position: 'top',
                 toast: 'false',
                 icon: 'warning',
                 title: 'Peringatan',
                 text: response.error.tujuan,
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
             if (document.getElementById("kelas1").value != '') {
               datasiswa1(document.getElementById("kelas1").value);
             }
             datasiswa2(document.getElementById("tahun").value);
           }
         },
         error: function(xhr, ajaxOption, trhownError) {
           alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
         }
       });
     });
   })
 </script>
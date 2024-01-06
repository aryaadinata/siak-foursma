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
     <!-- ./col -->
     <div class="card card-default">
       <div class="card-header d-flex p-0">
         <h3 class="card-title p-3"> Filter Data</h3>
       </div>
       <!-- /.card-header -->
       <div class="card-body">
         <div class="row">
           <div class="col-md-4">
             <div class="form-group">
               <label>Tingkat</label>
               <select class="form-control" id="tingkat1">
                 <option value="0">--Semua Tingkat--</option>
                 <option value="1">X</option>
                 <option value="2">XI</option>
                 <option value="3">XII</option>
               </select>
             </div>
           </div>
           <!-- /.form-group -->
           <div class="col-md-4">
             <div class="form-group">
               <label>Jurusan</label>
               <select class="form-control" id="jurusan1">
                 <option value="0">--Semua Jurusan--</option>
               </select>
             </div>
           </div>
           <!-- /.form-group -->
           <!-- /.col -->
           <div class="col-md-4">
             <div class="form-group">
               <label>Kelas</label>
               <select class="form-control" id="kelas1">
                 <option value="0">--Semua Kelas--</option>
               </select>
             </div>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.card-body -->

       <!-- /.row -->
       <div class="row viewdata">

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
     $('#tingkat1').change(function() {
       var id_tingkat = $(this).val();
       $.ajax({
         type: "POST",
         url: "<?= base_url('Admin/pilihjurusan') ?>",
         data: {
           id_tingkat: id_tingkat,
         },
         dataType: "JSON",
         success: function(response) {
           //console.log(response);
           $('#jurusan1').html(response);
         }
       });
       datasiswa(id_tingkat, document.getElementById("jurusan1").value, document.getElementById("kelas1").value);
     });
   })
   $(document).ready(function() {
     $('#jurusan1').change(function() {
       var id = $(this).val();
       $.ajax({
         type: "POST",
         url: "<?= base_url('Admin/pilihkelas') ?>",
         data: {
           id_jurusan: id,
           id_tingkat: document.getElementById("tingkat1").value
         },
         dataType: "JSON",
         success: function(response) {
           //console.log(response);
           $('#kelas1').html(response);
         }
       });
       datasiswa(id_tingkat, id_jurusan, document.getElementById("kelas1").value);
     });
   })
   $(document).ready(function() {
     $('#kelas1').change(function() {
       var id_kelas = $(this).val();
       datasiswa(document.getElementById("tingkat1").value, document.getElementById("jurusan1").value, id_kelas);
     });
     datasiswa(document.getElementById("tingkat1").value, document.getElementById("jurusan1").value, document.getElementById("kelas1").value);
   })
 </script>

 <script>
   function datasiswa(id_tingkat, id_jurusan, id_kelas) {
     $.ajax({
       url: "<?= site_url('Admin/ambildata') ?>",
       type: "POST",
       data: {
         id_tingkat: id_tingkat,
         id_jurusan: id_jurusan,
         id_kelas: id_kelas,
       },
       dataType: "json",
       beforeSend: function() {
         $(".loadtable").html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
       },
       success: function(response) {
         $('.viewdata').html(response.data);
       }

     });
   }

   function detail(nisn) {
     $.ajax({
       type: "post",
       url: "<?= site_url('Admin/formedit') ?>",
       data: {
         nisn: nisn
       },
       dataType: "json",
       success: function(response) {
         if (response.data) {
           $('.viewmodal').html(response.data).show();
           $('#modaledit').modal('show');
         }
       },
       error: function(xhr, ajaxOption, trhownError) {
         alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
       }
     })
   }

   function hapus(nisn) {
     Swal.fire({
       title: `Yakin Hapus ${nisn} ?`,
       text: 'Data yang terhapus tidak dapat dikembalikan !',
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
           url: "<?= site_url('Admin/hapussiswa') ?>",
           data: {
             nisn: nisn
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
               datasiswa(document.getElementById("kelas1").value);
             }
           },
           error: function(xhr, ajaxOption, trhownError) {
             alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
           }
         })
       }
     })
   }
 </script>
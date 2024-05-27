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
                 <li class="nav-item btn-info"><a href="<?= base_url('Admin/viewimport') ?>" class="nav-link" style="color:aliceblue"><i class="fas fa-file-import"></i> Import</a></li>
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
 </div>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <div class="viewmodal" style="display: none;"></div>
 <!-- <div class="viewmodaledit" style="display: none;"></div> -->

 <script>
   function datasiswa() {
     $.ajax({
       url: "<?= site_url('Admin/ambildata') ?>",
       type: "POST",
       dataType: "json",
       beforeSend: function() {
         $(".viewdata").html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
       },
       success: function(response) {
         $('.viewdata').html(response.data);
       }
     });
   }

   $(document).ready(function() {
     datasiswa();
   })


   function detail(nis) {
     $.ajax({
       type: "post",
       url: "<?= site_url('Admin/ambilbiodata') ?>",
       data: {
         nis: nis
       },
       dataType: "json",
       beforeSend: function() {
         $(".tomboledit").removeClass("bg-gray").addClass("bg-pink");
         $(".tomboledit").removeAttr("disabled");
         $(".tomboledit").attr("onclick", "edit(" + nis + ")");
         $(".tomboledit").html("<i class='fa fa-pencil-alt'></i> Edit Biodata");
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

   function edit(nin) {
     $.ajax({
       type: "post",
       url: "<?= site_url('Admin/formeditbiodata') ?>",
       data: {
         nis: nis
       },
       dataType: "json",
       success: function(response) {
         if (response.data) {
           $('.viewdata').html(response.data);
         }
       },
       complete: function() {
         $(".tomboledit").removeClass("bg-pink").addClass("bg-gray");
         $(".tomboledit").attr("onclick", "detail(" + nis + ")");
         $(".tomboledit").html("<i class='fa fa-ban'></i> Batal Edit");
       },
       error: function(xhr, ajaxOption, trhownError) {
         alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
       }
     })
   }

   function hapus(nis) {
     Swal.fire({
       title: `Yakin Hapus Siswa dengan NIS ${nis} ?`,
       text: 'Seluruh data yang berkaitan dengan siswa tersebut akan hilang, data yang terhapus tidak dapat dikembalikan !',
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
             nis: nis
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
               datasiswa();
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
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
     <div class="row viewdata"></div>

   </div><!-- /.container-fluid -->
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
         $(".loadtable").html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
       },
       success: function(response) {
         $('.viewdata').html(response.data);
       }
     });
   }

   $(document).ready(function() {
     datasiswa();
   })


   function detail(nisn) {
     $.ajax({
       type: "post",
       url: "<?= site_url('Admin/ambilbiodata') ?>",
       data: {
         nisn: nisn
       },
       dataType: "json",
       beforeSend: function() {
         $(".tomboledit").removeClass("bg-gray").addClass("bg-pink");
         $(".tomboledit").removeAttr("disabled");
         $(".tomboledit").attr("onclick", "edit(" + nisn + ")");
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

   function edit(nisn) {
     $.ajax({
       type: "post",
       url: "<?= site_url('Admin/formeditbiodata') ?>",
       data: {
         nisn: nisn
       },
       dataType: "json",
       success: function(response) {
         if (response.data) {
           $('.viewdata').html(response.data);
         }
       },
       complete: function() {
         $(".tomboledit").removeClass("bg-pink").addClass("bg-gray");
         $(".tomboledit").attr("onclick", "detail(" + nisn + ")");
         $(".tomboledit").html("<i class='fa fa-ban'></i> Batal Edit");
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
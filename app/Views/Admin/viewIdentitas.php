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
            <li class="breadcrumb-item"><a href="/Dashboard">Dashboard</a></li>
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
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header d-flex p-0">
            <h3 class="card-title p-3"><i class="fas fa-user" style="color: #1b3e72;"></i> Identitas Sekolah</h3>
            <ul class="nav nav-pills ml-auto p-2">
              <li class="nav-item"><button class="nav-link btn btn-flat bg-pink tomboledit" onclick="detail('<?= $sekolah['npsn'] ?>')"><i class=" fas fa-pencil-alt"></i> Edit sekolah</button></li>
            </ul>
          </div>
          <!-- /.card-header -->
          <p class="viewdata">
          </p>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  function identitassekolah(nisn) {
    $.ajax({
      type: "post",
      url: "<?= site_url('Admin/ambilidentitas') ?>",
      dataType: "json",
      beforeSend: function() {
        $(".tomboledit").removeClass("bg-gray").addClass("bg-pink");
        $(".tomboledit").removeAttr("disabled");
        $(".tomboledit").attr("onclick", "edit(" + nisn + ")");
        $(".tomboledit").html("<i class='fa fa-pencil-alt'></i> Edit Sekolah");
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

  $(document).ready(function() {
    identitassekolah();
  })

  function edit() {
    $.ajax({
      type: "post",
      url: "<?= site_url('Admin/formeditidentitas') ?>",
      dataType: "json",
      beforeSend: function() {
        $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
      },
      success: function(response) {
        if (response.data) {
          $('.viewdata').html(response.data);
        }
      },
      complete: function() {
        $(".tomboledit").removeClass("bg-pink").addClass("bg-gray");
        $(".tomboledit").attr("onclick", "identitassekolah()");
        $(".tomboledit").html("<i class='fa fa-ban'></i> Batal Edit");
      },
      error: function(xhr, ajaxOption, trhownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
      }
    })
  }
</script>
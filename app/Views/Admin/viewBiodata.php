<?php
$session = \Config\Services::session();
if (!empty($session->getFlashdata('foto'))) {
  $classFoto = "is-invalid";
  $pesanFoto = $session->getFlashdata('foto');
} else {
  $classFoto = "";
  $pesanFoto = "";
}
if (!empty($session->getFlashdata('suksesupload'))) {
  $alert = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                  Upload Foto Berhasil !
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
          <h1 class="m-0"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/Admin">Biodata</a></li>
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
      <div class="col-md-9">
        <div class="card card-default">
          <div class="card-header d-flex p-0">
            <h3 class="card-title p-3"><i class="fas fa-user" style="color: #1b3e72;"></i> Biodata Siswa</h3>
            <ul class="nav nav-pills ml-auto p-2">
              <li class="nav-item"><a href="<?= base_url() . "/Admin/data_siswa" ?>" id="btnKembali" class="btn btn-flat nav-link bg-gray"><i class=" fas fa-arrow-left"></i> Kembali</a></li>
              <li class="nav-item"><a href="#" class="nav-link btn btn-flat bg-pink tomboledit" onclick="edit('<?= $siswa['nis'] ?>')"><i class=" fas fa-pencil-alt"></i> Edit Biodata</a></li>
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

      <div class="col-md-3">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-image" style="color: #1b3e72;"></i>
              Pas Foto
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="text-center">
              <?php if ($siswa["foto"] != "") : ?>
                <img class="rounded img-fluid" src="../../dist/img/pasfoto/<?= $siswa["foto"]; ?>" alt="Photo" height="320" width="160">
              <?php else : ?>
                <img class="rounded img-fluid" src="../../dist/img/pasfoto/none.jpg" alt="Photo" height="320" width="160">
              <?php endif ?>
            </div>
            <p></p>
            <?= form_open_multipart("Admin/uploadfoto", ["class" => "formimport"]) ?>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input <?= $classFoto ?>" id="foto" name="foto">
                <input type="hidden" name="nis" id="nis" value="<?= $siswa["nis"] ?>">
                <label class="custom-file-label" for="customFile">Pilih Foto</label>
                <div class="invalid-feedback"><?= $pesanFoto ?></div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <!-- /card-footer -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info float-right">Simpan</button>
          </div>
          <?= form_close() ?>
          <!-- /.card-footer -->
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
  function biodatasiswa(nis) {
    $.ajax({
      type: "post",
      url: "<?= site_url('Admin/ambilbiodata/') ?><?= $siswa["nis"] ?>",
      dataType: "json",
      beforeSend: function() {
        $(".tomboledit").removeClass("bg-gray").addClass("bg-pink");
        $(".tomboledit").removeAttr("disabled");
        $(".tomboledit").attr("onclick", "edit('<?= $siswa['nis'] ?>')");
        $(".tomboledit").html("<i class='fa fa-pencil-alt'></i> Edit Biodata");
        $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
      },
      success: function(response) {
        $('.viewdata').html(response.data);
        $("#btnKembali").show();
      },
      error: function(xhr, status, error) {
        console.error("Status Code: " + xhr.status);
        console.error("Error Message: " + error);
      }
    });
  }

  $(document).ready(function() {
    biodatasiswa();
  })

  function edit(nis) {
    $.ajax({
      type: "post",
      url: "<?= site_url('Admin/formeditbiodata') ?>",
      data: {
        nis: nis
      },
      dataType: "json",
      beforeSend: function() {
        $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
      },
      success: function(response) {
        if (response.data) {
          $('.viewdata').html(response.data);
        }
        $("#btnKembali").hide();
      },
      complete: function() {
        $(".tomboledit").removeClass("bg-pink").addClass("bg-gray");
        $(".tomboledit").attr("onclick", "biodatasiswa()");
        $(".tomboledit").html("<i class='fa fa-ban'></i> Batal Edit");        
      },
      error: function(xhr, ajaxOption, trhownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
      }
    })
  }
</script>
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
            <li class="breadcrumb-item"><a href="/<?php if ($title == "Data Guru") echo "dataguru";
                                                  else echo "datapegawai"; ?>"><?= $title ?></a></li>
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
            <h3 class="card-title p-3 judulcard"><i class="fas fa-user" style="color: #1b3e72;"></i> Identitas Pendidik dan Tenaga Kependidikan</h3>
            <ul class="nav nav-pills ml-auto p-2">
              <li class="nav-item"><a href="<?php if ($title == "Detail Guru") echo base_url() . "/dataguru";
                                            else echo base_url() . "/datapegawai"; ?>" id="btnKembali" class="btn btn-flat nav-link bg-gray"><i class=" fas fa-arrow-left"></i> Kembali</a></li>
              <li class="nav-item"><a href="#" class="nav-link btn btn-flat bg-pink tomboledit" onclick="edit('<?php echo $ptk['nik_ptk'] ?>')"><i class=" fas fa-pencil-alt"></i> Edit PTK</a></li>
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
              <?php if ($ptk["foto"] != "") : ?>
                <img class="rounded img-fluid" src="../../dist/img/pasfotoptk/<?= $ptk["foto"]; ?>" alt="Photo" height="320" width="160">
              <?php else : ?>
                <img class="rounded img-fluid" src="../../dist/img/pasfotoptk/none.jpg" alt="Photo" height="320" width="160">
              <?php endif ?>
            </div>
            <p></p>
            <?= form_open_multipart("Ptk/uploadfoto", ["class" => "formimport"]) ?>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input <?= $classFoto ?>" id="foto" name="foto">
                <input type="hidden" name="nik_ptk" value="<?= $ptk["nik_ptk"] ?>">
                <input type="hidden" name="jenis_ptk" value="<?= $ptk["jenis_ptk"] ?>">
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
  function detailptk() {
    $.ajax({
      type: "post",
      url: "<?= site_url('Ptk/ambildetailptk/') ?><?= $ptk["nik_ptk"] ?>",
      dataType: "json",
      beforeSend: function() {
        $(".tomboledit").removeClass("bg-gray").addClass("bg-pink");
        $(".tomboledit").removeAttr("disabled");
        $(".tomboledit").attr("onclick", "edit(" + <?= $ptk["nik_ptk"] ?> + ")");
        $(".tomboledit").html("<i class='fa fa-pencil-alt'></i> Edit PTK");
        $('.viewdata').html('<div class="overlay"><h3><i class="fa fa-spin fa-spinner"></i> Loading...</h3></div>');
      },
      success: function(response) {
        $('.judulcard').html('<i class="fas fa-user" style="color: #1b3e72;"></i> Identitas Pendidik dan Tenaga Kependidikan');
        $("#btnKembali").show();
        $('.viewdata').html(response.data);
      },
      error: function(xhr, status, error) {
        calert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
      }
    });
  }

  $(document).ready(function() {
    detailptk();
  })

  function edit(nik) {
    $.ajax({
      type: "post",
      url: "<?= site_url('Ptk/formeditptk') ?>",
      data: {
        nik: nik
      },
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
        $('.judulcard').html('<i class="fas fa-pencil-alt" style="color: #1b3e72;"></i> Edit Identitas Guru');
        $("#btnKembali").hide();
        $(".tomboledit").removeClass("bg-pink").addClass("bg-gray");
        $(".tomboledit").attr("onclick", "detailptk()");
        $(".tomboledit").html("<i class='fa fa-ban'></i> Batal Edit");
      },
      error: function(xhr, ajaxOption, trhownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
      }
    })
  }
</script>
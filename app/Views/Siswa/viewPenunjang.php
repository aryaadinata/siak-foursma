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
            <li class="breadcrumb-item"><a href="/Siswa">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content viewdata">
    <!-- ./col -->

  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="viewmodal" style="display: none;"></div>
<!-- <div class="viewmodaledit" style="display: none;"></div> -->

<?php if ($title == "Prestasi") : ?>
  <script>
    function prestasi() {
      $.ajax({
        type: "post",
        url: "<?= site_url('Penunjang/ambilprestasi') ?>",
        dataType: "json",
        success: function(response) {
          $('.viewdata').html(response.data);
        },
        error: function(xhr, ajaxOption, trhownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
        }
      });
    }

    $(document).ready(function() {
      prestasi();
    })
  </script>
<?php elseif ($title == "Pelanggaran") : ?>
  <script>
    function pelanggaran() {
      $.ajax({
        type: "post",
        url: "<?= site_url('Penunjang/ambilpelanggaran') ?>",
        dataType: "json",
        success: function(response) {
          $('.viewdata').html(response.data);
        },
        error: function(xhr, ajaxOption, trhownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
        }
      });
    }

    $(document).ready(function() {
      pelanggaran();
    })
  </script>
<?php endif ?>
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
  <div class="content">
    <!-- ./col -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header d-flex p-0">
            <h3 class="card-title p-3"><i class="fas fa-users" style="color: #1b3e72;"></i> Data Keluarga</h3>
            <ul class="nav nav-pills ml-auto p-2">
              <a href="#" class="nav-link btn btn-flat btntambahkeluarga bg-info"><i class=" fas fa-plus"></i> Tambah Keluarga</a>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="viewdata">
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.col -->
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="viewmodal" style="display: none;"></div>
<!-- <div class="viewmodaledit" style="display: none;"></div> -->

<script>
  function keluarga(nisn) {
    $.ajax({
      type: "post",
      url: "<?= site_url('Siswa/ambilkeluarga') ?>",
      data: {
        nisn: nisn
      },
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

  function ambilnisn() {
    $.ajax({
      type: "post",
      url: "<?= site_url('Auth/ambilsession') ?>",
      dataType: "json",
      success: function(response) {
        if (response.data) {
          keluarga(response.data);
        }
      },
      error: function(xhr, ajaxOption, trhownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
      }
    })
  }

  $(document).ready(function() {
    ambilnisn();

    $('.btntambahkeluarga').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?= site_url('Siswa/formtambahkeluarga') ?>",
        dataType: "json",
        success: function(response) {
          $('.viewmodal').html(response.data).show();
          $('#modaltambahkeluarga').modal('show');
        }
      });
    })
  })

  function edit(id) {
    $.ajax({
      type: "post",
      url: "<?= site_url('Siswa/formeditkeluarga') ?>",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        if (response.data) {
          $('.viewmodal').html(response.data).show();
          $('#modaleditkeluarga').modal('show');
        }
      },
      error: function(xhr, ajaxOption, trhownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
      }
    })
  }

  function hapus(id) {
    Swal.fire({
      title: `Yakin hapus ?`,
      text: 'Data yang terhapus tidak dapat dikembalikan !',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#17a2b8',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "post",
          url: "<?= site_url('Siswa/hapuskeluarga') ?>",
          data: {
            id: id
          },
          dataType: "json",
          success: function(response) {
            if (response.sukses) {
              Swal.fire({
                position: 'top',
                toast: 'false',
                icon: 'success',
                title: 'Sukses',
                text: response.sukses,
                showConfirmButton: false,
                timer: 3000
              });
              ambilnisn();
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
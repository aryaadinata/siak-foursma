<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("Admin/updatesiswa", ["class" => "formedit"]) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NISN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan NISN Siswa" name="nisn" id="nisn" value="<?= $nisn ?>" readonly>
                        <input type="hidden" name="kelas" value="<?= $id_kelas ?>" id="kelas">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap Siswa" name="nama_siswa" id="nama_siswa" value="<?= $nama ?>">
                        <div class="invalid-feedback errorNama"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btnsimpan"><i class='fa fa-save'></i> Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        $('.formedit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $(".btnsimpan").attr("disabled", "disable");
                    $(".btnsimpan").html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function() {
                    $(".btnsimpan").removeAttr("disabled");
                    $(".btnsimpan").html("<i class='fa fa-save'></i> Simpan");
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama_siswa) {
                            $("#nama_siswa").addClass("is-invalid");
                            $(".errorNamaSiswa").html(response.error.nama_siswa);
                        } else {
                            $("#nama").removeClass("is-invalid");
                            $(".errorNama_Siswa").html('');
                        }
                        if (response.error.kelas) {
                            $("#kelas").addClass("is-invalid");
                            $(".errorKelas").html(response.error.kelas);
                        } else {
                            $("#kelas").removeClass("is-invalid");
                            $(".errorKelas").html('');
                        }
                    } else {
                        $('#modaledit').modal('hide');
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'success',
                            title: 'Sukses',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        datasiswa(document.getElementById("kelas").value);
                    }
                },
                error: function(xhr, ajaxOption, trhownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + trhownError);
                }
            });
            return false;
        });
    });
</script>
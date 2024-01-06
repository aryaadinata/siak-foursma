<div class="modal fade" id="modalimportsiswa">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart("Admin/importsiswa", ["class" => "formimportsiswa"]) ?>
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian !</h5>
                    Pastikan menggunakan file import yang sesuai
                    <a href="#" class="btn btn-xs btn-info" target="_blank">Download Template</a>
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <select class="form-control">
                        <option disabled selected>--Pilih Jurusan--</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select class="form-control">
                        <option disabled selected>--Pilih Kelas--</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" name="filesiswa" class="form-control" id="filesiswa">
                    <div class="invalid-feedback errorImport"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $('.formimportsiswa').submit(function(e) {
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
                        if (response.error.filesiswa) {
                            $("#filesiswa").addClass("is-invalid");
                            $(".errorImport").html(response.error.filesiswa);
                        } else {
                            $("#filesiswa").removeClass("is-invalid");
                            $(".errorImport").html('');
                        }
                        if (response.error.tes) {
                            $("#tes").addClass("is-invalid");
                            $(".errorTes").html(response.error.tes);
                        } else {
                            $("#tes").removeClass("is-invalid");
                            $(".errorTes").html('');
                        }
                    } else {
                        $('#modalimportsiswa').modal('hide');
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'success',
                            title: 'Sukses',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        datasiswa();
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
<div class="modal fade" id="modaleditkelas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("Admin/updatekelas", ["class" => "formkelas"]) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Kelas</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Kelas" name="nama_kelas" id="nama_kelas" value="<?= $nama_kelas ?>">
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                        <div class="invalid-feedback errorNamaKelas"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tingkat</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="tingkat" id="tingkat">
                            <option disabled>Pilih Tingkat...</option>
                            <option <?php if ($id_tingkat == 1) echo "selected" ?> value="1">X</option>
                            <option <?php if ($id_tingkat == 2) echo "selected" ?> value="2">XI</option>
                            <option <?php if ($id_tingkat == 3) echo "selected" ?> value="3">XII</option>
                        </select>
                        <div class="invalid-feedback errorTingkat"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jurusan</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="jurusan" id="jurusan">
                            <option disabled>Pilih Jurusan...</option>
                            <?php foreach ($jurusan as $row) : ?>
                                <option <?php if ($row["id_jurusan"] == $id_jurusan) echo "selected" ?> value="<?= $row['id_jurusan'] ?>"><?= $row["nama_jurusan"] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorJurusan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Wali Kelas</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" style="width: 100%;" name="wali_kelas" id="wali_kelas">
                            <option disabled selected>--Pilih Wali Kelas--</option>
                            <?php foreach ($wali as $row) : ?>
                                <option value="<?= $row['nik_ptk'] ?>" <?php if ($row["nik_ptk"] == $wali_kelas) echo "selected" ?>><?= $row["nama_ptk"] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorWaliKelas"></div>
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
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.formkelas').submit(function(e) {
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
                        if (response.error.nama_kelas) {
                            $("#nama_kelas").addClass("is-invalid");
                            $(".errorNamaKelas").html(response.error.nama_kelas);
                        } else {
                            $("#nama_kelas").removeClass("is-invalid");
                            $(".errorNamakelas").html('');
                        }
                        if (response.error.tingkat) {
                            $("#tingkat").addClass("is-invalid");
                            $(".errorTingkat").html(response.error.tingkat);
                        } else {
                            $("#tingkat").removeClass("is-invalid");
                            $(".errorTingkat").html('');
                        }
                        if (response.error.jurusan) {
                            $("#jurusan").addClass("is-invalid");
                            $(".errorJurusan").html(response.error.jurusan);
                        } else {
                            $("#jurusan").removeClass("is-invalid");
                            $(".errorJurusan").html('');
                        }
                        if (response.error.wali_kelas) {
                            $("#wali_kelas").addClass("is-invalid");
                            $(".errorWaliKelas").html(response.error.wali_kelas);
                        } else {
                            $("#wali_kelas").removeClass("is-invalid");
                            $(".errorWaliKelas").html('');
                        }
                    } else {
                        $('#modaleditkelas').modal('hide');
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'success',
                            title: 'Sukses',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        datakelas();
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
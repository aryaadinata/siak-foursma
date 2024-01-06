<div class="modal fade" id="modaltambahtahun">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("Admin/inputtahun", ["class" => "formtahun"]) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <!-- text input -->
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Awal</label>
                    <!-- <input type="text" id="myInput" oninput="myFunction()"> -->
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Ketik Tahun Awal" name="tahun_awal" id="tahun_awal" oninput="tahunawal()">
                        <div class="invalid-feedback errorTahunAwal"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Akhir</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Tahun Akhir terisi otomatis" id="tahun_akhir1" value="" disabled>
                        <div class="invalid-feedback errorTahunAkhir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="toggleStatus()">
                            <label class="custom-control-label" for="customSwitch3" id="statusLabel">Tidak Aktif</label>
                            <input type="hidden" id="statusValue" name="status" value="0">
                        </div>
                        <div>Jika status aktif, maka tahun ajaran sebelumnya yang berstatus aktif akan otomatis di <span style="color: red;">nonaktifkan</span></div>
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
    function toggleStatus() {
        var statusLabel = document.getElementById("statusLabel");
        var statusValue = document.getElementById("statusValue");
        var checkbox = document.getElementById("customSwitch3");

        if (checkbox.checked) {
            statusLabel.innerHTML = "Aktif";
            statusValue.value = "1";
        } else {
            statusLabel.innerHTML = "Tidak Aktif";
            statusValue.value = "0";
        }
    }
</script>
<script>
    function tahunawal() {
        var tahun = parseInt(document.getElementById("tahun_awal").value) + parseInt(1);
        document.getElementById("tahun_akhir1").setAttribute("value", tahun);
        const d = new Date();
        let year = d.getFullYear();
        if (tahun - 1 > year) {
            $(".btnsimpan").attr("disabled", "disable");
            $("#tahun_awal").addClass("is-invalid");
            $(".errorTahunAwal").html("Tidak boleh Lebih dari tahun saat ini");
        } else if (tahun - 1 < year - 3) {
            $(".btnsimpan").attr("disabled", "disable");
            $("#tahun_awal").addClass("is-invalid");
            $(".errorTahunAwal").html("Tahun yang dimasukkan sudah lewat 10 tahun");
        } else {
            $(".btnsimpan").removeAttr("disabled");
            $("#tahun_awal").removeClass("is-invalid");
            $(".errorTahunAwal").html("");
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('.formtahun').submit(function(e) {
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
                        if (response.error.tahun_awal) {
                            $("#tahun_awal").addClass("is-invalid");
                            $(".errorTahunAwal").html(response.error.tahun_awal);
                        } else {
                            $("#tahun_awal").removeClass("is-invalid");
                            $(".errorTahunAwal").html('');
                        }
                    } else {
                        $('#modaltambahtahun').modal('hide');
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'success',
                            title: 'Sukses',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        datatahun();
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
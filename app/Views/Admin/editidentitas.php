<?= form_open("Admin/updateidentitas", ["class" => "formidentitas"]) ?>
<?= csrf_field(); ?>
<div class="card-body">
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NPSN</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan NPSN" value="<?= $sekolah["npsn"] ?>" readonly>
            <input type="hidden" name="npsn" id="npsn" value="<?= $sekolah["npsn"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Nama Sekolah</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nama Sekolah" name="nama_sekolah" value="<?= $sekolah["nama_sekolah"] ?>" id="nama_sekolah">
            <div class="invalid-feedback errorNamaSekolah"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NSS</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nomor Statistik Sekolah" value="<?= $sekolah["nss"] ?>" name="nss">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Status Sekolah</label>
        <div class="col-sm-8">
            <select class="form-control" name="status" id="status">
                <option <?php if ($sekolah["status"] == "") echo "selected" ?> disabled>--Pilih Status Sekolah--</option>
                <option <?php if ($sekolah["status"] == "Negeri") echo "selected" ?> value="Negeri">Negeri</option>
                <option <?php if ($sekolah["status"] == "Swasta") echo "selected" ?> value="Swasta">Swasta</option>
            </select>
            <div class="invalid-feedback errorStatus"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">No. SK. Pendirian</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan NO SK Pendirian Sekolah" name="no_sk_pendirian" value="<?= $sekolah["no_sk_pendirian"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Tanggal SK Pendirian</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" placeholder="Tanggal SK Pendirian" name="tgl_sk" value="<?= $sekolah["tgl_sk"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Alamat</label>
        <div class="col-sm-8">
            <textarea class="form-control" placeholder="Masukkan Alamat Sekolah" name="alamat" value="<?= $sekolah["alamat_sekolah"] ?>"><?= $sekolah["alamat_sekolah"] ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Telephone</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nomor Telephone Sekolah" name="telp" value="<?= $sekolah["telp"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Kode POS</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan Kode POS Sekolah" name="kode_pos" value="<?= $sekolah["kode_pos"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Alamat Email Sekolah" name="email" id="email" value="<?= $sekolah["email"] ?>">
            <div class="invalid-feedback errorEmail"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Nama Kepala Sekolah</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Nama Kepala Sekolah dengan Gelar" name="kepsek" id="kepsek" value="<?= $sekolah["kepsek"] ?>">
            <div class="invalid-feedback errorKepsek"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NIP Kepala Sekolah</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada" name="nip_kepsek" value="<?= $sekolah["nip_kepsek"] ?>">
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-info float-right btnsimpan">Simpan</button>
</div>
<?= form_close() ?>

<script>
    $(document).ready(function() {
        $('.formidentitas').submit(function(e) {
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
                        if (response.error.nama_sekolah) {
                            $("#nama_sekolah").addClass("is-invalid");
                            $(".errorNamaSekolah").html(response.error.nama_sekolah);
                        } else {
                            $("#nama_sekolah").removeClass("is-invalid");
                            $(".errorNamaSekolah").html('');
                        }
                        if (response.error.status) {
                            $("#status").addClass("is-invalid");
                            $(".errorStatus").html(response.error.status);
                        } else {
                            $("#status").removeClass("is-invalid");
                            $(".errorStatus").html('');
                        }
                        if (response.error.email) {
                            $("#email").addClass("is-invalid");
                            $(".errorEmail").html(response.error.email);
                        } else {
                            $("#email").removeClass("is-invalid");
                            $(".errorEmail").html('');
                        }
                        if (response.error.kepsek) {
                            $("#kepsek").addClass("is-invalid");
                            $(".errorKepsek").html(response.error.kepsek);
                        } else {
                            $("#kepsek").removeClass("is-invalid");
                            $(".errorKepsek").html('');
                        }
                    } else {
                        Swal.fire({
                            position: 'top',
                            toast: 'false',
                            icon: 'success',
                            title: 'Sukses',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        identitassekolah();
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
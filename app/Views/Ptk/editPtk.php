<?= form_open("Ptk/updateptk", ["class" => "formeditptk"]) ?>
<?= csrf_field(); ?>
<div class="card-body">
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NIK</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan NIK PTK" value="<?= $ptk[0]["nik_ptk"] ?>" readonly>
            <input type="hidden" name="nik_ptk" id="nik_ptk" value="<?= $ptk[0]["nik_ptk"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nama PTK" name="nama_ptk" value="<?= $ptk[0]["nama_ptk"] ?>" id="nama">
            <div class="invalid-feedback errorNama"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Gelar Depan</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Kosongkan jika tidak ada" name="gelar_depan" value="<?= $ptk[0]["gelar_depan"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Gelar Belakang</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Kosongkan jika tidak ada" name="gelar_belakang" value="<?= $ptk[0]["gelar_belakang"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Status Kepegawaian</label>
        <div class="col-sm-8">
            <select class="form-control" name="status_pegawai" id="status_pegawai">
                <option value="" <?php if ($ptk[0]["status_pegawai"] == "") echo "selected" ?> disabled>--Pilih Status Kepegawaian--</option>
                <option value="PNS" <?php if ($ptk[0]["status_pegawai"] == "PNS") echo "selected" ?>>PNS</option>
                <option value="PNS" <?php if ($ptk[0]["status_pegawai"] == "PNS Depag") echo "selected" ?>>PNS Depag</option>
                <option value="PNS" <?php if ($ptk[0]["status_pegawai"] == "PNS Diperbantukan") echo "selected" ?>>PNS Diperbantukan</option>
                <option value="PPPK" <?php if ($ptk[0]["status_pegawai"] == "PPPK") echo "selected" ?>>PPPK</option>
                <option value="Kontrak Provinsi" <?php if ($ptk[0]["status_pegawai"] == "Honor Daerah TK.I Provinsi") echo "selected" ?>>Honor Daerah TK.I Provinsi</option>
                <option value="Honorer" <?php if ($ptk[0]["status_pegawai"] == "Guru Honor Sekolah") echo "selected" ?>>Guru Honor Sekolah</option>
            </select>
            <div class="invalid-feedback errorStatusPegawai"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NIP / NIPPPK</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada" name="nip" value="<?= $ptk[0]["nip"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NUPTK</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada" id="nuptk" name="nuptk" value="<?= $ptk[0]["nuptk"] ?>">
            <div class="invalid-feedback errorNUPTK"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" value="<?= $ptk[0]["tmp_lahir_ptk"] ?>">
            <div class="invalid-feedback errorTempatLahir"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" id="tgl_lahir" value="<?= $ptk[0]["tgl_lahir_ptk"] ?>">
            <div class="invalid-feedback errorTglLahir"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-8">
            <select class="form-control" name="jk" id="jk">
                <option value="" <?php if ($ptk[0]["jk_ptk"] == "") echo "selected" ?> disabled>--Pilih Jenis Kelamin--</option>
                <option value="L" <?php if ($ptk[0]["jk_ptk"] == "L") echo "selected" ?>>Laki-laki</option>
                <option value="P" <?php if ($ptk[0]["jk_ptk"] == "P") echo "selected" ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback errorjk"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Agama</label>
        <div class="col-sm-8">
            <select class="form-control" name="agama">
                <option value="" <?php if ($ptk[0]["agama_ptk"] == "") echo "selected" ?> disabled>--Pilih Agama--</option>
                <option value="Hindu" <?php if ($ptk[0]["agama_ptk"] == "Hindu") echo "selected" ?>>Hindu</option>
                <option value="Islam" <?php if ($ptk[0]["agama_ptk"] == "Islam") echo "selected" ?>>Islam</option>
                <option value="Protestan" <?php if ($ptk[0]["agama_ptk"] == "Protestan") echo "selected" ?>>Protestan</option>
                <option value="Katolik" <?php if ($ptk[0]["agama_ptk"] == "Katolik") echo "selected" ?>>Katolik</option>
                <option value="Buddha" <?php if ($ptk[0]["agama_ptk"] == "Buddha") echo "selected" ?>>Buddha</option>
                <option value="Konghucu" <?php if ($ptk[0]["agama_ptk"] == "Konghucu") echo "selected" ?>>Konghucu</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Alamat</label>
        <div class="col-sm-8">
            <textarea class="form-control" placeholder="Masukkan Alamat" name="alamat"><?= $ptk[0]["alamat_ptk"] ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">No. HP</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan Nomor HP Aktif" name="no_hp" id="no_hp" value="<?= $ptk[0]["no_hp_ptk"] ?>">
            <div class="invalid-feedback errorNoHP"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" placeholder="Masukkan Alamat Email Aktif" name="email" id="email" value="<?= $ptk[0]["email"] ?>">
            <div class="invalid-feedback errorEmail"></div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info float-right btn-simpan">Simpan</button>
    </div>
    <?= form_close() ?>
</div>

<script>
    $(document).ready(function() {
        $('.formeditptk').submit(function(e) {
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
                        if (response.error.nama_ptk) {
                            $("#nama").addClass("is-invalid");
                            $(".errorNama").html(response.error.nama_ptk);
                        } else {
                            $("#nama").removeClass("is-invalid");
                            $(".errorNama").html('');
                        }
                        if (response.error.status_pegawai) {
                            $("#status_pegawai").addClass("is-invalid");
                            $(".errorStatusPegawai").html(response.error.status_pegawai);
                        } else {
                            $("#status_pegawai").removeClass("is-invalid");
                            $(".errorStatusPegawai").html('');
                        }
                        if (response.error.nuptk) {
                            $("#nuptk").addClass("is-invalid");
                            $(".errorNUPTK").html(response.error.nuptk);
                        } else {
                            $("#nuptk").removeClass("is-invalid");
                            $(".errorNUPTK").html('');
                        }
                        if (response.error.tempat_lahir) {
                            $("#tempat_lahir").addClass("is-invalid");
                            $(".errorTempatLahir").html(response.error.tempat_lahir);
                        } else {
                            $("#tempat_lahir").removeClass("is-invalid");
                            $(".errorTempatLahir").html('');
                        }
                        if (response.error.tgl_lahir) {
                            $("#tgl_lahir").addClass("is-invalid");
                            $(".errorTglLahir").html(response.error.tgl_lahir);
                        } else {
                            $("#tgl_lahir").removeClass("is-invalid");
                            $(".errorTglLahir").html('');
                        }
                        if (response.error.jk) {
                            $("#jk").addClass("is-invalid");
                            $(".errorjk").html(response.error.jk);
                        } else {
                            $("#jk").removeClass("is-invalid");
                            $(".errorjk").html('');
                        }
                        if (response.error.no_hp) {
                            $("#no_hp").addClass("is-invalid");
                            $(".errorNoHP").html(response.error.no_hp);
                        } else {
                            $("#no_hp").removeClass("is-invalid");
                            $(".errorNoHP").html('');
                        }
                        if (response.error.email) {
                            $("#email").addClass("is-invalid");
                            $(".errorEmail").html(response.error.email);
                        } else {
                            $("#email").removeClass("is-invalid");
                            $(".errorEmail").html('');
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
                        detailptk();
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
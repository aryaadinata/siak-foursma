<?= form_open("Admin/updatebiodata", ["class" => "formbiodata"]) ?>
<?= csrf_field(); ?>
<div class="card-body">
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NIS</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan NIS Siswa" name="nis" value="<?= $siswa[0]["nis"] ?>" id="nis" readonly>
            <input type="hidden" name="nis" id="nis" value="<?= $siswa[0]["nis"] ?>">
            <div class="invalid-feedback errorNis"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NISN</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan NISN Siswa" value="<?= $siswa[0]["nisn"] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Kelas</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Kelas Siswa" value="<?= $siswa[0]["nama_kelas"] ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Tahun Masuk</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan Kelas Siswa" name="tahun_masuk" id="tahun_masuk" value="<?= $siswa[0]["tahun_masuk"] ?>" oninput="tahunmasuk()">
            <div class="invalid-feedback errorTahunMasuk"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">NIK</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Masukkan NIK Siswa" name="nik" id="nik" value="<?= $siswa[0]["nik"] ?>">
            <div class="invalid-feedback errorNik"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nama Siswa" name="nama" id="nama" value="<?= $siswa[0]["nama"] ?>">
            <div class="invalid-feedback errorNama"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir Siswa" name="tempat_lahir" id="tempat_lahir" value="<?= $siswa[0]["tempat_lahir"] ?>">
            <div class="invalid-feedback errorTempatLahir"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" placeholder="Pilih Tanggal Lahir Siswa" name="tanggal_lahir" id="tanggal_lahir" value="<?= $siswa[0]["tanggal_lahir"] ?>">
            <div class="invalid-feedback errorTanggalLahir"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-8">
            <select class="form-control" name="jk">
                <option <?php if ($siswa[0]["jk"] == "") echo "selected" ?> disabled>--Pilih Jenis Kelamin--</option>
                <option <?php if ($siswa[0]["jk"] == "L") echo "selected" ?> value="L">Laki-laki</option>
                <option <?php if ($siswa[0]["jk"] == "P") echo "selected" ?> value="P">Perempuan</option>
            </select>
            <div class="invalid-feedback errorjk"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Agama</label>
        <div class="col-sm-8">
            <select class="form-control" name="agama">
                <option <?php if ($siswa[0]["agama"] == "") echo "selected" ?> disabled>--Pilih Agama--</option>
                <option <?php if ($siswa[0]["agama"] == "Hindu") echo "selected" ?> value="Hindu">Hindu</option>
                <option <?php if ($siswa[0]["agama"] == "Islam") echo "selected" ?> value="Islam">Islam</option>
                <option <?php if ($siswa[0]["agama"] == "Protestan") echo "selected" ?> value="Protestan">Protestan</option>
                <option <?php if ($siswa[0]["agama"] == "Katolik") echo "selected" ?> value="Katolik">Katolik</option>
                <option <?php if ($siswa[0]["agama"] == "Buddha") echo "selected" ?> value="Buddha">Buddha</option>
                <option <?php if ($siswa[0]["agama"] == "Konguhcu") echo "selected" ?> value="Konghucu">Konghucu</option>
            </select>
            <div class="invalid-feedback errorAgama"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Alamat</label>
        <div class="col-sm-8">
            <textarea class="form-control" placeholder="Masukkan Alamat Siswa" name="alamat" id="alamat" value="<?= $siswa[0]["alamat"] ?>"><?= $siswa[0]["alamat"] ?></textarea>
            <div class="invalid-feedback errorAlamat"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">No. HP</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Alamat Siswa" name="no_hp" id="no_hp" value="<?= $siswa[0]["no_hp"] ?>">
            <div class="invalid-feedback errorNoHP"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Alamat Orang Tua</label>
        <div class="col-sm-8">
            <textarea class="form-control" placeholder="Masukkan Alamat Orang Tua / Wali Siswa" name="alamat_ortu" id="alamat_ortu" value="<?= $siswa[0]["alamat_ortu"] ?>"><?= $siswa[0]["alamat_ortu"] ?></textarea>
            <div class="invalid-feedback errorAlamatOrtu"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Nama Ayah</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nama Ayah" name="nama_ayah" id="nama_ayah" value="<?= $siswa[0]["nama_ayah"] ?>">
            <div class="invalid-feedback errorNamaAyah"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Nama Ibu</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Nama Ibu" name="nama_ibu" id="nama_ibu" value="<?= $siswa[0]["nama_ibu"] ?>">
            <div class="invalid-feedback errorNamaIbu"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Sekolah Asal</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Masukkan Sekolah Asal" name="sekolah_asal" id="sekolah_asal" value="<?= $siswa[0]["sekolah_asal"] ?>">
            <div class="invalid-feedback errorSekolahAsal"></div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-info float-right btnsimpan">Simpan</button>
</div>
<?= form_close() ?>

<script>
    $(document).ready(function() {
        $('.formbiodata').submit(function(e) {
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
                        if (response.error.nis) {
                            $("#nis").addClass("is-invalid");
                            $(".errorNis").html(response.error.nis);
                        } else {
                            $("#nis").removeClass("is-invalid");
                            $(".errorNis").html('');
                        }
                        if (response.error.nik) {
                            $("#nik").addClass("is-invalid");
                            $(".errorNik").html(response.error.nik);
                        } else {
                            $("#nik").removeClass("is-invalid");
                            $(".errorNik").html('');
                        }
                        if (response.error.nama) {
                            $("#nama").addClass("is-invalid");
                            $(".errorNama").html(response.error.nama);
                        } else {
                            $("#nama").removeClass("is-invalid");
                            $(".errorNama").html('');
                        }
                        if (response.error.tempat_lahir) {
                            $("#tempat_lahir").addClass("is-invalid");
                            $(".errorTempatLahir").html(response.error.tempat_lahir);
                        } else {
                            $("#tempat_lahir").removeClass("is-invalid");
                            $(".errorTempatLahir").html('');
                        }
                        if (response.error.tanggal_lahir) {
                            $("#tanggal_lahir").addClass("is-invalid");
                            $(".errorTanggalLahir").html(response.error.tanggal_lahir);
                        } else {
                            $("#tanggal_lahir").removeClass("is-invalid");
                            $(".errorTanggalLahir").html('');
                        }
                        if (response.error.jk) {
                            $("#jk").addClass("is-invalid");
                            $(".errorjk").html(response.error.jk);
                        } else {
                            $("#jk").removeClass("is-invalid");
                            $(".errorjk").html('');
                        }
                        if (response.error.agama) {
                            $("#agama").addClass("is-invalid");
                            $(".errorAgama").html(response.error.agama);
                        } else {
                            $("#agama").removeClass("is-invalid");
                            $(".errorAgama").html('');
                        }
                        if (response.error.alamat) {
                            $("#alamat").addClass("is-invalid");
                            $(".errorAlamat").html(response.error.alamat);
                        } else {
                            $("#alamat").removeClass("is-invalid");
                            $(".errorAlamat").html('');
                        }
                        if (response.error.no_hp) {
                            $("#no_hp").addClass("is-invalid");
                            $(".errorNoHP").html(response.error.no_hp);
                        } else {
                            $("#no_hp").removeClass("is-invalid");
                            $(".errorNoHP").html('');
                        }
                        if (response.error.alamat_ortu) {
                            $("#alamat_ortu").addClass("is-invalid");
                            $(".errorAlamatOrtu").html(response.error.alamat_ortu);
                        } else {
                            $("#alamat_ortu").removeClass("is-invalid");
                            $(".errorAlamatOrtu").html('');
                        }
                        if (response.error.nama_ayah) {
                            $("#nama_ayah").addClass("is-invalid");
                            $(".errorNamaAyah").html(response.error.nama_ayah);
                        } else {
                            $("#nama_ayah").removeClass("is-invalid");
                            $(".errorNamaAyah").html('');
                        }
                        if (response.error.nama_ibu) {
                            $("#nama_ibu").addClass("is-invalid");
                            $(".errorNamaIbu").html(response.error.nama_ibu);
                        } else {
                            $("#nama_ibu").removeClass("is-invalid");
                            $(".errorNamaIbu").html('');
                        }
                        if (response.error.sekolah_asal) {
                            $("#sekolah_asal").addClass("is-invalid");
                            $(".errorSekolahAsal").html(response.error.sekolah_asal);
                        } else {
                            $("#sekolah_asal").removeClass("is-invalid");
                            $(".errorSekolahAsal").html('');
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
                        biodatasiswa();
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
<script>
    function tahunmasuk() {
        var tahun = parseInt(document.getElementById("tahun_masuk").value);
        const d = new Date();
        let year = d.getFullYear();
        if (tahun > year) {
            $(".btnsimpan").attr("disabled", "disable");
            $("#tahun_masuk").addClass("is-invalid");
            $(".errorTahunMasuk").html("Tidak boleh Lebih dari tahun saat ini");
        } else if (tahun < year - 3) {
            $(".btnsimpan").attr("disabled", "disable");
            $("#tahun_masuk").addClass("is-invalid");
            $(".errorTahunMasuk").html("Tahun yang dimasukkan sudah lewat 3 tahun");
        } else {
            $(".btnsimpan").removeAttr("disabled");
            $("#tahun_masuk").removeClass("is-invalid");
            $(".errorTahunMasuk").html("");
        }
    }
</script>
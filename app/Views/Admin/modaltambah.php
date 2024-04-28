<div class="modal fade" id="modaltambahsiswa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("Admin/inputsiswa", ["class" => "formsiswa"]) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIS</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan NIS Siswa" name="nis" id="nis">
                        <div class="invalid-feedback errorNIS"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NISN</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan NISN Siswa" name="nisn" id="nisn">
                        <div class="invalid-feedback errorNISN"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kelas</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="kelas" id="kelas">
                            <option disabled selected>--Pilih Kelas--</option>
                            <?php foreach ($kelas as $row) : ?>
                                <option value="<?= $row["id_kelas"] ?>"><?= $row["nama_kelas"]; ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorKelas"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan NIK Siswa" name="nik" id="nik">
                        <div class="invalid-feedback errorNIK"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap Siswa" name="nama_siswa" id="nama_siswa">
                        <div class="invalid-feedback errorNamaSiswa"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" id="tempat_lahir">
                        <div class="invalid-feedback errorTempatLahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" placeholder="Masukkan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir">
                        <div class="invalid-feedback errorTanggalLahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="jk">
                            <option disabled>--Pilih Jenis Kelamin--</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorjk"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Agama</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="agama">
                            <option disabled>--Pilih Agama--</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                        <div class="invalid-feedback errorAgama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" placeholder="Masukkan Alamat Siswa" name="alamat" id="alamat"></textarea>
                        <div class="invalid-feedback errorAlamat"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">No. HP</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan Nomor HP aktif" name="no_hp" id="no_hp">
                        <div class="invalid-feedback errorNoHP"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Email aktif" name="email" id="email">
                        <div class="invalid-feedback errorEmail"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Alamat Orang Tua</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" placeholder="Masukkan Alamat Orang Tua / Wali Siswa" name="alamat_ortu" id="alamat_ortu"></textarea>
                        <div class="invalid-feedback errorAlamatOrtu"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Ayah</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Ayah" name="nama_ayah" id="nama_ayah">
                        <div class="invalid-feedback errorNamaAyah"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Ibu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Ibu" name="nama_ibu" id="nama_ibu">
                        <div class="invalid-feedback errorNamaIbu"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Sekolah Asal</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Sekolah Asal" name="sekolah_asal" id="sekolah_asal">
                        <div class="invalid-feedback errorSekolahAsal"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tahun Masuk</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan Tahun" name="tahun_masuk" id="tahun_masuk" oninput="tahunmasuk()">
                        <div class="invalid-feedback errorTahunMasuk"></div>
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
        $('.formsiswa').submit(function(e) {
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
                        if (response.error.nisn) {
                            $("#nisn").addClass("is-invalid");
                            $(".errorNISN").html(response.error.nisn);
                        } else {
                            $("#nisn").removeClass("is-invalid");
                            $(".errorNISN").html('');
                        }
                        if (response.error.nis) {
                            $("#nis").addClass("is-invalid");
                            $(".errorNIS").html(response.error.nis);
                        } else {
                            $("#nis").removeClass("is-invalid");
                            $(".errorNIS").html('');
                        }
                        if (response.error.nik) {
                            $("#nik").addClass("is-invalid");
                            $(".errorNIK").html(response.error.nik);
                        } else {
                            $("#nik").removeClass("is-invalid");
                            $(".errorNIK").html('');
                        }
                        if (response.error.email) {
                            $("#email").addClass("is-invalid");
                            $(".errorEmail").html(response.error.email);
                        } else {
                            $("#email").removeClass("is-invalid");
                            $(".errorEmail").html('');
                        }
                        if (response.error.nama_siswa) {
                            $("#nama_siswa").addClass("is-invalid");
                            $(".errorNamaSiswa").html(response.error.nama_siswa);
                        } else {
                            $("#nama_siswa").removeClass("is-invalid");
                            $(".errorNamaSiswa").html('');
                        }
                        if (response.error.kelas) {
                            $("#kelas").addClass("is-invalid");
                            $(".errorKelas").html(response.error.kelas);
                        } else {
                            $("#kelas").removeClass("is-invalid");
                            $(".errorKelas").html('');
                        }
                        if (response.error.tahun_masuk) {
                            $("#tahun_masuk").addClass("is-invalid");
                            $(".errorTahunMasuk").html(response.error.tahun_masuk);
                        } else {
                            $("#tahun_masuk").removeClass("is-invalid");
                            $(".errorTahunMasuk").html('');
                        }
                    } else {
                        $('#modaltambahsiswa').modal('hide');
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
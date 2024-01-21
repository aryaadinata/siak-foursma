<div class="modal fade" id="modaleditkeluarga">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("Siswa/updatekeluarga", ["class" => "formkeluarga"]) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan NIK" name="nik" id="nik" value="<?= $keluarga["nik"] ?>">
                        <div class="invalid-feedback errorNIK"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" value="<?= $keluarga["nama_kel"] ?>" id="nama">
                        <div class="invalid-feedback errorNama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Hubungan</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" style="width: 100%;" name="hubungan" id="hubungan">
                            <option disabled selected>--Pilih Hubungan--</option>
                            <option value="Ayah" <?php if ($keluarga["hubungan_kel"] == "Ayah") echo "selected" ?>>Ayah</option>
                            <option value="Ibu" <?php if ($keluarga["hubungan_kel"] == "Ibu") echo "selected" ?>>Ibu</option>
                            <option value="Wali" <?php if ($keluarga["hubungan_kel"] == "Wali") echo "selected" ?>>Wali</option>
                            <option value="Saudara" <?php if ($keluarga["hubungan_kel"] == "Saudara") echo "selected" ?>>Saudara</option>
                            <option value="Ayah Tiri" <?php if ($keluarga["hubungan_kel"] == "Ayah Tiri") echo "selected" ?>>Ayah Tiri</option>
                            <option value="Ibu Tiri" <?php if ($keluarga["hubungan_kel"] == "Ibu Tiri") echo "selected" ?>>Ibu Tiri</option>
                        </select>
                        <div class="invalid-feedback errorHubungan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="width: 100%;" name="jk" id="jk">
                            <option disabled selected>--Pilih Jenis Kelamin--</option>
                            <option value="L" <?php if ($keluarga["jk_kel"] == "L") echo "selected" ?>>Laki-laki</option>
                            <option value="P" <?php if ($keluarga["jk_kel"] == "P") echo "selected" ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorJK"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" value="<?= $keluarga["tempat_lahir_kel"] ?>" id="tempat_lahir">
                        <div class="invalid-feedback errorTempatLahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="tanggal_lahir" value="<?= $keluarga["tanggal_lahir_kel"] ?>" id="tanggal_lahir">
                        <div class="invalid-feedback errorTanggalLahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pendidikan</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" style="width: 100%;" name="pendidikan" id="pendidikan">
                            <option disabled selected>--Pilih Pendidikan--</option>
                            <option value="Tidak Sekolah" <?php if ($keluarga["pendidikan"] == "Tidak Sekolah") echo "selected" ?>>Tidak Sekolah</option>
                            <option value="TK / Sederajat" <?php if ($keluarga["pendidikan"] == "TK / Sederajat") echo "selected" ?>>TK / Sederajat</option>
                            <option value="Putus SD" <?php if ($keluarga["pendidikan"] == "Putus SD") echo "selected" ?>>Putus SD</option>
                            <option value="SD / Sederajat" <?php if ($keluarga["pendidikan"] == "SD / Sederajat") echo "selected" ?>>SD / Sederajat</option>
                            <option value="SMP / Sederajat" <?php if ($keluarga["pendidikan"] == "SMP / Sederajat") echo "selected" ?>>SMP / Sederajat</option>
                            <option value="SMA / Sederajat" <?php if ($keluarga["pendidikan"] == "SMA / Sederajat") echo "selected" ?>>SMA / Sederajat</option>
                            <option value="Paket A" <?php if ($keluarga["pendidikan"] == "Paket A") echo "selected" ?>>Paket A</option>
                            <option value="Paket B" <?php if ($keluarga["pendidikan"] == "Paket B") echo "selected" ?>>Paket B</option>
                            <option value="Paket C" <?php if ($keluarga["pendidikan"] == "Paket C") echo "selected" ?>>Paket C</option>
                            <option value="D1" <?php if ($keluarga["pendidikan"] == "D1") echo "selected" ?>>D1</option>
                            <option value="D2" <?php if ($keluarga["pendidikan"] == "D2") echo "selected" ?>>D2</option>
                            <option value="D3" <?php if ($keluarga["pendidikan"] == "D3") echo "selected" ?>>D3</option>
                            <option value="D4" <?php if ($keluarga["pendidikan"] == "D4") echo "selected" ?>>D4</option>
                            <option value="S1" <?php if ($keluarga["pendidikan"] == "S1") echo "selected" ?>>S1</option>
                            <option value="S2" <?php if ($keluarga["pendidikan"] == "S2") echo "selected" ?>>S2</option>
                            <option value="S3" <?php if ($keluarga["pendidikan"] == "S3") echo "selected" ?>>S3</option>
                        </select>
                        <div class="invalid-feedback errorPendidikan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pekerjaan</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" style="width: 100%;" name="pekerjaan" id="pekerjaan">
                            <option disabled selected>--Pilih Pekerjaan--</option>
                            <option value="Tidak Bekerja" <?php if ($keluarga["pekerjaan"] == "Tidak Bekerja") echo "selected" ?>>Tidak Bekerja</option>
                            <option value="Nelayan" <?php if ($keluarga["pekerjaan"] == "Nelayan") echo "selected" ?>>Nelayan</option>
                            <option value="Petani" <?php if ($keluarga["pekerjaan"] == "Petani") echo "selected" ?>>Petani</option>
                            <option value="Peternak" <?php if ($keluarga["pekerjaan"] == "Peternak") echo "selected" ?>>Peternak</option>
                            <option value="PNS/TNI/Polri" <?php if ($keluarga["pekerjaan"] == "PNS/TNI/Polri") echo "selected" ?>>PNS/TNI/Polri</option>
                            <option value="Karyawan Swasta" <?php if ($keluarga["pekerjaan"] == "Karyawan Swasta") echo "selected" ?>>Karyawan Swasta</option>
                            <option value="Pedagang Kecil" <?php if ($keluarga["pekerjaan"] == "Pedagang Kecil") echo "selected" ?>>Pedagang Kecil</option>
                            <option value="Pedagang Besar" <?php if ($keluarga["pekerjaan"] == "Pedagang Besar") echo "selected" ?>>Pedagang Besar</option>
                            <option value="Wiraswasta" <?php if ($keluarga["pekerjaan"] == "Wiraswasta") echo "selected" ?>>Wirausaha</option>
                            <option value="Buruh" <?php if ($keluarga["pekerjaan"] == "Buruh") echo "selected" ?>>Buruh</option>
                            <option value="Pensiunan" <?php if ($keluarga["pekerjaan"] == "Pensiunan") echo "selected" ?>>Peneliti</option>
                            <option value="Tim Ahli / Konsultan" <?php if ($keluarga["pekerjaan"] == "Tim Ahli / Konsultan") echo "selected" ?>>Tim Ahli / Konsultan</option>
                            <option value="Magang" <?php if ($keluarga["pekerjaan"] == "Magang") echo "selected" ?>>Magang</option>
                            <option value="Tenaga Pengajar / Instruktur / Fasilitator" <?php if ($keluarga["pekerjaan"] == "Tenaga Pengajar / Instruktur / Fasilitator") echo "selected" ?>>Tenaga Pengajar / Instruktur / Fasilitator</option>
                            <option value="Pimpinan / Manajerial" <?php if ($keluarga["pekerjaan"] == "Pimpinan / Manajerial") echo "selected" ?>>Pimpinan / Manajerial</option>
                            <option value="Sudah Meninggal" <?php if ($keluarga["pekerjaan"] == "Sudah Meninggal") echo "selected" ?>>Sudah Meninggal</option>
                            <option value="lainnya" <?php if ($keluarga["pekerjaan"] == "lainnya") echo "selected" ?>>Lainnya</option>
                        </select>
                        <div class="invalid-feedback erroPekerjaan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">penghasilan</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" style="width: 100%;" name="penghasilan" id="penghasilan">
                            <option disabled selected>--Pilih Penghasilan--</option>
                            <option value="Kurang Dari Rp. 500.000" <?php if ($keluarga["penghasilan"] == "Kurang Dari Rp. 500.000") echo "selected" ?>>Kurang Dari Rp. 500.000</option>
                            <option value="Rp. 500.000 - Rp. 999.999" <?php if ($keluarga["penghasilan"] == "Rp. 500.000 - Rp. 999.999") echo "selected" ?>>Rp. 500.000 - Rp. 999.999</option>
                            <option value="Rp. 1.000.000 - Rp. 1.999.999" <?php if ($keluarga["penghasilan"] == "Rp. 1.000.000 - Rp. 1.999.999") echo "selected" ?>>Rp. 1.000.000 - Rp. 1.999.999</option>
                            <option value="Rp. 2.000.000 - Rp. 4.999.999" <?php if ($keluarga["penghasilan"] == "Rp. 2.000.000 - Rp. 4.999.999") echo "selected" ?>>Rp. 2.000.000 - Rp. 4.999.999</option>
                            <option value="Rp. 5.000.000 - Rp. 9.999.999" <?php if ($keluarga["penghasilan"] == "Rp. 5.000.000 - Rp. 9.999.999") echo "selected" ?>>Rp. 5.000.000 - Rp. 9.999.999</option>
                            <option value="Rp. 10.000.000 - Rp. 20.000.000" <?php if ($keluarga["penghasilan"] == "Rp. 10.000.000 - Rp. 20.000.000") echo "selected" ?>>Rp. 10.000.000 - Rp. 20.000.000</option>
                            <option value="Lebih Dari Rp. 20.000.000" <?php if ($keluarga["penghasilan"] == "Lebih Dari Rp. 20.000.000") echo "selected" ?>>Lebih Dari Rp. 20.000.000</option>
                        </select>
                        <div class="invalid-feedback errorPenghasilan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">No. HP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan No. HP" name="no_hp" value="<?= $keluarga["no_hp"] ?>" id="no_hp">
                        <div class="invalid-feedback errorNoHP"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-flat btn-info btnsimpan"><i class='fa fa-save'></i> Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
        $('.formkeluarga').submit(function(e) {
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
                        if (response.error.nik) {
                            $("#nik").addClass("is-invalid");
                            $(".errorNIK").html(response.error.nik);
                        } else {
                            $("#nik").removeClass("is-invalid");
                            $(".errorNIK").html('');
                        }
                        if (response.error.nama) {
                            $("#nama").addClass("is-invalid");
                            $(".errorNama").html(response.error.nama);
                        } else {
                            $("#nama").removeClass("is-invalid");
                            $(".errorNama").html('');
                        }
                        if (response.error.hubungan) {
                            $("#hubungan").addClass("is-invalid");
                            $(".errorHubungan").html(response.error.hubungan);
                        } else {
                            $("#hubungan").removeClass("is-invalid");
                            $(".errorHubungan").html('');
                        }
                        if (response.error.jk) {
                            $("#jk").addClass("is-invalid");
                            $(".errorJK").html(response.error.jk);
                        } else {
                            $("#jk").removeClass("is-invalid");
                            $(".errorJK").html('');
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
                        if (response.error.pendidikan) {
                            $("#pendidikan").addClass("is-invalid");
                            $(".errorPendidikan").html(response.error.pendidikan);
                        } else {
                            $("#pendidikan").removeClass("is-invalid");
                            $(".errorPendidikan").html('');
                        }
                        if (response.error.pekerjaan) {
                            $("#pekerjaan").addClass("is-invalid");
                            $(".errorPekerjaan").html(response.error.pekerjaan);
                        } else {
                            $("#pekerjaan").removeClass("is-invalid");
                            $(".errorPekerjaan").html('');
                        }
                        if (response.error.penghasilan) {
                            $("#penghasilan").addClass("is-invalid");
                            $(".errorPenghasilan").html(response.error.penghasilan);
                        } else {
                            $("#penghasilan").removeClass("is-invalid");
                            $(".errorPenghasilan").html('');
                        }
                        if (response.error.no_hp) {
                            $("#no_hp").addClass("is-invalid");
                            $(".errorNoHP").html(response.error.no_hp);
                        } else {
                            $("#no_hp").removeClass("is-invalid");
                            $(".errorNoHP").html('');
                        }
                    } else {
                        $('#modaleditkeluarga').modal('hide');
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
            });
            return false;
        });
    });
</script>
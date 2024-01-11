<div class="modal fade" id="modaltambahpegawai">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("Ptk/inputpegawai", ["class" => "formpegawai"]) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan NIK" name="nik" id="nik">
                        <div class="invalid-feedback errorNIK"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap Siswa" name="nama_ptk" id="nama_ptk">
                        <div class="invalid-feedback errorNamaPtk"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Gelar Depan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Kosongkan jika tidak ada" name="gelar_depan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Gelar Belakang</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Kosongkan jika tidak ada" name="gelar_belakang">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Status Kepegawaian</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="status_pegawai" id="status_pegawai">
                            <option value="" selected disabled>--Pilih Status Kepegawaian--</option>
                            <option value="PNS">PNS</option>
                            <option value="PPPK">PPPK</option>
                            <option value="Kontrak Provinsi">Kontrak Provinsi</option>
                            <option value="Honorer">Honorer</option>
                        </select>
                        <div class="invalid-feedback errorStatusPegawai"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIP / NIPPPK</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada" name="nip">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NUPTK</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada" name="nuptk" id="nuptk">
                        <div class="invalid-feedback errorNUPTK"></div>
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
                        <input type="date" class="form-control" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" id="tgl_lahir">
                        <div class="invalid-feedback errorTglLahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="jk" id="jk">
                            <option value="" selected disabled>--Pilih Jenis Kelamin--</option>
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
                            <option value="" selected disabled>--Pilih Agama--</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" placeholder="Masukkan Alamat" name="alamat"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">No. HP</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="Masukkan Nomor HP Aktif" name="no_hp" id="no_hp">
                        <div class="invalid-feedback errorNoHP"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" placeholder="Masukkan Alamat Email Aktif" name="email" id="email">
                        <div class="invalid-feedback errorEmail"></div>
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
            $('.formpegawai').submit(function(e) {
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
                            if (response.error.nama_ptk) {
                                $("#nama_ptk").addClass("is-invalid");
                                $(".errorNamaPtk").html(response.error.nama_ptk);
                            } else {
                                $("#nama_ptk").removeClass("is-invalid");
                                $(".errorNamaPtk").html('');
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
                            $('#modaltambahpegawai').modal('hide');
                            Swal.fire({
                                position: 'top',
                                toast: 'false',
                                icon: 'success',
                                title: 'Sukses',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            datapegawai();
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
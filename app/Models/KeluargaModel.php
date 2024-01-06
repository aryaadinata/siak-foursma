<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table = "keluarga";
    protected $primaryKey = "id_kel";
    protected $allowedFields = ["nik", "nama_kel", 'hubungan_kel', 'jk_kel', 'tempat_lahir_kel', 'tanggal_lahir_kel', 'pendidikan', 'pekerjaan', 'penghasilan', 'no_hp', 'nisn'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

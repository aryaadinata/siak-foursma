<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = "kelas";
    protected $primaryKey = "id_kelas";
    protected $allowedFields = ["id_kelas", 'nama_kelas', 'id_tingkat', 'id_jurusan', 'wali_kelas'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

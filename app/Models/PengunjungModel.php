<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunjungModel extends Model
{
    protected $table = "pengunjung_perpus";
    protected $primaryKey = "id_kunjungan";
    protected $allowedFields = ["id_siswa", "id_ptk", 'tgl_kunjungan', 'jam'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

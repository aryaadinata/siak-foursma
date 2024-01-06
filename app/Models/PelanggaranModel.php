<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = "pelanggaran";
    protected $primaryKey = "id_pelanggaran";
    protected $allowedFields = ["id_pelanggaran", 'tanggal', 'jenis_pelanggaran',  'ket', 'nisn', 'id_ptk'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

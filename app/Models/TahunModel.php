<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunModel extends Model
{
    protected $table = "tahun_ajaran";
    protected $primaryKey = "id_tahun";
    protected $allowedFields = ["id_tahun", 'tahun_awal', 'tahun_akhir', 'status'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

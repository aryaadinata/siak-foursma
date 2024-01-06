<?php

namespace App\Models;

use CodeIgniter\Model;

class TingkatModel extends Model
{
    protected $table = "tingkat";
    protected $primaryKey = "id_tingkat";
    protected $allowedFields = ["id_tingkat", 'tingkat'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

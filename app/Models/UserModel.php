<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $primaryKey = "username";
    protected $allowedFields = ["username", 'nama', 'pass', 'level'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

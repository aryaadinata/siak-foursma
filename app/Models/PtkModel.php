<?php

namespace App\Models;

use CodeIgniter\Model;

class PtkModel extends Model
{
    protected $table = "ptk";
    protected $primaryKey = "nik_ptk";
    protected $allowedFields = [
        "nik_ptk", 'nama_ptk', 'status_pegawai', 'jenis_ptk', 'nip'
    ];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}
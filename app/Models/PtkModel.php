<?php

namespace App\Models;

use CodeIgniter\Model;

class PtkModel extends Model
{
    protected $table = "ptk";
    protected $primaryKey = "nik_ptk";
    protected $allowedFields = [
        "nik_ptk", 'nik_en', 'nama_ptk', 'gelar_depan', 'gelar_belakang', 'jenis_ptk', 'nip', 'nuptk', 'tmp_lahir_ptk', 'tgl_lahir_ptk', 'jk_ptk', 'agama_ptk', 'alamat_ptk', 'no_hp_ptk', 'email', 'status_pegawai', 'foto',
    ];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

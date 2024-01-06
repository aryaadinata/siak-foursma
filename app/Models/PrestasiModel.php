<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiModel extends Model
{
    protected $table = "prestasi";
    protected $primaryKey = "id_prestasi";
    protected $allowedFields = ["id_prestasi", 'prestasi', 'peringkat', 'tingkat', 'penyelenggara', 'no_piagam', 'tanggal"piagam', 'bukti', 'nisn'];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

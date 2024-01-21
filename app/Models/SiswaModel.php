<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = "siswa";
    protected $primaryKey = "nisn";
    protected $allowedFields = [
        "nisn", "nisn_en", 'nis', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jk',  'agama', "alamat", 'no_hp', 'email', 'alamat_ortu',
        'nama_ayah', "nama_ibu", "sekolah_asal", "foto", "tahun_masuk", 'id_kelas', "status_aktif", "tahun_out"
    ];

    // protected $table = 'pendidikan';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['jenjang', 'instansi', 'jurusan', 'tahun_masuk_lulus', 'no_ijazah', 'no_transkrip', 'file'];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = "identitas_sekolah";
    protected $primaryKey = "npsn";
    protected $allowedFields = [
        "npsn", "nama_sekolah", "nss", "status", "no_sk_pendirian", "tgl_sk", "alamat_sekolah", "telp", "kode_pos", "email", "kepsek", "nip_kepsek"
    ];
}

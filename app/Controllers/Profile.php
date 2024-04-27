<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Models\PtkModel;
use App\Libraries\Hash;

class Profile extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function siswa($nisn)
    {
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($nisn);
        $data = [
            'title' => "Biodata",
            'siswa' => $siswa,
            //'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Profile/viewSiswa', $data);
        echo view('Layout/footer', $data);
    }
}

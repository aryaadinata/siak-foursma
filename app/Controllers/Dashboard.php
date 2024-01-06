<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        helper(['url']);
    }

    public function index()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $jmlSiswa = $this->db->query("SELECT COUNT(nisn) as jml FROM siswa WHERE status_aktif=0");
        $jmlSiswa = $jmlSiswa->getResultArray();
        $jmlSiswa0 = $this->db->query("SELECT COUNT(nisn) as jml FROM siswa WHERE status_aktif=1");
        $jmlSiswa0 = $jmlSiswa0->getResultArray();
        $data = [
            'title' => "Dashboard",
            'userInfo' => $userInfo,
            'jmlsiswa' => $jmlSiswa,
            'jmlsiswa0' => $jmlSiswa0,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Dashboard/dashboard', $data);
        echo view('Layout/footer', $data);
    }
}

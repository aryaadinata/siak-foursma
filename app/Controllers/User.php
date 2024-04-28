<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Models\PtkModel;
use App\Libraries\Hash;

class User extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function admin()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $data = [
            'title' => "Akun Admin",
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('User/viewUser', $data);
        echo view('Layout/footer', $data);
    }

    function ambiladmin()
    {
        //if ($this->request->isAJAX()) {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where("level", 0);
        $query = $builder->get();
        $admin = $query->getResultArray();
        $data = [
            'admin' => $admin,
        ];
        $msg = [
            'data' => view('User/dataAdmin', $data)
        ];
        echo json_encode($msg);
        // } else {
        //     exit("Tidak dapat diproses");
        // }
    }

    public function akun_ptk()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $data = [
            'title' => "Akun PTK",
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('User/viewUser', $data);
        echo view('Layout/footer', $data);
    }

    function ambilptk()
    {
        //if ($this->request->isAJAX()) {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where("level", 1);
        $query = $builder->get();
        $ptk = $query->getResultArray();
        $data = [
            'ptk' => $ptk,
        ];
        $msg = [
            'data' => view('User/dataPTK', $data)
        ];
        echo json_encode($msg);
        // } else {
        //     exit("Tidak dapat diproses");
        // }
    }
}

<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {
        if (session()->has('loggedAdmin')) {
            return redirect()->to('/Dashboard');
        } elseif (session()->has('loggedSiswa')) {
            return redirect()->to('Siswa/biodata');
        } else {
            return view('Auth/login');
        }
    }

    public function regis_user()
    {
        $values = [
            "username" => "foursma",
            "pass" => Hash::make("Foursma@123"),
            "level" => ("0"),
        ];
        $inputadmin = new UserModel();
        $inputadmin->insert($values);
    }
    public function cek_login()
    {
        $validation = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username Wajib Diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Wajib Diisi'
                ]
            ]
        ]);

        if (!$validation) {
            return view('Auth/login', ['validation' => $this->validator]);
        } else {
            $username = $this->request->getGetPost("username");
            $password = $this->request->getGetPost("password");
            $userModel = new \App\Models\UserModel();
            $siswaModel = new \App\Models\SiswaModel();
            $user_info = $userModel->where("username", $username)->first();
            // $siswa_info = $siswaModel->where("nisn", $username)->first();
            if (isset($user_info['pass']) && isset($user_info['level'])) {
                $cek_password = Hash::cek($password, $user_info['pass']);
                $level = $user_info['level'];
            } else {
                $level = 00;
                $cek_password = false;
            }

            if (!$cek_password) {
                session()->setFlashdata("fail", "gagal");
                return redirect()->to('/')->withInput();
            } elseif ($level == 1) {
                $user_id = $user_info['username'];
                session()->set('loggedSiswa', $user_id);
                // echo $user_id;
                // echo $_SESSION["loggedGuru"];
                return redirect()->to('/Siswa');
            } elseif ($level == 0) {
                $user_id = $user_info['username'];
                $tahun_pelajaran = $this->request->getGetPost("tahun_pelajaran");
                session()->set('loggedAdmin', $user_id);
                session()->set('tahun_pelajaran', $tahun_pelajaran);
                return redirect()->to('/Dashboard');
            }
        }
    }

    public function ambilsession()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => session()->get('loggedSiswa'),
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function logoutAdmin()
    {
        if (session()->has('loggedAdmin')) {
            session()->remove('loggedAdmin');
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }
    function logoutSiswa()
    {
        if (session()->has('loggedSiswa')) {
            session()->remove('loggedSiswa');
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }
}

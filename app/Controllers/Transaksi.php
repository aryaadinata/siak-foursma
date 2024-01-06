<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\TagihanModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Libraries\Hash;

class Transaksi extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    //--------------------------------------------------------------------------

    function tagihan()
    {
        $userModel = new UserModel();
        //$TagihanModel = new TagihanModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $builder = $this->db->table('tagihan');
        $builder->select('*');
        $builder->join('tahun_ajaran', 'tagihan.id_tahun = tahun_ajaran.id_tahun');
        $query = $builder->get();
        $tagihanInfo = $query->getResultArray();
        $data = [
            'title' => "Tagihan",
            'userInfo' => $userInfo,
            'tagihan' => $tagihanInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Transaksi/viewData', $data);
        echo view('Layout/footer', $data);
    }

    function ambiltagihan()
    {
        if ($this->request->isAJAX()) {
            $TagihanModel = new TagihanModel();
            $tagihanInfo = $TagihanModel->findAll();
            $data = [
                'tagihan' => $tagihanInfo,
            ];
            $msg = [
                'data' => view('Transaksi/tabelTagihan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    // function formtambahJurusan()
    // {
    //     if ($this->request->isAJAX()) {

    //         $msg = [
    //             'data' => view('Admin/modaltambahjurusan')
    //         ];
    //         echo json_encode($msg);
    //     } else {
    //         exit("Tidak dapat diproses");
    //     }
    // }

    // function inputjurusan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $validation = \config\Services::validation();
    //         $valid = $this->validate([
    //             'nama_jurusan' => [
    //                 'label' => "Nama Jurusan",
    //                 'rules' => "required",
    //                 'errors' => [
    //                     'required' => '{field} tidak boleh kosong'
    //                 ]
    //             ],
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'nama_jurusan' => $validation->getError('nama_jurusan'),
    //                 ]
    //             ];
    //         } else {
    //             $simpanjurusan = [
    //                 'nama_jurusan' => $this->request->getVar('nama_jurusan'),
    //             ];
    //             $jurusan = new JurusanModel();
    //             $jurusan->insert($simpanjurusan);
    //             $msg = [
    //                 'sukses' => 'Jurusan berhasil disimpan'
    //             ];
    //         }
    //         echo json_encode($msg);
    //     } else {
    //         exit("Tidak Dapat Diproses");
    //     }
    // }

    // function formeditjurusan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id_jurusan = $this->request->getVar('id_jurusan');
    //         $jurusanModel = new JurusanModel();
    //         $jurusan = $jurusanModel->find($id_jurusan);
    //         $data = [
    //             'id_jurusan' => $jurusan['id_jurusan'],
    //             'nama_jurusan' => $jurusan['nama_jurusan'],
    //         ];
    //         $msg = [
    //             'data' => view('Admin/modaleditjurusan', $data)
    //         ];
    //         echo json_encode($msg);
    //     } else {
    //         exit("Tidak dapat diproses");
    //     }
    // }

    // function updatejurusan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $validation = \config\Services::validation();
    //         $valid = $this->validate([
    //             'nama_jurusan' => [
    //                 'label' => "Jurusan",
    //                 'rules' => "required",
    //                 'errors' => [
    //                     'required' => '{field} tidak boleh kosong'
    //                 ]
    //             ],
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'nama_jurusan' => $validation->getError('nama_jurusan'),
    //                 ]
    //             ];
    //         } else {
    //             $id = $this->request->getVar('id_jurusan');
    //             $simpanjurusan = [
    //                 'nama_jurusan' => $this->request->getVar('nama_jurusan'),
    //             ];
    //             $jurusan = new JurusanModel();
    //             $jurusan->update($id, $simpanjurusan);
    //             $msg = [
    //                 'sukses' => 'Jurusan berhasil diperbaharui'
    //             ];
    //         }
    //         echo json_encode($msg);
    //     } else {
    //         exit("Tidak Dapat Diproses");
    //     }
    // }

    // function cekhapusjurusan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $validation = \config\Services::validation();
    //         $id_jurusan = $this->request->getVar('id_jurusan');
    //         $valid = $this->validate([
    //             'id_jurusan' => [
    //                 'label' => "Jurusan",
    //                 'rules' => "is_unique[kelas.id_jurusan]",
    //                 'errors' => [
    //                     'is_unique' => '{field} ini tidak boleh dihapus karena sudah ada kelas yang terdaftar !',
    //                 ]
    //             ],
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'id_jurusan' => $validation->getError('id_jurusan'),
    //                 ]
    //             ];
    //         } else {
    //             $msg = [
    //                 'sukses' => $this->request->getVar('id_jurusan')
    //             ];
    //         }
    //         echo json_encode($msg);
    //     } else {
    //         exit("Tidak Dapat Diproses");
    //     }
    // }

    // public function hapusjurusan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $jurusan = new JurusanModel();
    //         $id = $this->request->getVar('id_jurusan');
    //         $jurusan->delete($id);
    //         $msg = [
    //             'sukses' => 'Jurusan berhasil dihapus !'
    //         ];
    //         echo json_encode($msg);
    //     } else {
    //         exit("Tidak Dapat Diproses");
    //     }
    // }
    //------------------------------------------------------------
}

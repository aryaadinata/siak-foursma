<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Models\PtkModel;
use App\Libraries\Hash;

class Ptk extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function data_guru()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $data = [
            'title' => "Data Guru",
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Ptk/viewPtk', $data);
        echo view('Layout/footer', $data);
    }

    function ambilguru()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('ptk');
            $builder->select('*');
            $builder->where("jenis_ptk", 0);
            $query = $builder->get();
            $guru = $query->getResultArray();
            $data = [
                'guru' => $guru,
            ];
            $msg = [
                'data' => view('Ptk/dataGuru', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function data_pegawai()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $data = [
            'title' => "Data Pegawai",
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Ptk/viewPtk', $data);
        echo view('Layout/footer', $data);
    }

    function ambilpegawai()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('ptk');
            $builder->select('*');
            $builder->where("jenis_ptk", 1);
            $query = $builder->get();
            $data = [
                'pegawai' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Ptk/dataPegawai', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function formtambahguru()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Ptk/modaltambahguru')
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function inputguru()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate(
                [
                    'nik' => [
                        'label' => "NIK",
                        'rules' => "required|is_unique[ptk.nik_ptk]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} sudah terdaftar !',
                        ]
                    ],
                    'nuptk' => [
                        'label' => "NUPTK",
                        'rules' => "required|is_unique[ptk.nuptk]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} sudah terdaftar !',
                        ]
                    ],
                    'nama_ptk' => [
                        'label' => "Nama PTK",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'status_pegawai' => [
                        'label' => "Status Kepegawaian",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'tempat_lahir' => [
                        'label' => "Tempat Lahir",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'tgl_lahir' => [
                        'label' => "Tanggal Lahir",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'jk' => [
                        'label' => "Jenis Kelamin",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'no_hp' => [
                        'label' => "No. HP",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'email' => [
                        'label' => "Email",
                        'rules' => "required|valid_email|is_unique[ptk.email]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !',
                            'valid_email' => '{field} tidak valid !',
                            'is_unique' => '{field} sudah terdaftar !'
                        ]
                    ],
                ]
            );
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nik' => $validation->getError('nik'),
                        'nuptk' => $validation->getError('nuptk'),
                        'nama_ptk' => $validation->getError('nama_ptk'),
                        'status_pegawai' => $validation->getError('status_pegawai'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jk' => $validation->getError('jk'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                    ]
                ];
            } else {
                $simpanptk = [
                    'nik_ptk' => $this->request->getVar('nik'),
                    'nama_ptk' => $this->request->getVar('nama_ptk'),
                    'gelar_depan' => $this->request->getVar('gelar_depan'),
                    'gelar_belakang' => $this->request->getVar('gelar_belakang'),
                    'jenis_ptk' => 0,
                    'nip' => $this->request->getVar('nip'),
                    'nuptk' => $this->request->getVar('nuptk'),
                    'tmp_lahir_ptk' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir_ptk' => $this->request->getVar('tgl_lahir'),
                    'jk_ptk' => $this->request->getVar('jk'),
                    'agama_ptk' => $this->request->getVar('agama'),
                    'alamat_ptk' => $this->request->getVar('alamat'),
                    'no_hp_ptk' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'status_pegawai' => $this->request->getVar('status_pegawai'),
                ];
                $ptk = new PtkModel();
                $ptk->insert($simpanptk);
                $msg = [
                    'sukses' => 'Data guru berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function detailguru($nik)
    {
        $uri = service('uri');
        $ptkModel = new PTKModel();
        $ptk = $ptkModel->find($nik);
        if ($uri->getSegment(1) == "lihatguru") {
            $title = "Detail Guru";
        } else {
            $title = "Detail Pegawai";
        }
        $data = [
            'title' => $title,
            'ptk' => $ptk,
            //'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Ptk/viewDetailPtk', $data);
        echo view('Layout/footer', $data);
    }

    public function formeditptk()
    {
        if ($this->request->isAJAX()) {
            $nik = $this->request->getVar('nik');
            $builder = $this->db->table('ptk');
            $builder->select('*');
            $builder->where("nik_ptk", $nik);
            $query = $builder->get();
            $ptk = $query->getResultArray();
            $data = [
                'ptk' => $ptk,
                //'tanggal_indo' => $this->tanggal_indo($ptk[0]["tanggal_lahir"]),
            ];
            $msg = [
                'data' => view('Ptk/editPtk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function updateptk()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate(
                [
                    'nuptk' => [
                        'label' => "NUPTK",
                        'rules' => "is_unique[ptk.nuptk,nik_ptk,{nik_ptk}]",
                        'errors' => [
                            'is_unique' => '{field} sudah terdaftar !'
                        ]
                    ],
                    'nama_ptk' => [
                        'label' => "Nama PTK",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'status_pegawai' => [
                        'label' => "Status Kepegawaian",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'tempat_lahir' => [
                        'label' => "Tempat Lahir",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'tgl_lahir' => [
                        'label' => "Tanggal Lahir",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'jk' => [
                        'label' => "Jenis Kelamin",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'no_hp' => [
                        'label' => "No. HP",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'email' => [
                        'label' => "Email",
                        'rules' => "required|valid_email|is_unique[ptk.email,nik_ptk,{nik_ptk}]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !',
                            'valid_email' => '{field} tidak valid !',
                            'is_unique' => '{field} sudah digunakan !'
                        ]
                    ],
                ]
            );
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nuptk' => $validation->getError('nuptk'),
                        'nama_ptk' => $validation->getError('nama_ptk'),
                        'status_pegawai' => $validation->getError('status_pegawai'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jk' => $validation->getError('jk'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                    ]
                ];
            } else {
                $nik = $this->request->getVar('nik_ptk');
                $simpanptk = [
                    'nik_ptk' => $this->request->getVar('nik_ptk'),
                    'nama_ptk' => $this->request->getVar('nama_ptk'),
                    'gelar_depan' => $this->request->getVar('gelar_depan'),
                    'gelar_belakang' => $this->request->getVar('gelar_belakang'),
                    'nip' => $this->request->getVar('nip'),
                    'nuptk' => $this->request->getVar('nuptk'),
                    'tmp_lahir_ptk' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir_ptk' => $this->request->getVar('tgl_lahir'),
                    'jk_ptk' => $this->request->getVar('jk'),
                    'agama_ptk' => $this->request->getVar('agama'),
                    'alamat_ptk' => $this->request->getVar('alamat'),
                    'no_hp_ptk' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'status_pegawai' => $this->request->getVar('status_pegawai'),
                ];
                $ptk = new PtkModel();
                $ptk->update($nik, $simpanptk);
                $msg = [
                    'sukses' => 'Data siswa berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function ambildetailptk($nik)
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('ptk');
            $builder->select('*');
            $builder->where("nik_ptk", $nik);
            $query = $builder->get();
            $ptk = $query->getResultArray();
            if ($ptk[0]["tgl_lahir_ptk"] != 0) {
                $tanggal_indo = $this->tanggal_indo($ptk[0]["tgl_lahir_ptk"]);
            } else {
                $tanggal_indo = "";
            }
            $data = [
                'ptk' => $ptk,
                'tanggal_indo' => $tanggal_indo,
            ];
            $msg = [
                'data' => view('Ptk/detailPtk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function uploadfoto()
    {
        $uri = service('uri');
        $nik = $this->request->getVar("nik_ptk");
        $validation = \config\Services::validation();
        $valid = $this->validate([
            'foto' => [
                'label' => "Foto",
                'rules' => 'uploaded[foto]|ext_in[foto,jpg]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} Terlebih Dahulu !',
                    'ext_in' => '{field} harus ekstensi jpg',
                    'max_size' => 'Size {field} maksimal 1 MB',
                    'mime_in' => 'File yang dipilih bukan gambar',
                ]
            ],
        ]);
        if (!$valid) {
            $this->session->setFlashdata('foto', $validation->getError('foto'));
            if ($this->request->getVar("jenis_ptk") == 0) {
                return redirect()->to('/lihatguru/' . $nik);
            } else {
                return redirect()->to('/lihatpegawai/' . $nik);
            }
        } else {
            $foto = $this->request->getFile('foto');
            $ext = $foto->getClientExtension();
            $ptkModel = new PtkModel();
            $namaFoto = $nik . "." . $ext;
            $foto->move("dist/img/pasfotoptk", $namaFoto, true);
            //$foto->move("dist/img/pasfoto" . 'uploads', null, true);

            $simpandata = [
                'foto' => $namaFoto,
            ];
            $ptkModel->update($nik, $simpandata);

            $this->session->setFlashdata('suksesupload', "Upload Foto Berhasil");
            if ($this->request->getVar("jenis_ptk") == 0) {
                return redirect()->to('/lihatguru/' . $nik);
            } else {
                return redirect()->to('/lihatpegawai/' . $nik);
            }
        }
    }

    function formtambahpegawai()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Ptk/modaltambahpegawai')
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function inputpegawai()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate(
                [
                    'nik' => [
                        'label' => "NIK",
                        'rules' => "required|is_unique[ptk.nik_ptk]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} sudah terdaftar !',
                        ]
                    ],
                    'nuptk' => [
                        'label' => "NUPTK",
                        'rules' => "required|is_unique[ptk.nuptk]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} sudah terdaftar !',
                        ]
                    ],
                    'nama_ptk' => [
                        'label' => "Nama PTK",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'status_pegawai' => [
                        'label' => "Status Kepegawaian",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'tempat_lahir' => [
                        'label' => "Tempat Lahir",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'tgl_lahir' => [
                        'label' => "Tanggal Lahir",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'jk' => [
                        'label' => "Jenis Kelamin",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'no_hp' => [
                        'label' => "No. HP",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                    'email' => [
                        'label' => "Email",
                        'rules' => "required|valid_email|is_unique[ptk.email]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !',
                            'valid_email' => '{field} tidak valid !',
                            'is_unique' => '{field} sudah terdaftar !'
                        ]
                    ],
                ]
            );
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nik' => $validation->getError('nik'),
                        'nuptk' => $validation->getError('nuptk'),
                        'nama_ptk' => $validation->getError('nama_ptk'),
                        'status_pegawai' => $validation->getError('status_pegawai'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jk' => $validation->getError('jk'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                    ]
                ];
            } else {
                $simpanptk = [
                    'nik_ptk' => $this->request->getVar('nik'),
                    'nama_ptk' => $this->request->getVar('nama_ptk'),
                    'gelar_depan' => $this->request->getVar('gelar_depan'),
                    'gelar_belakang' => $this->request->getVar('gelar_belakang'),
                    'jenis_ptk' => 1,
                    'nip' => $this->request->getVar('nip'),
                    'nuptk' => $this->request->getVar('nuptk'),
                    'tmp_lahir_ptk' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir_ptk' => $this->request->getVar('tgl_lahir'),
                    'jk_ptk' => $this->request->getVar('jk'),
                    'agama_ptk' => $this->request->getVar('agama'),
                    'alamat_ptk' => $this->request->getVar('alamat'),
                    'no_hp_ptk' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'status_pegawai' => $this->request->getVar('status_pegawai'),
                ];
                $ptk = new PtkModel();
                $ptk->insert($simpanptk);
                $msg = [
                    'sukses' => 'Data pegawai berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function formimportsiswa()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Admin/modalimport')
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function importptk()
    {
        $validation = \config\Services::validation();
        $valid = $this->validate([
            'ptk' => [
                'label' => "File",
                'rules' => 'uploaded[ptk]|ext_in[ptk,xls,xlsx]',
                'errors' => [
                    'uploaded' => 'Pilih {field} Terlebih Dahulu !',
                    'ext_in' => '{field} harus ekstensi xls atau xlsx',
                ]
            ],
        ]);
        if (!$valid) {
            $this->session->setFlashdata('ptk', $validation->getError('ptk'));
            if ($this->request->getVar("jenis_ptk") == 0) {
                return redirect()->to('/importguru');
            } else {
                return redirect()->to('/importpegawai');
            }
        } else {
            $file_excel = $this->request->getFile('ptk');
            $ext = $file_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();
            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }
                $simpanptk = [
                    'nik_ptk' => $row[0],
                    'nama_ptk' => $row[1],
                    'gelar_depan' => $row[2],
                    'gelar_belakang' => $row[3],
                    'jenis_ptk' => $this->request->getVar("jenis_ptk"),
                    'status_pegawai' => $row[4],
                    'nip' => $row[5],
                    'nuptk' => $row[6],
                    'tmp_lahir_ptk' => $row[7],
                    'tgl_lahir_ptk' => $row[8],
                    'jk_ptk' => $row[9],
                    'agama_ptk' => $row[10],
                    'alamat_ptk' => $row[11],
                    'no_hp_ptk' => $row[12],
                    'email' => $row[13],
                ];
                $ptk = new PtkModel();
                $ptk->insert($simpanptk);
            }
            $this->session->setFlashdata('suksesimport', "Import PTK Berhasil");
            if ($this->request->getVar("jenis_ptk") == 0) {
                return redirect()->to('/importguru');
            } else {
                return redirect()->to('/importpegawai');
            }
        }
    }

    function viewimport()
    {
        $uri = service('uri');
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $jurusanModel = new JurusanModel();
        $jurusan = $jurusanModel->findAll();
        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();
        if ($uri->getSegment(1) == "importguru") {
            $jenis_ptk = 0;
        } else {
            $jenis_ptk = 1;
        }
        $data = [
            'title' => "Import PTK | SKL Foursma",
            'jenis_ptk' => $jenis_ptk,
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Ptk/importptk', $data);
        echo view('Layout/footer', $data);
    }

    function cekhapusguru()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $nik = $this->request->getVar('nik');
            $valid = $this->validate([
                'wali' => [
                    'label' => "Guru",
                    'rules' => "is_unique[kelas.wali_kelas]",
                    'errors' => [
                        'is_unique' => '{field} ini tidak boleh dihapus karena berstatus sebagai wali kelas !',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'wali' => $validation->getError('wali'),
                    ]
                ];
            } else {
                $msg = [
                    'sukses' => $this->request->getVar('nik')
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function hapusptk()
    {
        if ($this->request->isAJAX()) {
            $ptk = new PtkModel();
            $id = $this->request->getVar('nik');
            $ptk->delete($id);
            $msg = [
                'sukses' => 'PTK berhasil dihapus !'
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    private function tanggal_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
    }

    private function tanggal_balik($tanggal)
    {
        $bulan = array(
            'Januari' => "01",
            'Februari' => "02",
            'Maret' => "03",
            'April' => "04",
            'Mei' => "05",
            'Juni' => "06",
            'Juli' => "07",
            'Agustus' => "08",
            'September' => "09",
            'Oktober' => "10",
            'November' => "11",
            'Desember' => "12",
        );
        $split = explode(' ', $tanggal);
        //echo $split[2];
        return $split[2] . '-' . $bulan[$split[1]] . '-' . $split[0];
    }

    private function tanggal_password($tanggal)
    {
        $split = explode('-', $tanggal);
        return $split[2] . $split[1] . $split[0];
    }

    //--------------------------------------------------------------------------

    function tahun_ajaran()
    {
        $userModel = new UserModel();
        $tahunModel = new TahunModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $tahun_ajaran = $tahunModel->findAll();
        $data = [
            'title' => "Tahun Ajaran",
            'userInfo' => $userInfo,
            'tahun_ajaran' => $tahun_ajaran,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewData', $data);
        echo view('Layout/footer', $data);
    }

    function ambiltahun()
    {
        if ($this->request->isAJAX()) {
            $tahunModel = new TahunModel();
            $tahunInfo = $tahunModel->findAll();
            $data = [
                'tahun_ajaran' => $tahunInfo,
            ];
            $msg = [
                'data' => view('Admin/tabelTahunAjaran', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function formtambahtahun()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'data' => view('Admin/modaltambahtahun')
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function inputtahun()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'tahun_awal' => [
                    'label' => "Tahun Awal",
                    'rules' => "required|is_unique[tahun_ajaran.tahun_awal]",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada !'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tahun_awal' => $validation->getError('tahun_awal'),
                    ]
                ];
            } else {
                $tahun = $this->request->getVar('tahun_awal');
                $simpantahun = [
                    'tahun_awal' => $tahun,
                    'tahun_akhir' => $tahun + 1,
                ];
                $tahun = new TahunModel();
                $tahun->insert($simpantahun);
                $msg = [
                    'sukses' => 'Tahun ajaran berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function formedittahun()
    {
        if ($this->request->isAJAX()) {
            $id_tahun = $this->request->getVar('id_tahun');
            $tahunModel = new TahunModel();
            $tahun = $tahunModel->find($id_tahun);
            $data = [
                'id_tahun' => $tahun['id_tahun'],
                'tahun_awal' => $tahun['tahun_awal'],
            ];
            $msg = [
                'data' => view('Admin/modaledittahun', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function updatetahun()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'tahun_awal' => [
                    'label' => "Tahun Awal",
                    'rules' => "required|is_unique[tahun_ajaran.tahun_awal]",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada !'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tahun_awal' => $validation->getError('tahun_awal'),
                    ]
                ];
            } else {
                $id_tahun = $this->request->getVar('id_tahun');
                $tahun_awal = $this->request->getVar('tahun_awal');
                $simpantahun = [
                    'tahun_awal' => $tahun_awal,
                    'tahun_akhir' => $tahun_awal + 1,
                ];
                $tahun = new TahunModel();
                $tahun->update($id_tahun, $simpantahun);
                $msg = [
                    'sukses' => 'Tahun Ajaran berhasil diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }



    public function hapustahun()
    {
        if ($this->request->isAJAX()) {
            $tahun = new TahunModel();
            $id = $this->request->getVar('id_tahun');
            $tahun->delete($id);
            $msg = [
                'sukses' => 'Tahun Ajaran berhasil dihapus !'
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    //--------------------------------------------------------------------------

    function jurusan()
    {
        $userModel = new UserModel();
        $JurusanModel = new JurusanModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $jurusanInfo = $JurusanModel->findAll();
        $data = [
            'title' => "Jurusan",
            'userInfo' => $userInfo,
            'jurusan' => $jurusanInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewData', $data);
        echo view('Layout/footer', $data);
    }

    function ambiljurusan()
    {
        if ($this->request->isAJAX()) {
            $JurusanModel = new JurusanModel();
            $jurusanInfo = $JurusanModel->findAll();
            $data = [
                'jurusan' => $jurusanInfo,
            ];
            $msg = [
                'data' => view('Admin/tabelJurusan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function formtambahJurusan()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'data' => view('Admin/modaltambahjurusan')
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function inputjurusan()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_jurusan' => [
                    'label' => "Nama Jurusan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_jurusan' => $validation->getError('nama_jurusan'),
                    ]
                ];
            } else {
                $simpanjurusan = [
                    'nama_jurusan' => $this->request->getVar('nama_jurusan'),
                ];
                $jurusan = new JurusanModel();
                $jurusan->insert($simpanjurusan);
                $msg = [
                    'sukses' => 'Jurusan berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function formeditjurusan()
    {
        if ($this->request->isAJAX()) {
            $id_jurusan = $this->request->getVar('id_jurusan');
            $jurusanModel = new JurusanModel();
            $jurusan = $jurusanModel->find($id_jurusan);
            $data = [
                'id_jurusan' => $jurusan['id_jurusan'],
                'nama_jurusan' => $jurusan['nama_jurusan'],
            ];
            $msg = [
                'data' => view('Admin/modaleditjurusan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function updatejurusan()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_jurusan' => [
                    'label' => "Jurusan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_jurusan' => $validation->getError('nama_jurusan'),
                    ]
                ];
            } else {
                $id = $this->request->getVar('id_jurusan');
                $simpanjurusan = [
                    'nama_jurusan' => $this->request->getVar('nama_jurusan'),
                ];
                $jurusan = new JurusanModel();
                $jurusan->update($id, $simpanjurusan);
                $msg = [
                    'sukses' => 'Jurusan berhasil diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function cekhapusjurusan()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $id_jurusan = $this->request->getVar('id_jurusan');
            $valid = $this->validate([
                'id_jurusan' => [
                    'label' => "Jurusan",
                    'rules' => "is_unique[kelas.id_jurusan]",
                    'errors' => [
                        'is_unique' => '{field} ini tidak boleh dihapus karena sudah ada kelas yang terdaftar !',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_jurusan' => $validation->getError('id_jurusan'),
                    ]
                ];
            } else {
                $msg = [
                    'sukses' => $this->request->getVar('id_jurusan')
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function hapusjurusan()
    {
        if ($this->request->isAJAX()) {
            $jurusan = new JurusanModel();
            $id = $this->request->getVar('id_jurusan');
            $jurusan->delete($id);
            $msg = [
                'sukses' => 'Jurusan berhasil dihapus !'
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }
    //------------------------------------------------------------

    public function kenaikan()
    {
        $userModel = new UserModel();
        //$KelasModel = new KelasModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $builder = $this->db->table('kelas');
        $builder->select('*');
        //$builder->where("id_tingkat <", 3);
        $query = $builder->get();
        $kelas = $query->getResultArray();
        $data = [
            'title' => "Kenaikan / Mutasi Kelas",
            'userInfo' => $userInfo,
            'kelasasal' => $kelas,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewKenaikan', $data);
        echo view('Layout/footer', $data);
    }

    public function naikkan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_tujuan');
            $nisn = $this->request->getVar('naikkelas');
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'id_tujuan' => [
                    'label' => "Kelas Tujuan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
                'naikkelas' => [
                    'label' => "Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tujuan' => $validation->getError('id_tujuan'),
                        'siswa' => $validation->getError('naikkelas'),
                    ]
                ];
            } else {
                for ($i = 0; $i < count($nisn); $i++) {
                    //echo $row . "";
                    $naikkelas = [
                        'id_kelas' => $id,
                    ];
                    $siswa = new SiswaModel();
                    $siswa->update($nisn[$i], $naikkelas);
                }
                $msg = [
                    'sukses' => 'Proses kenaikan kelas berhasil !'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function kembalikan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_asal');
            $nisn = $this->request->getVar('naikkelas');
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'id_asal' => [
                    'label' => "Kelas Asal",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
                'naikkelas' => [
                    'label' => "Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'asal' => $validation->getError('id_asal'),
                        'siswa' => $validation->getError('naikkelas'),
                    ]
                ];
            } else {
                for ($i = 0; $i < count($nisn); $i++) {
                    $naikkelas = [
                        'id_kelas' => $id,
                    ];
                    $siswa = new SiswaModel();
                    $siswa->update($nisn[$i], $naikkelas);
                }
                $msg = [
                    'sukses' => 'Proses pengembalian berhasil !'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }
    //--------------------------------------------------

    public function kelulusan()
    {
        $userModel = new UserModel();
        //$KelasModel = new KelasModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $builder = $this->db->table('kelas');
        $builder->select('*');
        $builder->where("id_tingkat", 3);
        $query = $builder->get();
        $kelas = $query->getResultArray();
        $builder = $this->db->table('tahun_ajaran');
        $builder->select('*');
        $builder->where("id_tahun", 4);
        $query = $builder->get();
        $tahunInfo = $query->getResultArray();
        $tahunModel = new TahunModel();
        $tahunInfo = $tahunModel->findAll();
        $data = [
            'title' => "Kelulusan",
            'userInfo' => $userInfo,
            'kelasasal' => $kelas,
            'tahun' => $tahunInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewKelulusan', $data);
        echo view('Layout/footer', $data);
    }

    public function luluskan()
    {
        if ($this->request->isAJAX()) {
            $id_tahun = $this->request->getVar('id_tahun');
            $nisn = $this->request->getVar('naikkelas');
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'id_tahun' => [
                    'label' => "Tahun Lulus",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
                'naikkelas' => [
                    'label' => "Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'siswa' => $validation->getError('naikkelas'),
                        'tahun' => $validation->getError('id_tahun'),
                    ]
                ];
            } else {
                for ($i = 0; $i < count($nisn); $i++) {
                    //echo $row . "";
                    $lulus = [
                        'status' => 0,
                        'ket' => 2,
                        'tahun' => $id_tahun,
                    ];
                    $siswa = new SiswaModel();
                    $siswa->update($nisn[$i], $lulus);
                }
                $msg = [
                    'sukses' => 'Proses kelulusan kelas berhasil !'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function batallulus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_asal');
            $nisn = $this->request->getVar('naikkelas');
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'naikkelas' => [
                    'label' => "Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'siswa' => $validation->getError('naikkelas'),
                    ]
                ];
            } else {
                for ($i = 0; $i < count($nisn); $i++) {
                    $naikkelas = [
                        'status' => 1,
                        'ket' => 1,
                        'tahun' => "",
                    ];
                    $siswa = new SiswaModel();
                    $siswa->update($nisn[$i], $naikkelas);
                }
                $msg = [
                    'sukses' => 'Proses pembatalan kelulusan berhasil, siswa telah dikembalikan ke kelas masing-masing !'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    //--------------------------------------------------

    function kelas()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $data = [
            'title' => "Kelas",
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewData', $data);
        echo view('Layout/footer', $data);
    }

    function ambilkelas()
    {
        if ($this->request->isAJAX()) {
            //$kelasModel = new KelasModel();
            //$kelasInfo = $kelasModel->findAll();
            $builder = $this->db->table('kelas');
            $builder->select('*');
            $builder->join('tingkat', 'kelas.id_tingkat = tingkat.id_tingkat');
            $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
            $builder->join('ptk', 'ptk.nik_ptk = kelas.wali_kelas');
            $query = $builder->get();
            $data = [
                'kelas' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Admin/tabelKelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function formtambahKelas()
    {
        if ($this->request->isAJAX()) {
            $jurusanModel = new JurusanModel();
            $jurusan = $jurusanModel->findAll();
            $builder = $this->db->table('ptk');
            $builder->select('*');
            $builder->where("jenis_ptk", 0);
            $query = $builder->get();
            $wali = $query->getResultArray();
            $data = [
                'jurusan' => $jurusan,
                'wali' => $wali,
            ];
            $msg = [
                'data' => view('Admin/modaltambahkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function inputkelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_kelas' => [
                    'label' => "Nama Jurusan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tingkat' => [
                    'label' => "Tingkat",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'jurusan' => [
                    'label' => "Jurusan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'wali_kelas' => [
                    'label' => "Wali Kelas",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'tingkat' => $validation->getError('tingkat'),
                        'jurusan' => $validation->getError('jurusan'),
                        'wali_kelas' => $validation->getError('wali_kelas'),
                    ]
                ];
            } else {
                $simpankelas = [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'id_tingkat' => $this->request->getVar('tingkat'),
                    'id_jurusan' => $this->request->getVar('jurusan'),
                    'wali_kelas' => $this->request->getVar('wali_kelas'),
                ];
                $kelas = new KelasModel();
                $kelas->insert($simpankelas);
                $msg = [
                    'sukses' => 'Kelas berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function formeditkelas()
    {
        if ($this->request->isAJAX()) {
            $id_kelas = $this->request->getVar('id_kelas');
            $jurusanModel = new JurusanModel();
            $kelasModel = new KelasModel();
            $kelas = $kelasModel->find($id_kelas);
            $jurusan = $jurusanModel->findAll();
            $builder = $this->db->table('ptk');
            $builder->select('*');
            $builder->where("jenis_ptk", 0);
            $query = $builder->get();
            $wali = $query->getResultArray();
            $data = [
                'id_kelas' => $id_kelas,
                'nama_kelas' => $kelas['nama_kelas'],
                'id_tingkat' => $kelas['id_tingkat'],
                'id_jurusan' => $kelas['id_jurusan'],
                'wali_kelas' => $kelas['wali_kelas'],
                'jurusan' => $jurusan,
                'wali' => $wali,
            ];
            $msg = [
                'data' => view('Admin/modaleditkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function updatekelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_kelas' => [
                    'label' => "Kelas",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tingkat' => [
                    'label' => "Tingkat",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'jurusan' => [
                    'label' => "Jurusan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'wali_kelas' => [
                    'label' => "Wali Kelas",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'tingkat' => $validation->getError('tingkat'),
                        'jurusan' => $validation->getError('jurusan'),
                        'wali_kelas' => $validation->getError('wali_kelas'),
                    ]
                ];
            } else {
                $id = $this->request->getVar('id_kelas');
                $simpankelas = [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'id_tingkat' => $this->request->getVar('tingkat'),
                    'id_jurusan' => $this->request->getVar('jurusan'),
                    'wali_kelas' => $this->request->getVar('wali_kelas'),
                ];
                $kelas = new KelasModel();
                $kelas->update($id, $simpankelas);
                $msg = [
                    'sukses' => 'Kelas berhasil diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function cekhapuskelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $id_kelas = $this->request->getVar('id_kelas');
            $valid = $this->validate([
                'id_kelas' => [
                    'label' => "Kelas",
                    'rules' => "is_unique[siswa.id_kelas]",
                    'errors' => [
                        'is_unique' => '{field} ini tidak boleh dihapus karena sudah ada siswa yang terdaftar !',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_kelas' => $validation->getError('id_kelas'),
                    ]
                ];
            } else {
                $msg = [
                    'sukses' => $this->request->getVar('id_kelas')
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function hapuskelas()
    {
        if ($this->request->isAJAX()) {
            $kelas = new KelasModel();
            $id = $this->request->getVar('id_kelas');
            $kelas->delete($id);
            $msg = [
                'sukses' => 'Kelas berhasil dihapus !'
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    //-----------------------------------------------
    public function pilihkelas()
    {
        if ($this->request->isAJAX()) {
            $id_jurusan = $this->request->getVar('id_jurusan');
            $id_tingkat = $this->request->getVar('id_tingkat');
            $builder = $this->db->table('kelas');
            $builder->select('*');
            $builder->where("id_jurusan", $id_jurusan);
            $builder->where("id_tingkat", $id_tingkat);
            $query = $builder->get();
            $kelas = $query->getResultArray();
            $data = "<option disabled selected value=''>--Pilih Kelas--</option>";
            foreach ($kelas as $row) {
                //echo $row["id_kelas"]." ";
                $data .= "<option value='" . $row['id_kelas'] . "'>" . $row['nama_kelas'] . "</option>";
            }
            echo json_encode($data);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function pilihjurusan()
    {
        if ($this->request->isAJAX()) {
            //$id_jurusan = $this->request->getVar('id_jurusan');
            $JurusanModel = new JurusanModel();
            $jurusan = $JurusanModel->findAll();
            $data = "<option disabled selected value=''>--Pilih Jurusan--</option>";
            foreach ($jurusan as $row) {
                $data .= "<option value='" . $row['id_jurusan'] . "'>" . $row['nama_jurusan'] . "</option>";
            }
            echo json_encode($data);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function kelastujuan()
    {
        if ($this->request->isAJAX()) {
            $id_kelas = $this->request->getVar('id_kelas');
            $kelasModel = new KelasModel();
            $kelas = $kelasModel->where('id_kelas', $id_kelas)->first();
            $builder = $this->db->table('kelas');
            $builder->select('*');
            // $builder->where("id_jurusan", $kelas['id_jurusan']);
            // $builder->where("id_tingkat", $kelas['id_tingkat']);
            $builder->where("id_kelas !=", $kelas['id_kelas']);
            $query = $builder->get();
            $kelas = $query->getResultArray();
            $data = "<option value='' disabled selected value=''>--Pilih Kelas--</option>";
            foreach ($kelas as $row) {
                //echo $row["id_kelas"]." ";
                $data .= "<option value='" . $row['id_kelas'] . "'>" . $row['nama_kelas'] . "</option>";
            }
            echo json_encode($data);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function tahun()
    {
        if ($this->request->isAJAX()) {
            $tahunModel = new TahunModel();
            $tahun = $tahunModel->findAll();
            $data = "<option value='' disabled selected value=''>--Pilih Tahun--</option>";
            foreach ($tahun as $row) {
                //echo $row["id_kelas"]." ";
                $data .= "<option value='" . $row['tahun_akhir'] + 1 . "'>" . $row['tahun_akhir'] . "</option>";
            }
            echo json_encode($data);
        } else {
            exit("Tidak dapat diproses");
        }
    }
}

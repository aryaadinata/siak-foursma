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
            $data = [
                'guru' => $query->getResultArray()
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

    function formedit()
    {
        if ($this->request->isAJAX()) {
            $nisn = $this->request->getVar('nisn');
            $siswaModel = new SiswaModel();
            $siswa = $siswaModel->find($nisn);
            $kelasModel = new KelasModel();
            $kelas = $kelasModel->findAll();
            $data = [
                'nisn' => $siswa['nisn'],
                'nama' => $siswa['nama'],
                'id_kelas' => $siswa['id_kelas'],
                'kelas' => $kelas,
            ];
            $msg = [
                'data' => view('Admin/modaledit', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function updatesiswa()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_siswa' => [
                    'label' => "Nama Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'kelas' => [
                    'label' => "Kelaas",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_siswa' => $validation->getError('nama_siswa'),
                        'kelas' => $validation->getError('kelas')
                    ]
                ];
            } else {
                $id = $this->request->getVar('nisn');
                $simpansiswa = [
                    'nama' => $this->request->getVar('nama_siswa'),
                    'id_kelas' => $this->request->getVar('kelas'),
                ];
                $siswa = new SiswaModel();
                $siswa->update($id, $simpansiswa);
                $msg = [
                    'sukses' => 'Data siswa berhasil diperbaharui'
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

    public function importsiswa()
    {
        $validation = \config\Services::validation();
        $valid = $this->validate([
            'jurusan' => [
                'label' => "Jurusan",
                'rules' => "required",
                'errors' => [
                    'required' => 'Pilih {field} Terlebih Dahulu !'
                ]
            ],
            'kelas' => [
                'label' => "Kelas",
                'rules' => "required",
                'errors' => [
                    'required' => 'Pilih {field} Terlebih Dahulu !',
                ]
            ],
            'siswa' => [
                'label' => "File",
                'rules' => 'uploaded[siswa]|ext_in[siswa,xls,xlsx]',
                'errors' => [
                    'uploaded' => 'Pilih {field} Terlebih Dahulu !',
                    'ext_in' => '{field} harus ekstensi xls atau xlsx',
                ]
            ],
        ]);
        if (!$valid) {
            $this->session->setFlashdata('jurusan', $validation->getError('jurusan'));
            $this->session->setFlashdata('kelas', $validation->getError('kelas'));
            $this->session->setFlashdata('siswa', $validation->getError('siswa'));
            return redirect()->to('/Admin/viewimport');
        } else {
            $file_excel = $this->request->getFile('siswa');
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
                $simpansiswa = [
                    'nisn' => $row[0],
                    'nama' => $row[1],
                    'id_kelas' => $this->request->getVar('kelas'),
                ];
                $simpanuser = [
                    'id' => $row[0],
                    "password" => Hash::make($row[0]),
                    "level" => "1",
                ];
                $siswa = new SiswaModel();
                $siswa->save($simpansiswa);
                $user = new UserModel();
                $user->save($simpanuser);
            }
            $this->session->setFlashdata('suksesimport', "Import Siswa Berhasil");
            return redirect()->to('/Admin/viewimport');
        }
    }

    function viewimport()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $jurusanModel = new JurusanModel();
        $jurusan = $jurusanModel->findAll();
        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();
        $data = [
            'title' => "Data Siswa | SKL Foursma",
            'userInfo' => $userInfo,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/importsiswa', $data);
        echo view('Layout/footer', $data);
    }

    public function inputsiswa()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate(
                [
                    'nisn' => [
                        'label' => "NISN",
                        'rules' => "required|is_unique[siswa.nisn]",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} sudah terdaftar !',
                        ]
                    ],
                    'nama_siswa' => [
                        'label' => "Nama Siswa",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} tidak boleh kosong !'
                        ]
                    ],
                ]
            );
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nisn' => $validation->getError('nisn'),
                        'nama_siswa' => $validation->getError('nama_siswa'),
                    ]
                ];
            } else {
                $simpansiswa = [
                    'nisn' => $this->request->getVar('nisn'),
                    'nama' => $this->request->getVar('nama_siswa'),
                    'id_kelas' => $this->request->getVar('kelas'),
                    'status' => 1,
                    'ket' => 1,
                ];
                $password = $this->request->getVar('nisn');
                $simpanuser = [
                    'id' => $this->request->getVar('nisn'),
                    "password" => Hash::make($password),
                    "level" => "1",
                ];
                $siswa = new SiswaModel();
                $siswa->insert($simpansiswa);
                $user = new UserModel();
                $user->insert($simpanuser);
                $msg = [
                    'sukses' => 'Data siswa berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function hapussiswa()
    {
        if ($this->request->isAJAX()) {
            $siswa = new SiswaModel();
            $user = new UserModel();
            $id = $this->request->getVar('nisn');
            $siswa->delete($id);
            $user->delete($id);
            $msg = [
                'sukses' => 'Data siswa berhasil dihapus !'
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

    function cekhapustahun()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $id_tahun = $this->request->getVar('id_tahun');
            $valid = $this->validate([
                'tahun_ajaran' => [
                    'label' => "Tahun Ajaran",
                    'rules' => "is_unique[siswa.id_tahun]",
                    'errors' => [
                        'is_unique' => '{field} ini tidak boleh dihapus karena sudah ada data yang terdaftar !',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tahun_ajaran' => $validation->getError('tahun_ajaran'),
                    ]
                ];
            } else {
                $msg = [
                    'sukses' => $this->request->getVar('id_tahun')
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

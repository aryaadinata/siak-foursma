<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Models\PtkModel;
use App\Libraries\Hash;

class Admin extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function buat_user()
    {
        $simpanuser = [
            'username' => "12121212",
            "pass" => Hash::make("1234567890"),
            "level" => "1",
        ];
        $user = new UserModel();
        $user->insert($simpanuser);
    }

    public function data_siswa()
    {
        $userModel = new UserModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        $data = [
            'title' => "Data Siswa",
            'userInfo' => $userInfo,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewSiswa', $data);
        echo view('Layout/footer', $data);
    }

    function ambildata()
    {
        if ($this->request->isAJAX()) {
            $id_tingkat = $this->request->getVar('id_tingkat');
            $id_jurusan = $this->request->getVar('id_jurusan');
            $id_kelas = $this->request->getVar('id_kelas');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
            //$builder->join('tahun_ajaran', 'siswa.id_tahun = tahun_ajaran.id_tahun');
            $builder->orderby('siswa.id_kelas,nama', 'ASC');
            $builder->where("status_aktif", 0);
            $query = $builder->get();
            $data = [
                'siswa' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Admin/datasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function ambildata1()
    {
        if ($this->request->isAJAX()) {
            $id_kelas = $this->request->getVar('id_kelas');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
            $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
            $builder->where("siswa.id_kelas", $id_kelas);
            $builder->where("status_aktif", 0);
            $builder->orderby('siswa.nama', 'ASC');
            $query = $builder->get();
            $data = [
                'siswa' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Admin/tabelSiswa1', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function ambildata2()
    {
        if ($this->request->isAJAX()) {
            //$id_kelas = $this->request->getVar('id_kelas');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
            $builder->where("siswa.id_kelas IS NULL");
            $builder->where("status_aktif", 0);
            $builder->orderby('siswa.nama', 'ASC');
            $query = $builder->get();
            $data = [
                'siswa' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Admin/tabelSiswa2', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function ambildatalulus()
    {
        if ($this->request->isAJAX()) {
            $id_tahun = $this->request->getVar('id_tahun');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
            $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
            $builder->where("status_aktif", 1);
            $builder->where("tahun_out", $id_tahun);
            $query = $builder->get();
            $data = [
                'siswa' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Admin/tabelSiswaLulus', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function modalsiswa()
    {
        if ($this->request->isAJAX()) {
            $id_kelas = $this->request->getVar('id_kelas');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
            $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
            $builder->where("siswa.id_kelas", $id_kelas);
            $query = $builder->get();
            $kelasModel = new KelasModel();
            $kelas = $kelasModel->where('id_kelas', $id_kelas)->first();
            $data = [
                'nama_kelas' => $kelas['nama_kelas'],
                'siswa' => $query->getResultArray()
            ];
            $msg = [
                'data' => view('Admin/modalsiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function formtambahsiswa()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('kelas');
            $builder->select('*');
            $builder->join('tingkat', 'kelas.id_tingkat = tingkat.id_tingkat');
            $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
            $builder->join('ptk', 'ptk.nik_ptk = kelas.wali_kelas');
            $builder->orderby('kelas.id_tingkat,kelas.nama_kelas', 'ASC');
            $query = $builder->get();
            $data = [
                'kelas' => $query->getResultArray(),
            ];
            $msg = [
                'data' => view('Admin/modaltambah', $data)
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
                    'id_tahun' => 2,
                    'status_aktif' => 0,
                    'id_kelas' => 7,
                ];
                $siswa = new SiswaModel();
                $msg = $siswa->insert($simpansiswa);
            }
            if (!$msg) {
                $this->session->setFlashdata('suksesimport', "Import Siswa Berhasil");
            } else {
                $this->session->setFlashdata('suksesimport', "Import Siswa Gagal");
            }
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
                    'nis' => [
                        'label' => "NIS",
                        'rules' => "is_unique[siswa.nis]",
                        'errors' => [
                            'is_unique' => '{field} sudah terdaftar !',
                        ]
                    ],
                    'nik' => [
                        'label' => "NIK",
                        'rules' => "is_unique[siswa.nik]",
                        'errors' => [
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
                    'kelas' => [
                        'label' => "Kelas",
                        'rules' => "required",
                        'errors' => [
                            'required' => '{field} wajib dipilih !'
                        ]
                    ],
                    'tahun_masuk' => [
                        'label' => "Tahun Masuk",
                        'rules' => "required|",
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
                        'nis' => $validation->getError('nis'),
                        'nik' => $validation->getError('nik'),
                        'nama_siswa' => $validation->getError('nama_siswa'),
                        'kelas' => $validation->getError('kelas'),
                        'tahun_masuk' => $validation->getError('tahun_masuk'),
                    ]
                ];
            } else {
                $simpansiswa = [
                    'nisn' => $this->request->getVar('nisn'),
                    'nis' => $this->request->getVar('nis'),
                    'nik' => $this->request->getVar('nik'),
                    'nama' => $this->request->getVar('nama_siswa'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'jk' => $this->request->getVar('jk'),
                    'agama' => $this->request->getVar('agama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'alamat_ortu' => $this->request->getVar('alamat_ortu'),
                    'nama_ayah' => $this->request->getVar('nama_ayah'),
                    'nama_ibu' => $this->request->getVar('nama_ibu'),
                    'sekolah_asal' => $this->request->getVar('sekolah_asal'),
                    'tahun_masuk' => $this->request->getVar('tahun_masuk'),
                    'id_kelas' => $this->request->getVar('kelas'),
                    'status_aktif' => 0, //0 aktif, 1 lulus, 2 berhenti, 3 pindah
                ];
                $siswa = new SiswaModel();
                $siswa->insert($simpansiswa);
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

    public function biodata($nisn)
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
        echo view('Admin/viewBiodata', $data);
        echo view('Layout/footer', $data);
    }

    function ambilbiodata()
    {
        if ($this->request->isAJAX()) {
            $nisn = $this->request->getVar("nisn");
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
            $builder->where("nisn", $nisn);
            $query = $builder->get();
            $siswa = $query->getResultArray();
            if ($siswa[0]["tanggal_lahir"] != 0) {
                $tanggal_indo = $this->tanggal_indo($siswa[0]["tanggal_lahir"]);
            } else {
                $tanggal_indo = "";
            }
            $data = [
                'siswa' => $siswa,
                'tanggal_indo' => $tanggal_indo,
            ];
            $msg = [
                'data' => view('Admin/isiBiodata', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function formeditbiodata()
    {
        if ($this->request->isAJAX()) {
            $nisn = $this->request->getVar('nisn');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
            $builder->where("nisn", $nisn);
            $query = $builder->get();
            $siswa = $query->getResultArray();
            $tahunModel = new TahunModel();
            $data = [
                'siswa' => $siswa,
                'tanggal_indo' => $this->tanggal_indo($siswa[0]["tanggal_lahir"]),
            ];
            $msg = [
                'data' => view('Admin/editBiodata', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    public function updatebiodata()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nis' => [
                    'label' => "NIS",
                    'rules' => "required|is_unique[siswa.nis,nis,{nis}]",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar !',
                    ]
                ],
                'nik' => [
                    'label' => "NIK",
                    'rules' => "required|is_unique[siswa.nik,nik,{nik}]",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar !',
                    ]
                ],
                'nama' => [
                    'label' => "Nama Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tempat_lahir' => [
                    'label' => "Tempat Lahir",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tanggal_lahir' => [
                    'label' => "Tanggal Lahir",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jk' => [
                    'label' => "Jenis Kelamin",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih',
                    ]
                ],
                'agama' => [
                    'label' => "Agama",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih',
                    ]
                ],
                'alamat' => [
                    'label' => "Alamat",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'no_hp' => [
                    'label' => "No. HP",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_ortu' => [
                    'label' => "Alamat Orang Tua",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_ayah' => [
                    'label' => "Nama Ayah",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_ibu' => [
                    'label' => "nama_ibu",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sekolah_asal' => [
                    'label' => "Sekolah Asal",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nis' => $validation->getError('nis'),
                        'nik' => $validation->getError('nik'),
                        'nama' => $validation->getError('nama'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'jk' => $validation->getError('jk'),
                        'agama' => $validation->getError('agama'),
                        'alamat' => $validation->getError('alamat'),
                        'no_hp' => $validation->getError('no_hp'),
                        'alamat_ortu' => $validation->getError('alamat_ortu'),
                        'nama_ayah' => $validation->getError('nama_ayah'),
                        'nama_ibu' => $validation->getError('nama_ibu'),
                        'sekolah_asal' => $validation->getError('sekolah_asal'),
                    ]
                ];
            } else {
                $id = $this->request->getVar('nisn');
                $simpansiswa = [
                    'nis' => $this->request->getVar('nis'),
                    'nik' => $this->request->getVar('nik'),
                    'nama' => $this->request->getVar('nama'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'jk' => $this->request->getVar('jk'),
                    'agama' => $this->request->getVar('agama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'alamat_ortu' => $this->request->getVar('alamat_ortu'),
                    'nama_ayah' => $this->request->getVar('nama_ayah'),
                    'nama_ibu' => $this->request->getVar('nama_ibu'),
                    'sekolah_asal' => $this->request->getVar('sekolah_asal'),
                ];
                $siswa = new SiswaModel();
                $siswa->update($id, $simpansiswa);
                $msg = [
                    'sukses' => 'Biodata siswa berhasil diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }
    //--------------------------------------------------------------------------

    function tahun_ajaran()
    {
        $userModel = new UserModel();
        $tahunModel = new TahunModel();
        $loggedAdmin = session()->get('loggedAdmin');
        $userInfo = $userModel->find($loggedAdmin);
        //$tahun_ajaran = $tahunModel->findAll();
        $data = [
            'title' => "Tahun Ajaran",
            'userInfo' => $userInfo,
            //'tahun_ajaran' => $tahun_ajaran,
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewData', $data);
        echo view('Layout/footer', $data);
    }

    function ambiltahun()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('tahun_ajaran');
            $builder->select('*');
            $builder->orderby('tahun_awal', 'ASC');
            $query = $builder->get();
            $data = [
                'tahun_ajaran' => $query->getResultArray(),
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
                'status' => $tahun['status'],
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
                    'rules' => "required|is_unique[tahun_ajaran.tahun_awal,tahun_awal,{tahun_awal}]",
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
                $status = $this->request->getVar('status');
                $tahun = new TahunModel();
                if ($status == 1) {
                    $tahun->where('id_tahun !=', $id_tahun)->where('status', 1)
                        ->set(['status' => 0])
                        ->update();
                }
                $simpantahun = [
                    'tahun_awal' => $tahun_awal,
                    'tahun_akhir' => $tahun_awal + 1,
                    'status' => $status,
                ];
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
            $valid = $this->validate([
                'status' => [
                    'label' => "Tahun Ajaran",
                    'rules' => "less_than[1]",
                    'errors' => [
                        'less_than' => '{field} tidak boleh dihapus karena sedang berstatus aktif',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pesan' => $validation->getError('status'),
                    ]
                ];
            } else {
                $msg = [
                    'sukses' => $this->request->getVar('status')
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
        $builder->orderby('id_tingkat,nama_kelas', 'ASC');
        $query = $builder->get();
        $data = [
            'title' => "Rombel",
            'userInfo' => $userInfo,
            'kelasasal' => $query->getResultArray(),
        ];
        echo view('Layout/header', $data);
        echo view('Layout/sidebar', $data);
        echo view('Admin/viewKenaikan', $data);
        echo view('Layout/footer', $data);
    }

    public function naikkan()
    {
        if ($this->request->isAJAX()) {
            //$id = $this->request->getVar('id_tujuan');
            $nisn = $this->request->getVar('naikkelas');
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'naikkelas' => [
                    'label' => "Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => 'Centang siswa untuk dikeluarkan dari rombel'
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
                    //echo $row . "";
                    $naikkelas = [
                        'id_kelas' => null,
                    ];
                    $siswa = new SiswaModel();
                    $siswa->update($nisn[$i], $naikkelas);
                }
                $msg = [
                    'sukses' => 'Proses berhasil !'
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
                    'label' => "Rombel",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} belum dipilih'
                    ]
                ],
                'naikkelas' => [
                    'label' => "Siswa",
                    'rules' => "required",
                    'errors' => [
                        'required' => 'Centang siswa untuk dimasukkan ke dalam rombel'
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
                        'status_aktif' => 1,
                        'tahun_out' => $id_tahun,
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
            $builder->orderby('kelas.id_tingkat,kelas.nama_kelas', 'ASC');
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
            $data = "<option value='0'>--Semua Kelas--</option>";
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
            $data = "<option value='0'>--Semua Jurusan--</option>";
            foreach ($jurusan as $row) {
                $data .= "<option value='" . $row['id_jurusan'] . "'>" . $row['nama_jurusan'] . "</option>";
            }
            echo json_encode($data);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    // public function kelastujuan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id_kelas = $this->request->getVar('id_kelas');
    //         $kelasModel = new KelasModel();
    //         $kelas = $kelasModel->where('id_kelas', $id_kelas)->first();
    //         $builder = $this->db->table('kelas');
    //         $builder->select('*');
    //         $builder->where("id_kelas !=", $kelas['id_kelas']);
    //         $builder->orderby('id_tingkat,nama_kelas', 'ASC');
    //         $query = $builder->get();
    //         $kelas = $query->getResultArray();
    //         $data = "<option value='' disabled selected value=''>--Pilih Kelas--</option>";
    //         foreach ($kelas as $row) {
    //             $data .= "<option value='" . $row['id_kelas'] . "'>" . $row['nama_kelas'] . "</option>";
    //         }
    //         echo json_encode($data);
    //     } else {
    //         exit("Tidak dapat diproses");
    //     }
    // }

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

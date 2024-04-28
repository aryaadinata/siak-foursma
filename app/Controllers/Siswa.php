<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\KeluargaModel;

use CodeItNow\BarcodeBundle\Utils\QrCode;
use App\Models\SekolahModel;

class Siswa extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        echo "siak";
    }

    public function biodata()
    {
        $nisn = session()->get('loggedSiswa');
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($nisn);
        $data = [
            'title' => "Biodata",
            'siswa' => $siswa,
            //'userInfo' => $userInfo,
        ];
        echo view('Layout_siswa/header', $data);
        echo view('Layout_siswa/sidebar', $data);
        echo view('Siswa/viewBiodata', $data);
        echo view('Layout_siswa/footer', $data);
    }


    public function ambilbiodata()
    {
        if ($this->request->isAJAX()) {
            $nisn = session()->get('loggedSiswa');
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
            $builder->where("nisn", $nisn);
            $query = $builder->get();
            $siswa = $query->getResultArray();
            $data = [
                'siswa' => $siswa,
                'tanggal_indo' => $this->tanggal_indo($siswa[0]["tanggal_lahir"]),
            ];
            $msg = [
                'data' => view('Siswa/isiBiodata', $data)
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
            $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
            $builder->where("nisn", $nisn);
            $query = $builder->get();
            $siswa = $query->getResultArray();
            $data = [
                'siswa' => $siswa,
                'tanggal_indo' => $this->tanggal_indo($siswa[0]["tanggal_lahir"]),
            ];
            $msg = [
                'data' => view('Siswa/editBiodata', $data)
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
                'nik' => [
                    'label' => "NIK",
                    'rules' => "required|is_unique[siswa.nik,nisn," . session()->get('loggedSiswa') . "]",
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
                $id = session()->get('loggedSiswa');
                $simpansiswa = [
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
                    'sukses' => 'Biodata berhasil diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function uploadfoto()
    {
        $validation = \config\Services::validation();
        $valid = $this->validate([
            'foto' => [
                'label' => "Foto",
                'rules' => 'uploaded[foto]|ext_in[foto,jpg]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} Terlebih Dahulu !',
                    'ext_in' => '{field} harus ekstensi jpg, jpeg atau png',
                    'max_size' => 'Size {field} maksimal 1 MB',
                    'mime_in' => 'File yang dipilih bukan gambar',
                ]
            ],
        ]);
        if (!$valid) {
            $this->session->setFlashdata('foto', $validation->getError('foto'));
            return redirect()->to('/Siswa/biodata');
        } else {
            $nisn = session()->get('loggedSiswa');
            $foto = $this->request->getFile('foto');
            $ext = $foto->getClientExtension();
            $siswaModel = new SiswaModel();
            $namaFoto = $nisn . "." . $ext;
            $foto->move("dist/img/pasfoto", $namaFoto, true);
            //$foto->move("dist/img/pasfoto" . 'uploads', null, true);

            $simpandata = [
                'foto' => $namaFoto,
            ];
            $siswaModel->update($nisn, $simpandata);

            $this->session->setFlashdata('suksesupload', "Upload Foto Berhasil");
            return redirect()->to('/Siswa/biodata');
        }
    }

    //----------------------------------------------------------------------------------------

    public function keluarga()
    {
        $nisn = session()->get('loggedSiswa');
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($nisn);
        $data = [
            'title' => "Data Keluarga",
            'siswa' => $siswa,
            //'userInfo' => $userInfo,
        ];
        echo view('Layout_siswa/header', $data);
        echo view('Layout_siswa/sidebar', $data);
        echo view('Siswa/viewKeluarga', $data);
        echo view('Layout_siswa/footer', $data);
    }

    public function ambilkeluarga()
    {
        if ($this->request->isAJAX()) {
            $nisn = $this->request->getVar('nisn');
            $builder = $this->db->table('keluarga');
            $builder->select('*');
            $builder->where("nisn", $nisn);
            $query = $builder->get();
            $keluarga = $query->getResultArray();
            $data = [
                'keluarga' => $keluarga,
            ];
            $msg = [
                'data' => view('Siswa/isiKeluarga', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function formtambahkeluarga()
    {
        if ($this->request->isAJAX()) {
            //$kelasModel = new KelasModel();
            $nisn = session()->get('loggedSiswa');
            $data = [
                'nisn' => $nisn,
            ];
            $msg = [
                'data' => view('Siswa/modaltambahkeluarga', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function inputkeluarga()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nik' => [
                    'label' => "NIK",
                    'rules' => "required|is_unique[keluarga.nik]",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nama' => [
                    'label' => "Nama",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'hubungan' => [
                    'label' => "Hubungan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'jk' => [
                    'label' => "Jenis Kelamin",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'tempat_lahir' => [
                    'label' => "Tempat Lahir",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tanggal_lahir' => [
                    'label' => "Tanggal Lahir",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'pendidikan' => [
                    'label' => "Pendidikan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'pekerjaan' => [
                    'label' => "Pekerjaan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'penghasilan' => [
                    'label' => "Penghasilan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nik' => $validation->getError('nik'),
                        'nama' => $validation->getError('nama'),
                        'hubungan' => $validation->getError('hubungan'),
                        'jk' => $validation->getError('jk'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'pekerjaan' => $validation->getError('pekerjaan'),
                        'penghasilan' => $validation->getError('penghasilan'),
                    ]
                ];
            } else {
                $simpankeluarga = [
                    'nik' => $this->request->getVar('nik'),
                    'nama_kel' => $this->request->getVar('nama'),
                    'hubungan_kel' => $this->request->getVar('hubungan'),
                    'jk_kel' => $this->request->getVar('jk'),
                    'tempat_lahir_kel' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir_kel' => $this->request->getVar('tanggal_lahir'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'pekerjaan' => $this->request->getVar('pekerjaan'),
                    'penghasilan' => $this->request->getVar('penghasilan'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'nisn' => session()->get('loggedSiswa'),
                ];
                $keluarga = new KeluargaModel();
                $keluarga->insert($simpankeluarga);
                $msg = [
                    'sukses' => 'Data keluarga berhasil ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    function formeditkeluarga()
    {
        if ($this->request->isAJAX()) {
            //$kelasModel = new KelasModel();
            $id = $this->request->getVar('id');
            $keluargaModel = new KeluargaModel();
            $keluarga = $keluargaModel->find($id);
            $data = [
                'keluarga' => $keluarga,
            ];
            $msg = [
                'data' => view('Siswa/modaleditkeluarga', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak dapat diproses");
        }
    }

    function updatekeluarga()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nik' => [
                    'label' => "NIK",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'nama' => [
                    'label' => "Nama",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'hubungan' => [
                    'label' => "Hubungan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'jk' => [
                    'label' => "Jenis Kelamin",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'tempat_lahir' => [
                    'label' => "Tempat Lahir",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tanggal_lahir' => [
                    'label' => "Tanggal Lahir",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'pendidikan' => [
                    'label' => "Pendidikan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'pekerjaan' => [
                    'label' => "Pekerjaan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'penghasilan' => [
                    'label' => "Penghasilan",
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nik' => $validation->getError('nik'),
                        'nama' => $validation->getError('nama'),
                        'hubungan' => $validation->getError('hubungan'),
                        'jk' => $validation->getError('jk'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'pekerjaan' => $validation->getError('pekerjaan'),
                        'penghasilan' => $validation->getError('penghasilan'),
                    ]
                ];
            } else {
                $simpankeluarga = [
                    'nik' => $this->request->getVar('nik'),
                    'nama_kel' => $this->request->getVar('nama'),
                    'hubungan_kel' => $this->request->getVar('hubungan'),
                    'jk_kel' => $this->request->getVar('jk'),
                    'tempat_lahir_kel' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir_kel' => $this->request->getVar('tanggal_lahir'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'pekerjaan' => $this->request->getVar('pekerjaan'),
                    'penghasilan' => $this->request->getVar('penghasilan'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'nisn' => session()->get('loggedSiswa'),
                ];
                $id = $this->request->getVar('id');
                $keluarga = new KeluargaModel();
                $keluarga->update($id, $simpankeluarga);
                $msg = [
                    'sukses' => 'Data keluarga berhasil diperbarui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    public function hapuskeluarga()
    {
        if ($this->request->isAJAX()) {
            $keluarga = new KeluargaModel();
            $id = $this->request->getVar('id');
            $keluarga->delete($id);
            $msg = [
                'sukses' => 'Data keluarga berhasil dihapus !'
            ];
            echo json_encode($msg);
        } else {
            exit("Tidak Dapat Diproses");
        }
    }

    //---------------------------------------------------------------------------------------

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
        $split = explode('-', $tanggal);
        //echo $split[2];
        return $split[2] . '-' . $split[1] . '-' . $split[0];
    }
}

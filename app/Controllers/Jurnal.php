<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use App\Models\KinerjaModel;

class Jurnal extends BaseController
{

    public function index()
    {

        $jurnal = new JurnalModel();
        $jurnalTerlama = $jurnal->where('status', 'terverifikasi')->where('id_users', session('id_users'))->orderBy('tanggal', "ASC")->first();
        $jurnalTerbaru = $jurnal->where('status', 'terverifikasi')->where('id_users', session('id_users'))->orderBy('tanggal', "DESC")->first();

        if (session('role') == 'user') {
            if (!empty($jurnalTerlama)) {
                $data = [
                    'jurnal_terbaru' => date('Y', strtotime($jurnalTerbaru['tanggal'])),
                    'jurnal_lama' => date('Y', strtotime($jurnalTerlama['tanggal'])),
                    'jurnal'  => $jurnal->where('id_users', session('id_users'))->findAll(),
                ];
            } else {
                $data = [
                    'jurnal_terbaru' => date('Y'),
                    'jurnal_lama' => date('Y'),
                    'jurnal'  => $jurnal->where('id_users', session('id_users'))->findAll(),
                ];
            }
        } else {
            if (!empty($jurnalTerlama)) {
                $data = [
                    'jurnal_terbaru' => date('Y', strtotime($jurnalTerbaru['tanggal'])),
                    'jurnal_lama' => date('Y', strtotime($jurnalTerlama['tanggal'])),
                    'jurnal'  => $jurnal->join('users', 'users.id_users = jurnal.id_users')->findAll(),
                ];
            } else {
                $data = [
                    'jurnal_terbaru' => date('Y'),
                    'jurnal_lama' => date('Y'),
                    'jurnal'  => $jurnal->join('users', 'users.id_users = jurnal.id_users')->findAll(),
                ];
            }
        }
        return view('admin/jurnal', $data);
    }

    public function add()
    {
        if (session('role') == 'admin' || session('role') == 'pimpinan') :
            return redirect()->to('jurnal');
        endif;
        $kinerja = new KinerjaModel();
        $data = [
            'kinerja' => $kinerja->where('id_users', session('id_users'))->where('status', 'terverifikasi')->findAll(),
        ];
        return view('admin/jurnal-add', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nama' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tempat' => [
                'label' => 'tempat',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'jam_mulai' => [
                'label' => 'Jam Mulai',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'jam_berakhir' => [
                'label' => 'jam berakhir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'penyelenggara' => [
                'label' => 'penyelenggara',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!',
                    'max_size' => 'Ukuran {field} max 10 Mb',
                    'mime_in' => 'Format {field} wajib png, jpg, dan jpeg',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();

            $jurnal = new JurnalModel();

            $cekJurnal  = $jurnal->where('nama', $this->request->getVar('nama'))
                ->where('id_users', session('id_users'))->first();

            if ($cekJurnal !== NULL) {
                Session()->setFlashdata('errors', ['jurnal' => 'Nama kegiatan sudah terdaftar, ganti nama kegiatan yang lain!']);
                return redirect()->back()->withInput();
            }

            $jurnal->save([
                'nama' => $this->request->getVar('nama'),
                'tanggal' => $this->request->getVar('tanggal'),
                'tempat' => $this->request->getVar('tempat'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_berakhir' => $this->request->getVar('jam_berakhir'),
                'penyelenggara' => $this->request->getVar('penyelenggara'),
                'id_users' => session('id_users'),
                'id_kinerja' => $this->request->getVar('id_kinerja'),
                'status' => "admin",
                'foto' => $nama_file,
            ]);
            $foto->move('foto', $nama_file);

            session()->setFlashdata('pesan', 'Jurnal Harian berhasil ditambahkan');
            return redirect()->to('jurnal');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function delete()
    {
        $jurnal = new JurnalModel();
        $data = $jurnal->find($this->request->getVar('id_jurnal'));
        if ($data['status'] == 'admin' || session('role') == 'admin') {
            unlink('foto/' . $data['foto']);
            $jurnal->delete($this->request->getVar('id_jurnal'));
            session()->setFlashdata('pesan', 'Jurnal Harian berhasil dihapus');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function verif()
    {
        $jurnal = new JurnalModel();
        $data = $jurnal->find($this->request->getVar('id_jurnal'));
        if ($data['status'] == 'admin' && session('role') == 'admin') {
            $data = [
                'status' => 'pimpinan',
            ];
            $jurnal->set($data)
                ->where('id_jurnal', $this->request->getVar('id_jurnal'))
                ->update();
            session()->setFlashdata('pesan', 'Jurnal Harian berhasil diverifikasi');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function tolak()
    {
        $jurnal = new JurnalModel();
        $data = $jurnal->find($this->request->getVar('id_jurnal'));
        $data = [
            'status' => 'ditolak',
            'keterangan' => $this->request->getVar('keterangan')
        ];
        $jurnal->set($data)
            ->where('id_jurnal', $this->request->getVar('id_jurnal'))
            ->update();
        session()->setFlashdata('pesan', 'Jurnal Harian berhasil ditolak');
        return redirect()->back();
    }

    public function verifPimpinan()
    {
        $jurnal = new JurnalModel();
        $data = $jurnal->find($this->request->getVar('id_jurnal'));
        if ($data['status'] == 'pimpinan' && session('role') == 'pimpinan') {
            $data = [
                'status' => 'terverifikasi',
            ];
            $jurnal->set($data)
                ->where('id_jurnal', $this->request->getVar('id_jurnal'))
                ->update();
            session()->setFlashdata('pesan', 'Jurnal Harian berhasil diverifikasi');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $jurnal = new JurnalModel();
        $kinerja = new KinerjaModel();
        $getData = $jurnal->find($id);
        if (session('id_users') == $getData['id_users'] && ($getData['status'] == "admin" || $getData['status'] == "ditolak") && session('role') !== 'pimpinan') {
            $data = [
                'kinerja' => $kinerja->where('status', 'terverifikasi')->where('id_users', session('id_users'))->findAll(),
                'jurnal'  => $jurnal->find($id),
            ];
            return view('admin/jurnal-edit', $data);
        } else {
            return redirect()->to('jurnal');
        }
    }

    public function update()
    {
        $jurnal = new JurnalModel();
        $getData = $jurnal->find($this->request->getVar('id_jurnal'));
        if (session('id_users') == $getData['id_users'] && ($getData['status'] == "admin" || $getData['status'] == "ditolak") && session('role') !== 'pimpinan') {
            if ($this->validate([
                'nama' => [
                    'label' => 'Nama Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'jam_mulai' => [
                    'label' => 'Jam Mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'jam_berakhir' => [
                    'label' => 'jam_berakhir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'penyelenggara' => [
                    'label' => 'penyelenggara',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'foto' => [
                    'label' => 'Foto',
                    'rules' => 'max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} max 10 Mb',
                        'mime_in' => 'Format {field} wajib png, jpg, dan jpeg',
                    ]
                ],
            ])) {
                $foto = $this->request->getFile('foto');

                $cekJurnalSekarang  = $jurnal->find($this->request->getVar('id_jurnal'));
                $cekJurnal  = $jurnal->where('nama', $this->request->getVar('nama'))
                    ->where('id_users', session('id_users'))->first();

                if ($cekJurnalSekarang['nama'] !== $this->request->getVar('nama')) {
                    if ($cekJurnal !== NULL) {
                        Session()->setFlashdata('errors', ['nama' => 'Nama kegiatan sudah terdaftar, ganti nama kegiatan yang lain!']);
                        return redirect()->back()->withInput();
                    }
                }

                if ($foto->getError() == 4) {
                    $data = [
                        'nama' => $this->request->getVar('nama'),
                        'tanggal' => $this->request->getVar('tanggal'),
                        'tempat' => $this->request->getVar('tempat'),
                        'jam_mulai' => $this->request->getVar('jam_mulai'),
                        'jam_berakhir' => $this->request->getVar('jam_berakhir'),
                        'penyelenggara' => $this->request->getVar('penyelenggara'),
                        'id_kinerja' => $this->request->getVar('id_kinerja'),
                        'status' => "admin",
                        'keterangan' => NULL,
                        'id_users' => session('id_users'),
                    ];
                    $jurnal->set($data)
                        ->where('id_jurnal', $this->request->getVar('id_jurnal'))
                        ->update();
                } else {
                    $nama_file = $foto->getRandomName();
                    $data = [
                        'nama' => $this->request->getVar('nama'),
                        'tanggal' => $this->request->getVar('tanggal'),
                        'tempat' => $this->request->getVar('tempat'),
                        'jam_mulai' => $this->request->getVar('jam_mulai'),
                        'jam_berakhir' => $this->request->getVar('jam_berakhir'),
                        'penyelenggara' => $this->request->getVar('penyelenggara'),
                        'id_kinerja' => $this->request->getVar('id_kinerja'),
                        'id_users' => session('id_users'),
                        'status' => "admin",
                        'foto' => $nama_file,
                    ];
                    unlink('foto/' . $getData['foto']);
                    $foto->move('foto', $nama_file);

                    $jurnal->set($data)
                        ->where('id_jurnal', $this->request->getVar('id_jurnal'))
                        ->update();
                }

                session()->setFlashdata('pesan', 'Jurnal Harian berhasil diedit');
                return redirect()->to('jurnal');
            } else {
                // JIKA TIDAK VALID
                Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
                return redirect()->back();
            }
        } else {
            return redirect()->to('jurnal');
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\JurnalModel;

class Jurnal extends BaseController
{

    public function index()
    {

        $jurnal = new JurnalModel();
        if (session('role') == 'user') {
            $data = [
                'jurnal'  => $jurnal->where('id_users', session('id_users'))->findAll(),
            ];
        } else {
            $data = [
                'jurnal'  => $jurnal->join('users', 'users.id_users = jurnal.id_users')->findAll(),
            ];
        }
        return view('admin/jurnal', $data);
    }

    public function add()
    {
        return view('admin/jurnal-add');
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
            $nama_file = $foto->getRandomName();

            $jurnal = new JurnalModel();
            $jurnal->save([
                'nama' => $this->request->getVar('nama'),
                'tanggal' => $this->request->getVar('tanggal'),
                'tempat' => $this->request->getVar('tempat'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_berakhir' => $this->request->getVar('jam_berakhir'),
                'penyelenggara' => $this->request->getVar('penyelenggara'),
                'id_users' => session('id_users'),
                'status' => "pending",
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
        if ($data['status'] == 'pending') {
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
        if ($data['status'] == 'pending' && session('role') == 'admin') {
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
        $getData = $jurnal->find($id);
        if (session('id_users') == $getData['id_users'] && $getData['status'] == "pending" && session('role') !== 'pimpinan') {
            $data = [
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
        if (session('id_users') == $getData['id_users'] && $getData['status'] == "pending" && session('role') !== 'pimpinan') {
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

                if ($foto->getError() == 4) {
                    $data = [
                        'nama' => $this->request->getVar('nama'),
                        'tanggal' => $this->request->getVar('tanggal'),
                        'tempat' => $this->request->getVar('tempat'),
                        'jam_mulai' => $this->request->getVar('jam_mulai'),
                        'jam_berakhir' => $this->request->getVar('jam_berakhir'),
                        'penyelenggara' => $this->request->getVar('penyelenggara'),
                        'status' => "pending",
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
                        'id_users' => session('id_users'),
                        'status' => "pending",
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

<?php

namespace App\Controllers;

use App\Models\KinerjaModel;

class Kinerja extends BaseController
{

    public function index()
    {
        $kinerja = new KinerjaModel();
        if (session('role') == 'user') {
            $data = [
                'kinerja'  => $kinerja->where('id_users', session('id_users'))->findAll(),
            ];
        } else {
            $data = [
                'kinerja'  => $kinerja->join('users', 'users.id_users = kinerja.id_users')->findAll(),
            ];
        }
        return view('admin/kinerja', $data);
    }

    public function add()
    {
        if ($this->validate([
            'capaian' => [
                'label' => 'Capaian Kinerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'realisasi' => [
                'label' => 'Realisasi Waktu',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'kuantitas' => [
                'label' => 'Kuantitas Output',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'point' => [
                'label' => 'Point',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $kinerja = new KinerjaModel();
            $kinerja->save([
                'capaian' => $this->request->getVar('capaian'),
                'realisasi' => $this->request->getVar('realisasi'),
                'kuantitas' => $this->request->getVar('kuantitas'),
                'point' => $this->request->getVar('point'),
                'status' => 'admin',
                'id_users' => session('id_users'),
            ]);

            session()->setFlashdata('pesan', 'Capaian Kinerja berhasil ditambahkan');
            return redirect()->back();
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function delete()
    {
        $kinerja = new KinerjaModel();
        $data = $kinerja->find($this->request->getVar('id_kinerja'));
        if ($data['id_users'] == session('id_users') && $data['status'] == 'admin') {
            $kinerja->delete($this->request->getVar('id_kinerja'));
            session()->setFlashdata('pesan', 'Capaian Kinerja berhasil dihapus');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function verif()
    {
        $kinerja = new KinerjaModel();
        $data = $kinerja->find($this->request->getVar('id_kinerja'));
        if ($data['status'] == 'admin' && session('role') == 'admin') {
            $data = [
                'status' => 'pimpinan',
            ];
            $kinerja->set($data)
                ->where('id_kinerja', $this->request->getVar('id_kinerja'))
                ->update();

            session()->setFlashdata('pesan', 'Capaian Kinerja berhasil diverifikasi');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function verifPimpinan()
    {
        $kinerja = new KinerjaModel();
        $data = $kinerja->find($this->request->getVar('id_kinerja'));
        if ($data['status'] == 'pimpinan' && session('role') == 'pimpinan') {
            $data = [
                'status' => 'terverifikasi',
            ];
            $kinerja->set($data)
                ->where('id_kinerja', $this->request->getVar('id_kinerja'))
                ->update();

            session()->setFlashdata('pesan', 'Capaian Kinerja berhasil diverifikasi');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $kinerja = new KinerjaModel();
        $getData = $kinerja->find($id);

        if (session('id_users') == $getData['id_users'] && $getData['status'] == "admin" && session('role') !== 'pimpinan') {
            $data = [
                'kinerja'  => $kinerja->find($id),
            ];
            return view('admin/kinerja-edit', $data);
        } else {
            return redirect()->to('kinerja');
        }
    }

    public function update()
    {
        $kinerja = new KinerjaModel();
        $getData = $kinerja->find($this->request->getVar('id_kinerja'));
        if (session('id_users') == $getData['id_users'] && $getData['status'] == "admin" && session('role') !== 'pimpinan') {
            if ($this->validate([
                'capaian' => [
                    'label' => 'Capaian Kinerja',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'realisasi' => [
                    'label' => 'Realisasi Waktu',
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'kuantitas' => [
                    'label' => 'Kuantitas Output',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
                'point' => [
                    'label' => 'Point',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi !',
                    ]
                ],
            ])) {

                $data = [
                    'capaian' => $this->request->getVar('capaian'),
                    'realisasi' => $this->request->getVar('realisasi'),
                    'kuantitas' => $this->request->getVar('kuantitas'),
                    'point' => $this->request->getVar('point'),
                    'id_users' => session('id_users'),
                ];
                $kinerja->set($data)
                    ->where('id_kinerja', $this->request->getVar('id_kinerja'))
                    ->update();

                session()->setFlashdata('pesan', 'Capaian Kinerja berhasil diedit');
                return redirect()->to('kinerja');
            } else {
                // JIKA TIDAK VALID
                Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
                return redirect()->back();
            }
        } else {
            return redirect()->to('kinerja');
        }
    }
}

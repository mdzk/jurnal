<?php

namespace App\Controllers;

use App\Models\GolonganModel;
use App\Models\UsersModel;

class Setting extends BaseController
{
    public function index()
    {
        $user       = new UsersModel();
        $golongan = new GolonganModel();
        $data = [
            'user'  => $user->join('golongan', 'golongan.id_golongan = users.golongan')->find(session()->get('id_users')),
            'golongan'  => $golongan->orderBy('nama_golongan', "ASC")->findAll(),
        ];
        return view('admin/setting', $data);
    }

    public function update()
    {
        $user = new UsersModel();
        $data = $user->find($this->request->getVar('id_users'));
        $id = $data['id_users'];
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'golongan' => [
                'label' => 'Pangkat/Golongan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
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

            if (session('role') == 'admin' || session('role') == 'pimpinan') {
                if (!$this->validate([
                    'email'    => [
                        'label'  => 'email',
                        'rules'  => "required|is_unique[users.email, id_users, $id]",
                        'errors' => [
                            'required'  => '{field} Wajib diisi !',
                            'is_unique' => 'email sudah digunakan, cari yang lain!'
                        ]
                    ]
                ])) {
                    Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
                    return redirect()->back();
                }
            }

            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = [
                    'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                    'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $data['email'],
                    'golongan' => $this->request->getVar('golongan') ? $this->request->getVar('golongan') : $data['golongan'],
                    'jabatan' => $this->request->getVar('jabatan') ? $this->request->getVar('jabatan') : $data['jabatan'],
                    'role' => $data['role'],
                    'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];

                $user->set($data);
                $user->where('id_users', $this->request->getVar('id_users'));
                $user->update();
            } else {
                if ($data['picture'] !== 'default.jpg') {
                    unlink('foto/' . $data['picture']);
                }
                $nama_file = $foto->getRandomName();

                $data = [
                    'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                    'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $data['email'],
                    'golongan' => $this->request->getVar('golongan') ? $this->request->getVar('golongan') : $data['golongan'],
                    'jabatan' => $this->request->getVar('jabatan') ? $this->request->getVar('jabatan') : $data['jabatan'],
                    'role' => $data['role'],
                    'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'picture' => $nama_file,
                ];

                $user->set($data);
                $user->where('id_users', $this->request->getVar('id_users'));
                $user->update();
                $foto->move('foto', $nama_file);
            }

            session()->setFlashdata('pesan', 'Data berhasil diedit');
            return redirect()->back();
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\GolonganModel;
use App\Models\UsersModel;

class Users extends BaseController
{

    public function index()
    {
        if (session('role') == 'admin') {
            $user       = new UsersModel();
            $golongan       = new GolonganModel();
            $data = [
                'user'  => $user->find(session()->get('id_users')),
                'users'  => $user->findAll(),
                'golongan'  => $golongan->orderBy('nama_golongan', "ASC")->findAll(),
            ];
            return view('admin/users', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function add()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => "required|is_unique[users.username]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Username sudah digunakan, cari yang lain!'
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nip' => [
                'label' => 'NIP',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'golongan' => [
                'label' => 'Pangkat / Golongan',
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
            'unit' => [
                'label' => 'Unit Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'kepala' => [
                'label' => 'Kepala Bidang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $user = new UsersModel();
            $user->save([
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'nip' => $this->request->getVar('nip'),
                'golongan' => $this->request->getVar('golongan'),
                'jabatan' => $this->request->getVar('jabatan'),
                'unit' => $this->request->getVar('unit'),
                'kepala' => $this->request->getVar('kepala'),
                'role' => $this->request->getVar('role'),
                'picture' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Akun berhasil ditambahkan');
            return redirect()->to('users');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('users');
        }
    }

    public function delete()
    {
        $user = new UsersModel();
        $data = $user->find($this->request->getVar('id_users'));
        if ($data['picture'] !== 'default.jpg') {
            unlink('foto/' . $data['picture']);
        }
        $user->delete($this->request->getVar('id_users'));
        session()->setFlashdata('pesan', 'Akun berhasil dihapus');
        return redirect()->to('users');
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
            'username' => [
                'label' => 'Username',
                'rules' => "required|is_unique[users.username, id_users, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Username sudah digunakan, cari yang lain!'
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nip' => [
                'label' => 'NIP',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'golongan' => [
                'label' => 'Pangkat / Golongan',
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
            'unit' => [
                'label' => 'Unit Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'kepala' => [
                'label' => 'Kepala Bidang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $user->replace([
                'id_users' => $this->request->getVar('id_users'),
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'nip' => $this->request->getVar('nip'),
                'golongan' => $this->request->getVar('golongan'),
                'jabatan' => $this->request->getVar('jabatan'),
                'unit' => $this->request->getVar('unit'),
                'kepala' => $this->request->getVar('kepala'),
                'role' => $this->request->getVar('role'),
                'picture' => $data['picture'],
                'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Akun berhasil diedit');
            return redirect()->to('users');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('users');
        }
    }
}

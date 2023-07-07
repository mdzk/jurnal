<?php

namespace App\Controllers;

use App\Models\GolonganModel;
use App\Models\PegawaiModel;

class Pegawai extends BaseController
{

    public function index()
    {
        $pegawai = new PegawaiModel();

        $data = [
            'pegawai'  => $pegawai->join('golongan', 'golongan.id_golongan = pegawai.golongan')->findAll(),
        ];
        return view('admin/pegawai', $data);
    }

    public function add()
    {
        $golongan = new GolonganModel();
        $data = [
            'golongan' => $golongan->findAll(),
        ];
        return view('admin/pegawai-add', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nip' => [
                'label' => 'NIP',
                'rules' => "required",
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
            'tmt_jabatan' => [
                'label' => 'Tamat Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'thn_masa_kerja' => [
                'label' => 'Masa Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'bln_masa_kerja' => [
                'label' => 'Masa Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'golongan' => [
                'label' => 'Golongan/Pangkat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tmt_golongan' => [
                'label' => 'Tamat Golongan/Pangkat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'pendidikan' => [
                'label' => 'Tingkat Pendidikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'instansi_pendidikan' => [
                'label' => 'Instansi Pendidikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'thn_lulus' => [
                'label' => 'Tahun Lulus',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $pegawai = new PegawaiModel();
            $pegawai->save([
                'nama_pegawai' => $this->request->getVar('nama'),
                'nip' => preg_replace('/[^0-9]/', '', $this->request->getVar('nip')),
                'jabatan' => $this->request->getVar('jabatan'),
                'tmt_jabatan' => $this->request->getVar('tmt_jabatan'),
                'kerja_thn' => $this->request->getVar('thn_masa_kerja'),
                'kerja_bln' => $this->request->getVar('bln_masa_kerja'),
                'golongan' => $this->request->getVar('golongan'),
                'tmt_golongan' => $this->request->getVar('tmt_golongan'),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'instansi_pendidikan' => $this->request->getVar('instansi_pendidikan'),
                'thn_lulus' => $this->request->getVar('thn_lulus'),
            ]);
            session()->setFlashdata('pesan', 'Pegawai berhasil ditambahkan');
            return redirect()->to('pegawai');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function delete()
    {
        $pegawai = new PegawaiModel();
        $pegawai->delete($this->request->getVar('id_pegawai'));
        session()->setFlashdata('pesan', 'Pegawai berhasil dihapus');
        return redirect()->back();
    }

    public function edit($id)
    {
        $pegawai = new PegawaiModel();
        $golongan = new GolonganModel();
        $data = [
            'data'  => $pegawai->find($id),
            'golongan' => $golongan->findAll(),
        ];
        return view('admin/pegawai-edit', $data);
    }

    public function update()
    {
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nip' => [
                'label' => 'NIP',
                'rules' => "required",
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
            'tmt_jabatan' => [
                'label' => 'Tamat Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'thn_masa_kerja' => [
                'label' => 'Masa Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'bln_masa_kerja' => [
                'label' => 'Masa Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'golongan' => [
                'label' => 'Golongan/Pangkat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tmt_golongan' => [
                'label' => 'Tamat Golongan/Pangkat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'pendidikan' => [
                'label' => 'Tingkat Pendidikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'instansi_pendidikan' => [
                'label' => 'Instansi Pendidikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'thn_lulus' => [
                'label' => 'Tahun Lulus',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $pegawai = new PegawaiModel();
            $data = [
                'nama_pegawai' => $this->request->getVar('nama'),
                'nip' => preg_replace('/[^0-9]/', '', $this->request->getVar('nip')),
                'jabatan' => $this->request->getVar('jabatan'),
                'tmt_jabatan' => $this->request->getVar('tmt_jabatan'),
                'kerja_thn' => $this->request->getVar('thn_masa_kerja'),
                'kerja_bln' => $this->request->getVar('bln_masa_kerja'),
                'golongan' => $this->request->getVar('golongan'),
                'tmt_golongan' => $this->request->getVar('tmt_golongan'),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'instansi_pendidikan' => $this->request->getVar('instansi_pendidikan'),
                'thn_lulus' => $this->request->getVar('thn_lulus'),
            ];
            $pegawai->set($data)
                ->where('id_pegawai', $this->request->getVar('id_pegawai'))
                ->update();

            session()->setFlashdata('pesan', 'Pegawai berhasil diedit');
            return redirect()->to('pegawai');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }
}

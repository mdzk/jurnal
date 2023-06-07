<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use App\Models\PegawaiModel;
use App\Models\UsersModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    // public function index()
    // {
    //     return view('export/pdf_kwitansi');
    // }

    public function pegawai()
    {
        $filename = date('y-m-d-H-i-s') . '-pegawai';
        $dompdf = new Dompdf();
        $filter = $this->request->getVar('filter');
        $pegawai = new PegawaiModel();
        if ($filter == 'pangkat') {
            $data = [
                'pegawai'  => $pegawai->join('golongan', 'golongan.id_golongan = pegawai.golongan')->orderBy('golongan', 'DESC')->findAll(),
            ];
        }

        if ($filter == 'jabatan') {
            $data = [
                'pegawai'  => $pegawai->join('golongan', 'golongan.id_golongan = pegawai.golongan')->orderBy('jabatan', 'DESC')->findAll(),
            ];
        }

        if ($filter == 'masa_kerja') {
            $data = [
                'pegawai'  => $pegawai->join('golongan', 'golongan.id_golongan = pegawai.golongan')->orderBy('kerja_thn', 'DESC')->findAll(),
            ];
        }

        if ($filter == 'pangkat') {
            $data = [
                'pegawai'  => $pegawai->join('golongan', 'golongan.id_golongan = pegawai.golongan')->orderBy('pendidikan', 'DESC')->findAll(),
            ];
        }
        $dompdf->loadHtml(view('/export/pdf_pegawai', $data));
        $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
        exit();
    }

    public function jurnal()
    {
        $jurnal = new JurnalModel();
        $id = $this->request->getVar('tanggal');
        $data_jurnal = $jurnal->where('status', 'terverifikasi')->where('id_users', session('id_users'))->where('tanggal', $id)->findAll();
        if (!$data_jurnal || !$data_jurnal_bulan) {
            session()->setFlashdata('not-found', 'Data tidak ditemukan');
            return redirect()->back();
        } else {
            $filename = date('y-m-d-H-i-s') . '-jurnal';
            $dompdf = new Dompdf();
            $user = new UsersModel();
            $data = [
                'tanggal' => $id,
                'user' => $user->join('golongan', 'golongan.id_golongan = users.golongan')->find(session('id_users')),
                'jurnal'  => $data_jurnal,
            ];

            $dompdf->loadHtml(view('/export/pdf_jurnal', $data));

            $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'portrait');
            $dompdf->render();
            $dompdf->stream($filename);
            exit();
        }
    }

    public function jurnal_bulan()
    {
        $jurnal = new JurnalModel();
        $data_jurnal_bulan = $jurnal->where('status', 'terverifikasi')->where('id_users', session('id_users'))->where('MONTH(tanggal)', $this->request->getVar('bulan'))->where('YEAR(tanggal)', $this->request->getVar('tahun'))->findAll();
        if (!$data_jurnal_bulan) {
            session()->setFlashdata('not-found', 'Data tidak ditemukan');
            return redirect()->back();
        } else {
            $filename = date('y-m-d-H-i-s') . '-jurnal';
            $dompdf = new Dompdf();
            $user = new UsersModel();
            $data = [
                'bulan' => $this->request->getVar('bulan'),
                'tahun' => $this->request->getVar('tahun'),
                'user' => $user->join('golongan', 'golongan.id_golongan = users.golongan')->find(session('id_users')),
                'jurnal'  => $data_jurnal_bulan,
            ];

            $dompdf->loadHtml(view('/export/pdf_jurnal_bulan', $data));
            $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'portrait');
            $dompdf->render();
            $dompdf->stream($filename);
            exit();
        }
    }
}

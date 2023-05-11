<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
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

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // get SPT data from POST
        $filter = $this->request->getVar('filter');
        $pegawai = new PegawaiModel();
        if ($filter == 'pangkat') {
            $data = [
                'pegawai'  => $pegawai->orderBy('golongan', 'DESC')->findAll(),
            ];
        }

        if ($filter == 'jabatan') {
            $data = [
                'pegawai'  => $pegawai->orderBy('jabatan', 'DESC')->findAll(),
            ];
        }

        if ($filter == 'masa_kerja') {
            $data = [
                'pegawai'  => $pegawai->orderBy('kerja_thn', 'DESC')->findAll(),
            ];
        }

        if ($filter == 'pangkat') {
            $data = [
                'pegawai'  => $pegawai->orderBy('pendidikan', 'DESC')->findAll(),
            ];
        }

        // load HTML content
        $dompdf->loadHtml(view('/export/pdf_pegawai', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}

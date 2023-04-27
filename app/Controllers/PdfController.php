<?php

namespace App\Controllers;

use App\Models\KwitansiModel;
use App\Models\PegawaiModel;
use App\Models\SuratModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function index()
    {
        return view('export/pdf_kwitansi');
    }

    public function spt()
    {
        $filename = date('y-m-d-H-i-s') . '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // get SPT data from POST
        $surat = new SuratModel();
        $pegawai = new PegawaiModel();
        $id = $this->request->getVar('id_surat');
        $data = [
            'surat'  => $surat->find($id),
            'pegawai'  => $pegawai->where('id_surat_tugas', $id)->findAll(),
        ];

        // load HTML content
        $dompdf->loadHtml(view('/export/pdf_spt', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }

    public function kwitansi()
    {
        $filename = date('y-m-d-H-i-s') . '-qadr-labs-report';
        $dompdf = new Dompdf();
        $surat = new SuratModel();
        $kwitansi = new KwitansiModel();
        $id = $this->request->getVar('id_surat_tugas');
        $data = [
            'surat'  => $surat->find($id),
            'kwitansi'  => $kwitansi->where('id_surat_tugas', $id)->first(),
        ];

        $dompdf->loadHtml(view('/export/pdf_kwitansi', $data));
        $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }
}

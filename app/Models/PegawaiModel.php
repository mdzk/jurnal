<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $allowedFields = ['nama_pegawai', 'nip', 'jabatan', 'tmt_jabatan', 'masa_kerja', 'golongan', 'tmt_golongan', 'pendidikan', 'instansi_pendidikan', 'thn_lulus'];
}

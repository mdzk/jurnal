<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table      = 'jurnal';
    protected $primaryKey = 'id_jurnal';
    protected $allowedFields = ['nama', 'keterangan', 'tanggal', 'tempat', 'penyelenggara', 'foto', 'jam_mulai', 'jam_berakhir', 'status', 'id_users', 'id_kinerja'];
}

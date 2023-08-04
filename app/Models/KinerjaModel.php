<?php

namespace App\Models;

use CodeIgniter\Model;

class KinerjaModel extends Model
{
    protected $table      = 'kinerja';
    protected $primaryKey = 'id_kinerja';
    protected $allowedFields = ['keterangan', 'capaian', 'realisasi', 'kuantitas', 'point', 'status', 'id_users'];
}

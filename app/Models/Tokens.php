<?php

namespace App\Models;

use CodeIgniter\Model;

class Tokens extends Model
{
    protected $table      = 'tokens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['token', 'user_id', 'created'];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['name', 'nip', 'picture', 'jabatan', 'golongan', 'kepala', 'unit', 'username', 'password', 'role'];
}

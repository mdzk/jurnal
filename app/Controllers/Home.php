<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $user = new UsersModel();
        $jurnal = new JurnalModel();
        if (session('role') == 'user') {
            $data = [
                'jurnal'  => $jurnal->where('id_users', session('id_users'))->where('MONTH(tanggal)', date('n'))->findAll(),
                'user'  => $user->join('golongan', 'golongan.id_golongan = users.golongan')->find(session()->get('id_users')),
            ];
        } else {
            $data = [
                'user'  => $user->join('golongan', 'golongan.id_golongan = users.golongan')->find(session()->get('id_users')),
            ];
        }
        return view('admin/home', $data);
    }

    public function terlaksana()
    {
        function bulan($a)
        {
            $jurnal = new JurnalModel();
            $bulan = $jurnal->where('MONTH(tanggal)', $a)->where('YEAR(tanggal)', date('Y'))->where('status', 'terverifikasi')->where('id_users', session('id_users'))->countAllResults();
            return $bulan;
        };
        $month = array(bulan(1), bulan(2), bulan(3), bulan(4), bulan(5), bulan(6), bulan(7), bulan(8), bulan(9), bulan(10), bulan(11), bulan(12));
        return print_r(json_encode(array_values($month)));
    }
}

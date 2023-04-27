<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $user = new UsersModel();
        $data = [
            'user'  => $user->find(session()->get('id_users')),
        ];
        return view('admin/home', $data);
    }

    // public function terlaksana()
    // {
    //     function bulan($a)
    //     {
    //         $visitor = new SuratModel();
    //         $bulan = $visitor->where('MONTH(created_at)', $a)->where('YEAR(created_at)', date('Y'))->where('status', 'selesai')->countAllResults();
    //         return $bulan;
    //     };
    //     $month = array(bulan(1), bulan(2), bulan(3), bulan(4), bulan(5), bulan(6), bulan(7), bulan(8), bulan(9), bulan(10), bulan(11), bulan(12));
    //     return print_r(json_encode(array_values($month)));
    // }
}

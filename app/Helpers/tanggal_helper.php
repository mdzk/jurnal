<?php
if (!function_exists('tanggal')) {
    function tanggal($timestamp)
    {
        $hari = date('D', strtotime($timestamp));
        $bulan = date('M', strtotime($timestamp));
        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;
            case 'Mon':
                $hari_ini = "Senin";
                break;
            case 'Tue':
                $hari_ini = "Selasa";
                break;
            case 'Wed':
                $hari_ini = "Rabu";
                break;
            case 'Thu':
                $hari_ini = "Kamis";
                break;
            case 'Fri':
                $hari_ini = "Jumat";
                break;
            case 'Sat':
                $hari_ini = "Sabtu";
                break;
            default:
                $hari_ini = "Tidak diketahui";
                break;
        }

        switch ($bulan) {
            case 'Jan':
                $bulan_id = "Januari";
                break;
            case 'Feb':
                $bulan_id = "Februari";
                break;
            case 'Mar':
                $bulan_id = "Maret";
                break;
            case 'Apr':
                $bulan_id = "April";
                break;
            case 'May':
                $bulan_id = "Mei";
                break;
            case 'Jun':
                $bulan_id = "Juni";
                break;
            case 'Jul':
                $bulan_id = "Juli";
                break;
            case 'Aug':
                $bulan_id = "Agustus";
                break;
            case 'Sep':
                $bulan_id = "September";
                break;
            case 'Oct':
                $bulan_id = "Oktober";
                break;
            case 'Nov':
                $bulan_id = "November";
                break;
            case 'Dec':
                $bulan_id = "Desember";
                break;
            default:
                $bulan_id = "Tidak diketahui";
                break;
        }
        return $hari_ini . ', ' . date('d', strtotime($timestamp)) . ' ' . $bulan_id . ' ' . date('Y', strtotime($timestamp));
    }
}

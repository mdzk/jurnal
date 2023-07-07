<?php
if (!function_exists('get_nip')) {
    function get_nip($nip)
    {
        $format_baru = substr_replace($nip, ' ', 8, 0);
        $format_baru = substr_replace($format_baru, ' ', 15, 0);
        $format_baru = substr_replace($format_baru, ' ', 17, 0);
        return $format_baru;
    }
}

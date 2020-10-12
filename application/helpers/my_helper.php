<?php

function is_logged_in_admin() {
    $ci = get_instance();
    if (!$ci->session->has_userdata('admin') OR $ci->session->userdata('admin') == FALSE) {
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');
    }
}

function filter_output($str){
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
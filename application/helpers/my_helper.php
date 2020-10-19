<?php

function is_logged_in_admin() {
    $ci = get_instance();
    if (!$ci->session->has_userdata('admin') OR $ci->session->userdata('admin') == FALSE) {
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');
    }
}

function is_logged_in_kustomer() {
    $ci = get_instance();
    if (!$ci->session->has_userdata('kustomer') OR $ci->session->userdata('kustomer') == FALSE) {
        $ci->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Maaf kamu harus login terlebih dahulu untuk mengakses menu ini.</div></div>');
        redirect('home');
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

function harga($harga)
{
    $crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
    $crncy->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'IDR');
    $crncy->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
    $crncy = $crncy->formatCurrency($harga, "IDR");
    return $crncy;
}
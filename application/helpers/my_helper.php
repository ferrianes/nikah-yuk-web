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
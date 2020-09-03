<?php

function is_logged_in() {
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');
        
    }
}

function filter_output($str){
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
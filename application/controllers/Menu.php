<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata['email']) {
            redirect('auth');            
        }
    }

    public function index()
    {
        $data['title'] = 'Menu Management';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('menu/index');
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }

}
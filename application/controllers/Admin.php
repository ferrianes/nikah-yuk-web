<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');
        is_logged_in_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];
        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar' ,$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }
}
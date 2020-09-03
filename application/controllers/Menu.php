<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');
        if (!$this->session->userdata['email']) {
            redirect('auth');            
        }
    }

    public function index()
    {
        // Validasi Menu
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => 'Menu Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Menu Management';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', 'email', $this->session->userdata('email'));
    
            $data['menus'] = $this->Utama_model->getDatas('menus');
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal');
            $this->load->view('templates/footer2');
        } else {
            $this->Utama_model->insertData('menus');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }
    }

    public function deleteMenu()
    {
        $this->Utama_model->deleteData('menus');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
    }

}
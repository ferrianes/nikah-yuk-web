<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
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
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|trim|numeric|is_unique[admin_menu.urutan]', [
            'required' => 'Urutan Harus diisi!!!',
            'numeric' => 'Urutan Harus berupa angka!',
            'is_unique' => 'Urutan yang diinginkan sudah ada'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Produk Management';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];
    
            $data['kategoris'] = $this->Utama_model->getDatas('kategoris');

            $data['products'] = $this->Utama_model->getDatas('products');

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/index', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal');
            $this->load->view('templates/footer2');
        } else {
            $data = [
                'menu' => $this->input->post('menu', TRUE),
                'urutan' => $this->input->post('urutan', TRUE)
            ];
            $this->Utama_model->insertData('menus', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }
    }

}
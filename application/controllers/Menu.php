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
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];
    
            $data['menus'] = $this->Utama_model->getDatas('menus');

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal');
            $this->load->view('templates/footer2');
        } else {
            $data = ['menu' => $this->input->post('menu', TRUE)];
            $this->Utama_model->insertData('menus', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }
    }

    public function deleteMenu()
    {
        $data = ['id' => $this->uri->segment(3)];
        $this->Utama_model->deleteData('menus', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
    }

    public function editMenu()
    {
        // Validasi Menu
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => 'Menu Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Menu Management';
            $id = $this->uri->segment(3);
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];
    
            $data['menu'] = $this->Utama_model->getDatas('menus', ['id'=> $id])[0];

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal');
            $this->load->view('templates/footer2');
        } else {
            $data = [
                'menu' => $this->input->post('menu', TRUE),
                'id' => $this->uri->segment(3)
            ];
            
            $this->Utama_model->updateData('menus', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }
    }

    public function access_menu()
    {
        // Validasi Menu
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim', [
            'required' => 'Menu Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('level_id', 'Level', 'required|trim', [
            'required' => 'Level Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Akses Menu Admin';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['access_menus'] = $this->Utama_model->getDatas('access_menus');

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/access_menu', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal', $data['title']);
            $this->load->view('templates/footer2');
        } else {
            $level_id = $this->input->post('level_id', true);
            $menu_id = $this->input->post('menu_id', true);

            $access_menu_cek = $this->Utama_model->getDatas('access_menus_raw');

            foreach($access_menu_cek as $amc) {
                if ($level_id === $amc['level_id'] && $menu_id === $amc['menu_id']) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Akses Menu Sudah Ada!</div>');
                    redirect('menu/access_menu');
                } else {
                    $data = [
                        'level_id' => $level_id,
                        'menu_id' => $menu_id
                    ];

                    $this->Utama_model->insertData('access_menus_raw', $data);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('menu/access_menu');
                }
            }
        }
    }

}
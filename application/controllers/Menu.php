<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');
        is_logged_in_admin();
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
            $data = [
                'menu' => $this->input->post('menu', TRUE),
                'urutan' => $this->input->post('urutan', TRUE)
            ];
            $this->Utama_model->insertData('menus', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }
    }

    public function deleteMenu()
    {
        $data = ['id' => $this->uri->segment(3)];
        $cek = $this->Utama_model->getDatas('access_menus_raw', ['menu_id' => $this->uri->segment(3)]);
        // cek apakah ada data menu di table access menu
        if (!array_key_exists("status", $cek)) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data <strong>Gagal</strong> dihapus<br>Karena masih adanya data di tabel access menu<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        } else {
            $this->Utama_model->deleteData('menus', $data);
    
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }
    }

    public function editMenu()
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
                'urutan' => $this->input->post('urutan', TRUE),
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

            //validasi apabila data sudah ada
            foreach($access_menu_cek as $amc) {
                if ($level_id === $amc['level_id'] && $menu_id === $amc['menu_id']) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Akses Menu Sudah Ada!</div>');
                    redirect('menu/access_menu');
                }
            }
            $data = [
                'level_id' => $level_id,
                'menu_id' => $menu_id
            ];

            $this->Utama_model->insertData('access_menus_raw', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/access_menu');
        }
    }

    public function submenu()
    {
        // Validasi Menu
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim', [
            'required' => 'Menu Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('title', 'Judul Submenu', 'required|trim', [
            'required' => 'Judul Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'URL Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => 'Icon Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Sub Menu Management';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['submenus'] = $this->Utama_model->getDatas('sub_menu');

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/sub_menu', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal', $data['title']);
            $this->load->view('templates/footer2');
        } else {
            $menu_id = $this->input->post('menu_id', true);
            $title = $this->input->post('title', true);
            $url = $this->input->post('url', true);
            $icon = $this->input->post('icon', true);
            $is_active = $this->input->post('is_active', true);

            $data = [
                'menu_id' => $menu_id,
                'title' => $title,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];

            $this->Utama_model->insertData('sub_menu', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/submenu');
        }
    }

    public function editAccessMenu()
    {
        // Validasi Menu
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim', [
            'required' => 'Menu Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('level_id', 'Level', 'required|trim', [
            'required' => 'Level Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $id = $this->uri->segment(3);
            $data['title'] = 'Akses Menu Admin';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['access_menu'] = $this->Utama_model->getDatas('access_menus_raw', ['id' => $id])[0];

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_access_menu', $data);
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
                }
            }

            $data = [
                'level_id' => $level_id,
                'menu_id' => $menu_id,
                'id' => $this->uri->segment(3)
            ];

            $this->Utama_model->updateData('access_menus_raw', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/access_menu');
        }
    }

    public function editSubmenu()
    {
        // Validasi Menu
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim', [
            'required' => 'Menu Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('title', 'Judul Submenu', 'required|trim', [
            'required' => 'Judul Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'URL Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => 'Icon Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Sub Menu Management';
            $id = $this->uri->segment(3);
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['submenu'] = $this->Utama_model->getDatas('sub_menu', ['id' => $id])[0];

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_sub_menu', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal');
            $this->load->view('templates/footer2');
        } else {
            $menu_id = $this->input->post('menu_id', true);
            $title = $this->input->post('title', true);
            $url = $this->input->post('url', true);
            $icon = $this->input->post('icon', true);
            $is_active = $this->input->post('is_active', true);

            $data = [
                'menu_id' => $menu_id,
                'title' => $title,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active,
                'id' => $this->uri->segment(3)
            ];

            $this->Utama_model->updateData('sub_menu', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/submenu');
        }
    }

    public function deleteAccessMenu()
    {
        $data = ['id' => $this->uri->segment(3)];
        $this->Utama_model->deleteData('access_menus_raw', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<br>Silahkan tambahkan submenu di menu submenu<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/access_menu');
    }

    public function deleteSubmenu()
    {
        $data = ['id' => $this->uri->segment(3)];
        $this->Utama_model->deleteData('sub_menu', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/submenu');
    }

}
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
        // Validasi
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[512]', [
            'required' => 'Deskripsi Harus diisi!!!',
            'max_length' => 'Panjang karakter Deskripsi melebihi 512 karakter'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|max_length[11]', [
            'required' => 'Harga Harus diisi!!!',
            'numeric' => 'Karakter Harga harus berupa angka!',
            'max_length' => 'Panjang karakter Harga melebihi 11 karakter'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|max_length[11]', [
            'required' => 'Stok Harus diisi!!!',
            'numeric' => 'Karakter Stok harus berupa angka!',
            'max_length' => 'Panjang karakter Stok melebihi 11 karakter'
        ]);
        $this->form_validation->set_rules('diorder', 'Diorder', 'required|numeric|max_length[11]', [
            'required' => 'Diorder Harus diisi!!!',
            'numeric' => 'Karakter Diorder harus berupa angka!',
            'max_length' => 'Panjang karakter melebihi 11 karakter'
        ]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|numeric|max_length[11]', [
            'required' => 'Diskon Harus diisi!!!',
            'numeric' => 'Karakter Diskon harus berupa angka!',
            'max_length' => 'Panjang karakter Diskon melebihi 11 karakter'
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
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'diorder' => $this->input->post('diorder', TRUE),
                'diskon' => $this->input->post('diskon', TRUE)
            ];

            $products = $this->Utama_model->insertData('products', $data);
            $data_image = [
                [
                    'name' => 'Contents-0',
                    'contents' => fopen($_FILES['gambar']['tmp_name'], 'r'),
                    'filename' => $_FILES['gambar']['name']
                ],
                [
                    'name' => 'thumbnail',
                    'contents' => 1
                ],
                [
                    'name' => 'produk_id',
                    'contents' => $products['last_id']
                ]
            ];
            $status = $this->Utama_model->uploadData('produk_gambar', $data_image);

            if ($status['status'] == 400) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Thumbnail gagal. '. $status['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('product');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('product');
            }
        }
    }

    public function detailProduct()
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
            $data['title'] = 'Produk Management';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];

            $data['produks_gambar'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 0]);

            $data['thumbnail'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 1])[0];

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/detail_produk', $data);
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

    public function editproduct()
    {
        // Validasi
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama Harus diisi!!!'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[512]', [
            'required' => 'Deskripsi Harus diisi!!!',
            'max_length' => 'Panjang karakter Deskripsi melebihi 512 karakter'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|max_length[11]', [
            'required' => 'Harga Harus diisi!!!',
            'numeric' => 'Karakter Harga harus berupa angka!',
            'max_length' => 'Panjang karakter Harga melebihi 11 karakter'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|max_length[11]', [
            'required' => 'Stok Harus diisi!!!',
            'numeric' => 'Karakter Stok harus berupa angka!',
            'max_length' => 'Panjang karakter Stok melebihi 11 karakter'
        ]);
        $this->form_validation->set_rules('diorder', 'Diorder', 'required|numeric|max_length[11]', [
            'required' => 'Diorder Harus diisi!!!',
            'numeric' => 'Karakter Diorder harus berupa angka!',
            'max_length' => 'Panjang karakter melebihi 11 karakter'
        ]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|numeric|max_length[11]', [
            'required' => 'Diskon Harus diisi!!!',
            'numeric' => 'Karakter Diskon harus berupa angka!',
            'max_length' => 'Panjang karakter Diskon melebihi 11 karakter'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $id = $this->uri->segment(3);
            $data['title'] = 'Produk Management';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];

            $data['produks_gambar'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 0]);

            $data['thumbnail'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 1])[0];

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/detail_produk', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/modal', $data['title']);
            $this->load->view('templates/footer2');
        } else {
            $nama = $this->input->post('nama', true);
            $id_kategori = $this->input->post('id_kategori', true);
            $deskripsi = $this->input->post('deskripsi', true);
            $harga = $this->input->post('harga', true);
            $stok = $this->input->post('stok', true);
            $diorder = $this->input->post('diorder', true);
            $gambar_lama = $this->input->post('gambar_lama', true);
            $diskon = $this->input->post('diskon', true);

            $data = [
                'nama' => $nama,
                'id_kategori' => $id_kategori,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'diorder' => $diorder,
                'diskon' => $diskon,
                'id' => $this->uri->segment(3)
            ];

            $this->Utama_model->updateData('products', $data);

            if (!empty($_FILES['gambar']['name'])) {
                $data_image = [
                    [
                        'name' => 'Contents-0',
                        'contents' => fopen($_FILES['gambar']['tmp_name'], 'r'),
                        'filename' => $_FILES['gambar']['name']
                    ],
                    [
                        'name' => 'thumbnail',
                        'contents' => 1
                    ],
                    [
                        'name' => 'produk_id',
                        'contents' => $this->uri->segment(3)
                    ]
                ];
                // agak tricky untuk update gambarnya dari api

                // diupload dulu gambar yang baru
                $gambar = $this->Utama_model->uploadData('produk_gambar', $data_image);
                // hapus data gambar yang lama
                $this->Utama_model->deleteData('galeri', ['id' => $gambar_lama]);
                // update id gambar jadi sama kayak yang gambar lama
                $this->Utama_model->updateData('produk_gambar', ['id' => $gambar_lama, 'id_baru' => $gambar['last_id']]);
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('product/detailproduct/' . $this->uri->segment(3));
        }
    }

    public function deleteproduct()
    {
        $id = $this->uri->segment(3);
        $galeries = $this->Utama_model->getDatas('galeri', ['produk_id' => $id], $id);
        if(!isset($galeries['status']) OR $galeries['status'] != false) {
            foreach ($galeries as $galeri ) {
                $this->Utama_model->deleteData('galeri', ['id' => $galeri['id']]);
            }
        }
        $data = ['id' => $id];
        $this->Utama_model->deleteData('products', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<br><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('product');
    }

    public function deletegaleri()
    {
        $data = ['id' => $this->uri->segment(3)];
        $produk_id = $this->uri->segment(4);
        $this->Utama_model->deleteData('galeri', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Galeri <strong>Berhasil</strong> dihapus.<br><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('product/detailproduct/' . $produk_id);
    }

    public function tambahGaleri()
    {
        $galeri = $_FILES['galeri'];
        $produk_id = $this->uri->segment(3);

        $data = [];
        foreach ($galeri['name'] as $key => $image) {  
            $data[] = [
                'name' => 'Contents-' . $key,
                'contents' => fopen($galeri['tmp_name'][$key], 'r'),
                'filename' => $image
            ];
        }

        $data[] = [
            'name' => 'produk_id',
            'contents' => $produk_id
        ];
        $data[] = [
            'name' => 'thumbnail',
            'contents' => 0
        ];

        $status = $this->Utama_model->uploadData('produk_gambar', $data);

        if ($status['status'] == 400) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'. $status['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('product/detailproduct/' . $produk_id);
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('product/detailproduct/' . $produk_id);
        }

    }

}
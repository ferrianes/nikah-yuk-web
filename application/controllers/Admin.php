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
        $data['admin'] = $this->Utama_model->getDatas('admin', ['email' => $this->session->userdata('email')])[0];
        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar' ,$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }

    public function daftarProduk()
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
    
            $data['admin'] = $this->Utama_model->getDatas('admin', ['email' => $this->session->userdata('email')])[0];
    
            $data['kategori'] = $this->Utama_model->getDatas('kategori');

            $data['produk'] = $this->Utama_model->getDatas('produk');

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/produk/index', $data);
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

            $produk = $this->Utama_model->insertData('produk', $data);

            if ($produk['status'] === 400) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'. $produk['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/daftarproduk');
            } else {
                if (is_uploaded_file($_FILES['gambar']['tmp_name'])) {
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
                            'contents' => $produk['last_id']
                        ]
                    ];
                    $status = $this->Utama_model->uploadData('produk_gambar', $data_image);
        
                    if ($status['status'] == 400) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Thumbnail gagal. '. $status['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('admin/daftarproduk');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('admin/daftarproduk');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('admin/daftarproduk');
                }
            }
        }
    }

    public function detailproduk()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Produk Management';

        $data['admin'] = $this->Utama_model->getDatas('admin', ['email' => $this->session->userdata('email')])[0];

        $data['produk'] = $this->Utama_model->getDatas('produk', ['id' => $id])[0];

        $data['produk_gambar'] = $this->Utama_model->getDatas('produk_gambar', ['produk_id' => $id, 'thumbnail' => 0]);

        $data['thumbnail'] = $this->Utama_model->getDatas('produk_gambar', ['produk_id' => $id, 'thumbnail' => 1]);

        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk/detail_produk', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal', $data['title']);
        $this->load->view('templates/footer2');
    }

    public function editproduk()
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
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data Gagal Diinput!</strong>
                    ' . validation_errors('<div>', '</div>') . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            redirect('admin/daftarproduk/' . $this->uri->segment(3));
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

            $this->Utama_model->updateData('produk', $data);

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
            redirect('admin/daftarproduk/' . $this->uri->segment(3));
        }
    }

    public function deleteproduk()
    {
        $id = $this->uri->segment(3);
        $galeries = $this->Utama_model->getDatas('galeri', ['produk_id' => $id], $id);
        if(!isset($galeries['status']) OR $galeries['status'] != false) {
            foreach ($galeries as $galeri ) {
                $this->Utama_model->deleteData('galeri', ['id' => $galeri['id']]);
            }
        }
        $data = ['id' => $id];

        //cek response dari server
        $delete = $this->Utama_model->deleteData('produk', $data);

        if ($delete['status'] == 200) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> dihapus.<br><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/daftarproduk');
        } else if ($delete['status'] == 500) {
            if ($delete[0]['code'] === 1451) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data <strong>Gagal</strong> dihapus. Karena masih adanya produk di booking kustomer.<br>Fix : Selesaikan atau hapus data booking detail dan temp yang berkaitan dengan produk yang ingin dihapus.<br><br>Full error : ' . $delete[0]['message'] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/daftarproduk');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'. $delete['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/daftarproduk');
        }

    }

    public function deletegaleri()
    {
        $data = ['id' => $this->uri->segment(3)];
        $produk_id = $this->uri->segment(4);
        $this->Utama_model->deleteData('galeri', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Galeri <strong>Berhasil</strong> dihapus.<br><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/daftarproduk/' . $produk_id);
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
            redirect('admin/daftarproduk/' . $produk_id);
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/daftarproduk/' . $produk_id);
        }

    }

    public function kategoriproduk()
    {
        // Validasi
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama Harus diisi!!!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Kategori Management';
    
            $data['admin'] = $this->Utama_model->getDatas('admin', ['email' => $this->session->userdata('email')])[0];
    
            $data['kategori'] = $this->Utama_model->getDatas('kategori');

            $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kategori/daftar-kategori', $data);
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

            $produk = $this->Utama_model->insertData('produk', $data);
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
                    'contents' => $produk['last_id']
                ]
            ];
            $status = $this->Utama_model->uploadData('produk_gambar', $data_image);

            if ($status['status'] == 400) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Thumbnail gagal. '. $status['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/daftarproduk');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data <strong>Berhasil</strong> ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/daftarproduk');
            }
        }
    }

    public function booking()
    {
        $data['title'] = 'Data Booking';
    
        $data['admin'] = $this->Utama_model->getDatas('admin', ['email' => $this->session->userdata('email')])[0];

        $data['booking'] = $this->Utama_model->getDatas('booking_temp');
        if (isset($data['booking']['status']) && $data['booking']['status'] == FALSE) {
            $data['booking'] = NULL;
        }

        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/booking/index', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }

    public function detailbooking()
    {
        $data['title'] = 'Data Booking';
    
        $data['admin'] = $this->Utama_model->getDatas('admin', ['email' => $this->session->userdata('email')])[0];

        $id = $this->uri->segment(3);

        $data['booking'] = $this->Utama_model->getDatas('booking', ['id_booking' => $id])[0];
        $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['id_kustomer' => $data['booking']['id_kustomer']])[0];

        $data['detail'] = $this->Utama_model->getDatas('booking_details', ['id_booking' => $id]);

        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/booking/detail_booking', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }
}
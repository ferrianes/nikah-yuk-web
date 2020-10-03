<?php

class Kustomer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');            
        
    }

    public function index()
    {
        $this->_login();
    }
    
    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);

        $user = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
        //jika usernya ada
        if ($user) {
            //jika user sudah aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email_kustomer' => $user['email'],
                        'id_kustomer' => $user['id_kustomer'],
                        'nama' => $user['nm_lengkap'],
                        'kustomer' => TRUE
                    ];

                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Kamu berhasil Login</div></div>');
                    redirect('home');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Email atau Password tidak benar</div></div>');
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Akun belum diaktifasi</div></div>');
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Email tidak terdaftar atau tidak valid</div></div>');
            redirect('home');
        }
    }

    public function register() 
    {
        //Form Validation Nama
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|min_length[3]|max_length[16]', [
            'required' => 'Nama Belum diisi!',
            'max_length' => 'Nama Melebihi 16 Karakter!',
            'min_length' => 'Nama terlalu pendek'
        ]);

        //Form Validation Alamat
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|max_length[128]', [
            'required' => 'Alamat Belum diisi!',
            'max_length' => 'Melebihi 128 Karakter!'
        ]);

        //Form Validation Email
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Belum diisi!',
            'valid_email' => 'Email tidak benar!',
            'is_unique' => 'Email sudah terdaftar'
        ]);

        //Form Validation Telepon
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric|min_length[10]|max_length[14]', [
            'required' => 'Telepon Belum diisi!',
            'max_length' => 'Telepon Melebihi 14 Karakter!',
            'min_length' => 'Telepon terlalu pendek!',
            'numeric' => 'Telepon harus berupa angka!'
        ]);

        //Form Validation Password
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'required' => 'Password harus diisi!!',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]', [
            'matches' => 'Password tidak sama!',
            'required' => 'Password harus diisi!!'
        ]);

        if (!$this->form_validation->run() == false) {
            $data = [
                'nm_lengkap' => $this->input->post('nama', true),
                'alamat' => $this->input->post('alamat', true),
                'email' => $this->input->post('email', true),
                'telepon' => $this->input->post('telepon', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'tgl_dibuat' => date("Y-m-d")
            ];
            $this->Utama_model->insertData('kustomer', $data);
            $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Selamat akun kamu sudah berhasil dibuar</div></div>');
            redirect('home');
        } else {
            $data['judul'] = 'Daftar Produk';

            $data['products'] = $this->Utama_model->getDatas('products');

            $data['kustomer'] = 'Pengunjung';

            $data['modal_active'] = TRUE;

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/daftar_produk', $data);
            $this->load->view('templates/templates-user/modal', $data);
            $this->load->view('templates/templates-user/footer', $data);
        }
        
    }

    public function profilku()
    {
        $data['judul'] = 'Profilku';

        $email = $this->session->email_kustomer;
        $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
        $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('kustomer/profilku', $data);
        $this->load->view('templates/templates-user/modal', $data);
        $this->load->view('templates/templates-user/footer', $data);
    }

    public function ubahProfil()
    {

        //Form Validation Nama
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|min_length[3]|max_length[16]', [
            'required' => 'Nama Belum diisi!',
            'max_length' => 'Nama Melebihi 16 Karakter!',
            'min_length' => 'Nama terlalu pendek'
        ]);

        //Form Validation Alamat
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|max_length[128]', [
            'required' => 'Alamat Belum diisi!',
            'max_length' => 'Melebihi 128 Karakter!'
        ]);

        //Form Validation Email
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Belum diisi!',
            'valid_email' => 'Email tidak benar!',
            'is_unique' => 'Email sudah terdaftar'
        ]);

        //Form Validation Telepon
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric|min_length[10]|max_length[14]', [
            'required' => 'Telepon Belum diisi!',
            'max_length' => 'Telepon Melebihi 14 Karakter!',
            'min_length' => 'Telepon terlalu pendek!',
            'numeric' => 'Telepon harus berupa angka!'
        ]);

        //Form Validation Password
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password harus diisi!!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Ubah Profil';
    
            $email = $this->session->email_kustomer;
            $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
            $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);
    
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('kustomer/ubah_profil', $data);
            $this->load->view('templates/templates-user/modal', $data);
            $this->load->view('templates/templates-user/footer', $data);
        } else {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);

            $user = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
            // var_dump($user);die;

            if (password_verify($password, $user['password'])) {

                // Ambil file yang diupload
                $gambar = $_FILES['foto-profil'];
                
                if (!empty($gambar['name'])) {
                    $data_image = [
                        [
                            'name' => 'Contents-0',
                            'contents' => fopen($gambar['tmp_name'], 'r'),
                            'filename' => $gambar['name']
                        ],
                        [
                            'name' => 'gambar_lama',
                            'contents' => $user['image']
                        ]
                    ];
                    // upload gambar baru dan hapus gambar lama
                    $gambar = $this->Utama_model->uploadData('kustomer_foto', $data_image);

                    if ($gambar['status'] == 400) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'. $gambar['message'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('kustomer/ubahprofil');
                    }

                    $image = $gambar['nama-baru'];
                }

                $data = [
                    'nm_lengkap' => $this->input->post('nama', true),
                    'alamat' => $this->input->post('alamat', true),
                    'email' => $email,
                    'telepon' => $this->input->post('telepon', true),
                    'id_kustomer' => $this->session->id_kustomer
                ];

                if (isset($image)) {
                    $data['image'] = $image;
                } else {
                    $data['image'] = $user['image'];
                }

                // Update data text
                $this->Utama_model->updateData('kustomer', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil berhasil diubah.</div>');
                redirect('kustomer/profilku');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Salah!!!</div>');
                redirect('kustomer/ubahprofil');
            }

            // $this->Utama_model->insertData('kustomer', $data);
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anda sudah dibuat.</div>');
            // redirect('home');
        }

    }

    public function logout()
    {
        $this->session->unset_userdata(['email_kustomer', 'id_kustomer', 'nama', 'kustomer']);
        $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Kamu berhasil Logout</div></div>');
        redirect('home');
    }

}
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
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[kustomer.email]', [
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
                'is_active' => 0,
                'tgl_dibuat' => date("Y-m-d")
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $kustomer_token = [
                'email' => $this->input->post('email', true),
                'kustomer_token' => $token
            ];

            $this->Utama_model->insertData('kustomer', $data);
            $this->Utama_model->insertData('kustomer_token', $kustomer_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Selamat akun kamu sudah berhasil dibuat. Silahkan aktifasi melalui email kamu.</div></div>');
            redirect('home');
        } else {
            $data['judul'] = 'Daftar Produk';

            $data['produk'] = $this->Utama_model->getDatas('produk');

            // sort by diorder DESC
            usort($data['produk'], function($a, $b) {
                return -($a['diorder'] <=> $b['diorder']);
            });

            // Limit to 2 Data
            $data['produk'] = array_slice($data['produk'], 0, 2);

            $data['kustomer']['nm_lengkap'] = 'Pengunjung';

            $data['kategori'] = $this->Utama_model->getDatas('kategori');

            $data['modal_active'] = TRUE;

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/landing-page', $data);
            $this->load->view('templates/templates-user/modal', $data);
            $this->load->view('templates/templates-user/footer', $data);
        }
        
    }
    
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => getenv('PROTOCOL'),
            'smtp_host' => getenv('EMAIL_HOST'),
            'smtp_crypto' => getenv('CRYPTO'),
            'smtp_user' => getenv('EMAIL_USERNAME'),
            'smtp_pass' => getenv('EMAIL_PASSWORD'),
            'smtp_port' => getenv('PORT'),
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        $this->email->from(getenv('EMAIL_USERNAME'), 'Nikah Yuk App');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify you account : <a href="'. base_url() .'kustomer/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        }
        
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $kustomer = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];

        if ($kustomer) {
            $kustomer_token = $this->Utama_model->getDatas('kustomer_token', ['kustomer_token' => $token])[0];

            if ($kustomer_token) {
                // Cek apakah token sudah lebih dari 1 hari
                if (time() - $kustomer_token['tgl_dibuat'] < (60*60*24)) {
                    $this->Utama_model->updateData('kustomer', [
                        'is_active' => 1,
                        'email' => $email 
                    ]);

                    $this->Utama_model->deleteData('kustomer_token', ['email' => $email]);
                    $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Account Activation Success! Please login.</div></div>');
                    redirect('home');
                } else{
                    $this->Utama_model->deleteData('kustomer', ['email' => $email]);
                    $this->Utama_model->deleteData('kustomer_token', ['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Account Activation Failed! Token expired.</div></div>');
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Account Activation Failed! Wrong token.</div></div>');
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Account Activation Failed! Wrong email.</div></div>');
            redirect('home');
        }
    }

    public function profilku()
    {
        $data['judul'] = 'Profilku';

        $email = $this->session->email_kustomer;
        $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
        $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

        $data['kategori'] = $this->Utama_model->getDatas('kategori');

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

            $data['kategori'] = $this->Utama_model->getDatas('kategori');
    
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
        }

    }

    public function logout()
    {
        $this->session->unset_userdata(['email_kustomer', 'id_kustomer', 'nama', 'kustomer']);
        $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Kamu berhasil Logout</div></div>');
        redirect('home');
    }

}
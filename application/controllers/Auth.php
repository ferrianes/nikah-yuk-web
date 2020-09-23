<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class Auth extends CI_Controller {
    public function index() {
        // Jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('email')) {
            if ($this->session->userdata('level') == 1) {
                redirect('admin');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!!',
            'valid_email' => 'Email Tidak Valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus diisi!!!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';

            //Kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
            $this->load->view('auth/header');
            $this->load->view('auth/login');
            $this->load->view('auth/footer');
        } else {
            $this->_login();
        }
    }

    private function _login() {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $admin = $this->db->get_where('admin', ['email' => $email])->row_array();

        //jika adminnya ada
        if ($admin) {
            //jika adminnya sudah aktif
            if ($admin['blokir'] == false) {
                //cek password
                if (password_verify($password, $admin['password'])) {
                    // set session
                    $data = [
                        'email' => $admin['email'],
                        'level' => $admin['level'],
                        'status' => 'admin'
                    ];

                    $this->session->set_userdata($data);
                    if ($admin['level'] == 1) {
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email atau Password Salah!!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Admin belum diaktifasi!!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email atau Password Salah!!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->load->view('auth/header');
        $this->load->view('auth/register');
        $this->load->view('auth/footer');
    }

    public function logout()
    {
        $this->session->unset_userdata(['email', 'level', 'status']);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil Logout!</div>');
        redirect('auth');
    }
}


?>
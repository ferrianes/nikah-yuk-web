<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');            
        
    }

    public function index()
    {
        $data['judul'] = 'Welcome';

        $data['products'] = $this->Utama_model->getDatas('products');
        // var_dump($_SESSION);die;

        //jika sudah login dan belum login
        if ($this->session->userdata('kustomer') == TRUE){
            
            $email = $this->session->email_kustomer;
            $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
            $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/landing-page', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {

            $data['kustomer']['nm_lengkap'] = 'Pengunjung';

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/landing-page', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        }
    }

    public function daftarProduk()
    {
        $data['judul'] = 'Daftar Produk';

        $data['products'] = $this->Utama_model->getDatas('products');
        // var_dump($_SESSION);die;

        //jika sudah login dan belum login
        if ($this->session->userdata('kustomer') == TRUE){
            
            $email = $this->session->email_kustomer;
            $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
            $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/daftar-produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {

            $data['kustomer']['nm_lengkap'] = 'Pengunjung';

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/daftar-produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        }
    }

    public function detailProduct()     
    {         
        $id = $this->uri->segment(3);
        $data['judul'] = 'Detail Produk';

        $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];

        $data['produks_gambar'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 0]);

        $data['thumbnail'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 1])[0];
         //jika sudah login dan belum login
        if ($this->session->userdata('kustomer') == TRUE){
            $email = $this->session->email_kustomer;
            $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
            $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/detail-produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {
            $data['kustomer']['nm_lengkap'] = 'Pengunjung';
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/detail-produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        }
    }
}
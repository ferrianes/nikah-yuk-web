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
           $id = $this->uri->segment(3);
            $data['judul'] = 'Daftar Produk';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['products'] = $this->Utama_model->getDatas('products');


        //jika sudah login dan belum login
        if ($this->session->userdata('email')){
            $kustomer   = $this->db->get_where('kustomer')->row_array();

            $data['kustomer'] = $kustomer['username'];

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/daftar_produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {
            $data['kustomer'] = 'Pengunjung';
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/daftar_produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        }
    }

    public function detailProduct()     
    {         
       $id = $this->uri->segment(3);
            $data['judul'] = 'Detail Produk';
    
            $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

            $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];

            $data['produks_gambar'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 0]);

            $data['thumbnail'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 1])[0];

            

         //jika sudah login dan belum login
        if ($this->session->userdata('email')){
            $kustomer   = $this->db->get_where('kustomer')->row_array();

            $data['kustomer'] = $kustomer['username'];

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/detail-produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {
            $data['kustomer'] = 'Pengunjung';
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('product/detail-produk', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');
    }

    public function index()
    {
        $data['judul'] = 'Daftar Produk';

        $data['kategori'] = $this->Utama_model->getDatas('kategori');

        $kategori = $this->uri->segment(3);

        $this->load->library('pagination');

        //konfigurasi pagination
        $config['base_url'] = base_url('produk/index'); //site url
        $config['total_rows'] = $this->Utama_model->getDatas('jumlah_produk'); //total row
        $config['per_page'] = 8;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '<i class="fa fa-angle-right"></i><span class="sr-only">Next</span>';
        $config['prev_link']        = '<i class="fa fa-angle-left"></i><span class="sr-only">Prev</span>';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['produk'] = $this->Utama_model->getDatas('produk', [
            'limit' => $config['per_page'], 
            'start' => $data['page']
        ]);     

        $data['pagination'] = $this->pagination->create_links();

        //jika sudah login dan belum login
        if ($this->session->userdata('kustomer') == TRUE){
            
            $email = $this->session->email_kustomer;
            $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
            $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

            if (isset($data['booking_temp']['status']) && $data['booking_temp']['status'] === FALSE) {
                $data['booking_temp'] = [];
            }

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

    public function detailProduk()     
    {         
        $id = $this->uri->segment(3);
        $data['judul'] = 'Detail Produk';

        $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];

        $data['kategori'] = $this->Utama_model->getDatas('kategori');

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

    public function kategori()
    {
        $data['judul'] = 'Daftar Produk';

        $data['produk'] = $this->Utama_model->getDatas('produk');

        $kategori = $this->uri->segment(3);
        // var_dump($data['products']);die;

        // $filterBy = 'CarEnquiry'; // or Finance etc.

        // $new = array_filter($arr, function ($var) use ($filterBy) {
        //     return ($var['name'] == $filterBy);
        // });

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

}
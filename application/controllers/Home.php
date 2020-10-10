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

        $data['produk'] = $this->Utama_model->getDatas('produk');
        
        // sort by diorder DESC
        usort($data['produk'], function($a, $b) {
            return -($a['diorder'] <=> $b['diorder']);
        });

        // Limit to 2 Data
        $data['produk'] = array_slice($data['produk'], 0, 2);

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

        $kategori = $this->uri->segment(3);
        // var_dump($data['products']);die;

        $filterBy = 'CarEnquiry'; // or Finance etc.

        $new = array_filter($arr, function ($var) use ($filterBy) {
            return ($var['name'] == $filterBy);
        });

        // switch ($kategori) {
        //     case 'kado-pernikahan':
        //         // Filter produk kado pernikahan
        //         $a = array_filter($data['products'], function($k) {
        //             return ($k['id_kategori'] == '1');
        //         });
        //         var_dump($a);die;
        //         break;

        //     case 'paket-pernikahan':
        //         // Filter produk kado pernikahan
        //         $a = array_filter($data['products'], function($k) {
        //             return ($k['id_kategori'] == '2');
        //         });
        //         var_dump($a);die;
        //         break;

        //     case 'vendor-pernikahan':
        //         // Filter produk kado pernikahan
        //         $a = array_filter($data['products'], function($k) {
        //             return ($k['id_kategori'] == '3');
        //         });
        //         var_dump($a);die;
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }

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
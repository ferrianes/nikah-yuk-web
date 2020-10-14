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

        $data['kategori'] = $this->Utama_model->getDatas('kategori');
        
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
            if (isset($data['booking_temp']['status']) && $data['booking_temp']['status'] === FALSE) {
                $data['booking_temp'] = [];
            }
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
    
}
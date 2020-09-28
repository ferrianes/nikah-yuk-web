<?php
use Carbon\Carbon;
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');
    }

    public function index()
    {
        $data['title'] = 'Data Booking';
    
        $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

        $data['bookings'] = $this->Utama_model->getDatas('bookings');
        
        $array = [];
        foreach ($data['bookings'] as $key => $value) {  
            $kustomer = $this->Utama_model->getDatas('kustomer', ['id_kustomer' => $data['bookings'][$key]['id_kustomer']])[0];
            $array[] = [
                'nm_lengkap' => $kustomer['nm_lengkap']
            ];
        }

        $data['kustomer'] = $array;

        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/index', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }

    public function detailbooking()
    {
        $data['title'] = 'Data Booking';
    
        $data['admin'] = $this->Utama_model->getDatas('admins', ['email' => $this->session->userdata('email')])[0];

        $id = $this->uri->segment(3);

        $data['booking'] = $this->Utama_model->getDatas('bookings', ['id_booking' => $id])[0];
        $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['id_kustomer' => $data['booking']['id_kustomer']])[0];

        $data['detail'] = $this->Utama_model->getDatas('booking_details', ['id_booking' => $id]);

        $data['menus_by_access_menu'] = $this->Utama_model->getDatas('menus_by_access_menu', ['level_id' => $this->session->userdata('level')]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/detail_booking', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer2');
    }

    public function tambahBooking()
    {

        //Form Validation Tanggal
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Acara', 'required', [
            'required' => 'Tanggal Acara harus diisi!'
        ]); 

        if ($this->form_validation->run() == FALSE) {

            $id = $this->uri->segment(3);
            $data['judul'] = 'Tambah Ke Booking';
    
            $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];
    
            $data['produks_gambar'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 0]);
    
            $data['thumbnail'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 1])[0];
             //jika sudah login dan belum login
            if ($this->session->userdata('kustomer') == TRUE){
                $email = $this->session->email_kustomer;
                $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];
                $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);
    
                $this->load->view('templates/templates-user/header', $data);
                $this->load->view('booking/tambah-booking', $data);
                $this->load->view('templates/templates-user/modal');
                $this->load->view('templates/templates-user/footer', $data);
            } else {
                $data['kustomer']['nm_lengkap'] = 'Pengunjung';
                $this->load->view('templates/templates-user/header', $data);
                $this->load->view('booking/tambah-booking', $data);
                $this->load->view('templates/templates-user/modal');
                $this->load->view('templates/templates-user/footer', $data);
            }
        } else {
            $tgl_acara = $this->input->post('tgl_acara', true);
            $id_kustomer = $this->session->id_kustomer;
            $id_produk = $this->uri->segment(3);

            $data = [
                'tgl_acara' => $tgl_acara,
                'id_kustomer' => $id_kustomer,
                'id_produk' => $id_produk
            ];

            $this->Utama_model->insertData('booking_temp', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Produk sudah ditambahkan ke keranjangmu.</div>');
            redirect('home');
        }
    }

    public function dataBooking()
    {
        $id = $this->uri->segment(3);
        $data['judul'] = 'Tambah Ke Booking';

        $data['produk'] = $this->Utama_model->getDatas('produks', ['id' => $id])[0];

        $data['produks_gambar'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 0]);

        $data['thumbnail'] = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $id, 'thumbnail' => 1])[0];

        $email = $this->session->email_kustomer;
        $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];

        $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

        $data['carbon'] = new Carbon();
        // echo $data['carbon'];die;
    
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/data-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer', $data);
    }
}
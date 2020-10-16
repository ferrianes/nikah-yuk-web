<?php
use Carbon\Carbon;
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in_kustomer();
        $this->load->model('Utama_model');
    }

    public function tambahBooking()
    {
        $id_kustomer = $this->session->id_kustomer;
        $id_produk = $this->uri->segment(3);

        $data = [
            'id_kustomer' => $id_kustomer,
            'id_produk' => $id_produk
        ];

        $temp = $this->Utama_model->getDatas('jumlah_booking_temp', ['id_produk' => $id_produk]);

        if (isset($temp['status']) && $temp['status'] === FALSE) {
            $temp = 0;
        }

        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Produk ini sudah ada dikeranjang mu.</div></div>');
            redirect('produk');
        }

        $this->Utama_model->insertData('booking_temp', $data);
        $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Produk berhasil ditambahkan ke keranjangmu.</div></div>');
        redirect('produk');
    }

    public function dataBooking()
    {
        $id = $this->uri->segment(3);
        $data['judul'] = 'Tambah Ke Booking';

        $data['produk'] = $this->Utama_model->getDatas('produk', ['id' => $id])[0];

        $email = $this->session->email_kustomer;

        $data['kategori'] = $this->Utama_model->getDatas('kategori');

        $data['kustomer'] = $this->Utama_model->getDatas('kustomer', ['email' => $email])[0];

        $data['booking_temp'] = $this->Utama_model->getDatas('booking_temp', ['id_kustomer' => $this->session->id_kustomer]);

        if (isset($data['booking_temp']['status']) && $data['booking_temp']['status'] === FALSE) {
            $data['booking_temp'] = [];
        }
    
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/data-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer', $data);
    }
}
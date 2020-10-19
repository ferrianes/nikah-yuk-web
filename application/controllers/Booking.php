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
        $harga = $this->uri->segment(4);

        $data = [
            'id_kustomer' => $id_kustomer,
            'id_produk' => $id_produk,
            'jumlah' => 1
        ];

        $temp = $this->Utama_model->getDatas('jumlah_booking_temp', ['id_produk' => $id_produk]);

        if (isset($temp['status']) && $temp['status'] === FALSE) {
            $temp = 0;
        }

        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-danger alert-message text-center" role="alert">Produk ini sudah ada dikeranjang mu.</div></div>');
            redirect('produk');
        }

        $booking_total_temp = $this->Utama_model->getDatas('booking_total_temp', ['id_kustomer' => $this->session->id_kustomer]);

        // Jika booking total belum ada
        if (isset($booking_total_temp['status']) && $booking_total_temp['status'] === FALSE && $booking_total_temp['message'] == 'Booking Total tidak ditemukan') {

            $data_total = [
                'id_kustomer' => $id_kustomer,
                'total' => $harga
            ];

            $this->Utama_model->insertData('booking_total_temp', $data_total);
        } else {
            $harga += $booking_total_temp[0]['total'];

            $data_total = [
                'id_kustomer' => $id_kustomer,
                'total' => $harga
            ];

            $this->Utama_model->updateData('booking_total_temp', $data_total);
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

        $data['booking_total_temp'] = $this->Utama_model->getDatas('booking_total_temp', ['id_kustomer' => $this->session->id_kustomer])[0];

        if (isset($data['booking_temp']['status']) && $data['booking_temp']['status'] === FALSE) {
            $data['booking_temp'] = [];
        }

        $text = "Halo, Saya ingin Booking : \n";
        $text .= "\n";

        if ( ! empty($data['booking_temp'])) {
            $no = 1;
            foreach ($data['booking_temp'] as $bt) {
                $produk = $this->Utama_model->getDatas('produk', ['id' => $bt['id_produk']])[0];
                $text .= $no . ". Produk  : " . $produk["nama"] . "\n";
                $text .= "    Harga    : " . harga($produk["harga"]) . "\n";
                $text .= "    Jumlah  : " . $bt["jumlah"] . "\n";
                $text .= "\n";

                $no++;
            }

            $text .= "  Estimasi Total    : " . harga($data['booking_total_temp']['total']);
        }

        $data['text'] = urlencode($text);
    
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/data-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer', $data);
    }

    public function simpanKeranjang()
    {
        $id = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');
        $id_kustomer = $this->session->id_kustomer;

        $data = [];
        foreach ($jumlah as $key => $jumlah) {
            $data[] = [
                'id' => $id[$key],
                'jumlah' => $jumlah
            ];
        }

        $data_total = [
            'id_kustomer' => $id_kustomer,
            'total' => $total
        ];

        $this->Utama_model->updateData('booking_temp_batch', $data);
        $this->Utama_model->updateData('booking_total_temp', $data_total);

        $this->session->set_flashdata('pesan', '<div class="fixed-top"><div class="alert alert-success alert-message text-center" role="alert">Keranjangmu berhasil disimpan.</div></div>');
        redirect('booking/dataBooking');
    }
}
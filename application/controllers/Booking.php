<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utama_model');
        if (!$this->session->userdata['email']) {
            redirect('auth');            
        }
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
}
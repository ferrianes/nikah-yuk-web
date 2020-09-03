<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
    }

    public function menus_get()
    {
        // menus from a data store e.g. database
        $id = $this->get('id');
        $menus = $this->menu->getMenus($id);
        // Check if the menus data store contains menus
        if ( $menus )
        {
            // Set the response and exit
            $this->response($menus, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Menu kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Menu tidak ditemukan'
                ], 404 );
            }
        }
    }
}
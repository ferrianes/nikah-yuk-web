<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Api_model');
    }

    public function menus_get()
    {
        // menus from a data store e.g. database
        $id = $this->get('id');
        $menus = $this->Api_model->getDatas('admin_menu', 'id', $id);
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

    public function admins_get()
    {
        // admins from a data store e.g. database
        $id = $this->get('email'); 
        $admins = $this->Api_model->getDatas('admin', 'email', $id);
        // Check if the admins data store contains admins
        if ( $admins )
        {
            // Set the response and exit
            $this->response($admins, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Admin kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Admin tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function access_menus_get()
    {
        // admins from a data store e.g. database
        $level_id = $this->get('level_id'); 
        $admins = $this->Api_model->getJoinDatas('admin_menu.id, menu', 'admin_menu', 'admin_access_menu', 'admin_menu.id = admin_access_menu.menu_id', 'admin_access_menu.level_id = '.$level_id);
        // Check if the admins data store contains admins
        if ( $admins )
        {
            // Set the response and exit
            $this->response($admins, 200);
        }
        else
        {
            // Set the response and exit
            if ($level_id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Akses Menu Admin kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Akses Menu Admin tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function menus_post()
    {
        $data = ['menu' => $this->post('menu')];

        if ($this->Api_model->insertData('admin_menu', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }

    public function menus_delete()
    {
        $id = $this->delete('id');

        if ($id === NULL) {
            $this->response(['message' => 'Masukkan id!'], 400);
        } else {
            if ($this->Api_model->deleteData('admin_menu', $id) > 0) {
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'Id tidak ditemukan'], 400);
            }
        }

    }

    public function menus_put()
    {
        $data = ['menu' => $this->put('menu')];
        $where = ['id' => $this->put('id')];

        if ($this->Api_model->updateData('admin_menu', $data, $where) > 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }
}
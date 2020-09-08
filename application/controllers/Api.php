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
        $menus = $this->Api_model->getDatas('admin_menu', ['id' => $id], $id);
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
        $admins = $this->Api_model->getDatas('admin', ['email' => $id], $id);
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

    public function levels_get()
    {
        // levels from a data store e.g. database
        $id = $this->get('id');
        $levels = $this->Api_model->getDatas('admin_level', ['id' => $id], $id);
        // Check if the levels data store contains levels
        if ( $levels )
        {
            // Set the response and exit
            $this->response($levels, 200);
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

    public function kategoris_get()
    {
        // kategoris from a data store e.g. database
        $id = $this->get('id');
        $kategoris = $this->Api_model->getDatas('kategori', ['id' => $id], $id);
        // Check if the kategoris data store contains kategoris
        if ( $kategoris )
        {
            // Set the response and exit
            $this->response($kategoris, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Kategori kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Kategori tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function produks_get()
    {
        // produks from a data store e.g. database
        $id = $this->get('id');
        $produks = $this->Api_model->getDatas('produk', ['id' => $id], $id);
        // Check if the produks data store contains produks
        if ( $produks )
        {
            // Set the response and exit
            $this->response($produks, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Produk kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function produks_gambar_get()
    {
        // produks_gambar from a data store e.g. database
        $id = $this->get('id');
        $produk_id = $this->get('produk_id');
        $thumbnail = $this->get('thumbnail');
        $cek = is_null($id) ? $produk_id : $id;
        $where = is_null($id) ? 'produk_id' : 'id';
        if (is_null($thumbnail)) {
            $produks_gambar = $this->Api_model->getDatas('produk_gambar', [$where => $cek], $cek);
        } else {
            $produks_gambar = $this->Api_model->getDatas('produk_gambar', [$where => $cek, 'thumbnail' => $thumbnail], $cek);
        }
        // Check if the produks_gambar data store contains produks_gambar
        if ( $produks_gambar )
        {
            // Set the response and exit
            $this->response($produks_gambar, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Produk kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404 );
            }
        }
    }

    // Buat Sidebar
    public function menus_by_access_menu_get()
    {
        // menus_by_access_menu from a data store e.g. database
        $level_id = $this->get('level_id');
        $menus_by_access_menu = $this->Api_model->getJoinDatas('admin_menu.id, menu', 'admin_menu', 'admin_access_menu', 'admin_menu.id = admin_access_menu.menu_id', 'admin_access_menu.level_id = '.$level_id, $level_id, 'admin_menu.urutan', 'ASC');
        // Check if the menus_by_access_menu data store contains access_menu
        if ( $menus_by_access_menu )
        {
            // Set the response and exit
            $this->response($menus_by_access_menu, 200);
        }
        else
        {
            // Set the response and exit
            if ($level_id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Akses Menu By Menu Admin kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Akses Menu By Menu tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function access_menus_get()
    {
        // access_menus from a data store e.g. database
        $level_id = $this->get('level_id');
        $access_menus = $this->Api_model->getThreeJoinDatas('admin_level.role, admin_menu.menu, admin_access_menu.id', 'admin_access_menu', 'admin_menu', 'admin_menu.id = admin_access_menu.menu_id', 'admin_level', 'admin_level.id = admin_access_menu.level_id', 'admin_access_menu.level_id = '.$level_id, $level_id);
        // Check if the access_menus data store contains access_menu
        if ( $access_menus )
        {
            // Set the response and exit
            $this->response($access_menus, 200);
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
                    'message' => 'Akses Menu tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function access_menus_raw_get()
    {
        // access_menus from a data store e.g. database
        $id = $this->get('id');
        $menu_id = $this->get('menu_id');
        $cek = is_null($id) ? $menu_id : $id;
        $where = is_null($id) ? 'menu_id' : 'id';
        $access_menus = $this->Api_model->getDatas('admin_access_menu', [$where => $cek], $cek);
        // Check if the access_menus data store contains access_menu
        if ( $access_menus )
        {
            // Set the response and exit
            $this->response($access_menus, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Akses Menu Admin kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Akses Menu tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function sub_menus_get()
    {
        // sub_menu from a data store e.g. database
        $id = $this->get('menu_id'); 
        $sub_menu = $this->Api_model->getDatas('admin_sub_menu', ['menu_id' => $id, 'is_active' => 1], $id);
        // Check if the sub_menu data store contains sub_menu
        if ( $sub_menu )
        {
            // Set the response and exit
            $this->response($sub_menu, 200);
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

    public function products_get()
    {
        // products from a data store e.g. database
        $id = $this->get('id');
        $products = $this->Api_model->getDatas('produk', ['id' => $id], $id);
        // Check if the products data store contains products
        if ( $products )
        {
            // Set the response and exit
            $this->response($products, 200);
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

    public function menus_post()
    {
        $data = [
            'menu' => $this->post('menu'),
            'urutan' => $this->post('urutan')
        ];

        if ($this->Api_model->insertData('admin_menu', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }
    

    public function products_post()
    {
        $data = [
            'id_kategori' => $this->post('id_kategori'),
            'tgl_input' => date("Y-m-d"),
            'nama' => $this->post('nama'),
            'deskripsi' => $this->post('deskripsi'),
            'harga' => $this->post('harga'),
            'stok' => $this->post('stok'),
            'diorder' => 0,
            'diskon' => 0
        ];
        // var_dump($data['diskon']);die;
        
        if ($this->Api_model->insertData('produk', $data) > 0) {
            $this->response([
                'last_id' => $this->db->insert_id(),
                'message' => 'Data berhasil diinput'
            ], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }

    public function products_gambar_post()
    {
        $produk_id = $this->post('produk_id');
        if ($this->post('thumbnail')) {
            $thumbnail = 1;
        } else {
            $thumbnail = 0;
        }
        $config = array(
            'upload_path' => './assets/img/api/products/',
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000"
            // 'max_height' => "768",
            // 'max_width' => "1024"
        );
        
        // $this->load->library('upload',$config);
        // $galeri = [];
        // var_dump($_FILES['FileContents']['type']);die;
        $this->load->library('upload',$config);
        if($this->upload->do_upload('FileContents'))
        {
            $image = $this->upload->data(); 
            $data = [
                'produk_id' => $produk_id,
                'gambar' => $image['file_name'],
                'thumbnail' => $thumbnail
            ];
            // echo 'tes';die;
            // var_dump($data);die;
            if ($this->Api_model->insertData('produk_gambar', $data) > 0) {
                $this->response([
                    'last_id' => $this->db->insert_id(),
                    'status' => 200,
                    'message' => 'Data berhasil diinput'
                ], 200);
            } else {
                $this->response([
                    'status' => 400,
                    'message' => 'Data gagal diinput',
                ], 400);
            }
        }
        else
        {
            $error = [
                'error' => $this->upload->display_errors('', ''),
                'status' => FALSE
            ];
            $this->response($error, 400);
        }
    }

    public function access_menus_raw_post()
    {
        $data = [
            'level_id' => $this->post('level_id'),
            'menu_id' => $this->post('menu_id')
        ];

        if ($this->Api_model->insertData('admin_access_menu', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }

    public function access_menus_raw_put()
    {
        $data = [
            'level_id' => $this->put('level_id'),
            'menu_id' => $this->put('menu_id')
        ];
        $where = ['id' => $this->put('id')];

        if ($this->Api_model->updateData('admin_access_menu', $data, $where) > 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function access_menus_raw_delete()
    {
        $id = $this->delete('id');

        if ($id === NULL) {
            $this->response(['message' => 'Masukkan id!'], 400);
        } else {
            if ($this->Api_model->deleteData('admin_access_menu', $id) > 0) {
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'Id tidak ditemukan'], 400);
            }
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
        $data = [
            'menu' => $this->put('menu'),
            'urutan' => $this->put('urutan')
        ];
        $where = ['id' => $this->put('id')];

        if ($this->Api_model->updateData('admin_menu', $data, $where) > 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }
}
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

    public function menu_get()
    {
        // menus from a data store e.g. database
        if (array_key_exists('id', $this->get())) {
            $where = ['id' => $this->get('id')];
        } else {
            $where = NULL;
        }
        $menu = $this->Api_model->getDatas('admin_menu', $where);
        // Check if the menu data store contains menu
        if ( $menu )
        {
            // Set the response and exit
            $this->response($menu, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
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

    public function admin_get()
    {
        // admins from a data store e.g. database
        if (array_key_exists('email', $this->get())) {
            $where = ['email' => $this->get('email')]; 
        } else {
            $where = NULL;
        }
        $admin = $this->Api_model->getDatas('admin', $where);
        // Check if the admin data store contains admin
        if ( $admin )
        {
            // Set the response and exit
            $this->response($admin, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
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

    public function level_get()
    {
        if (array_key_exists('id', $this->get())) {
            $where = ['id' => $this->get('id')];
        } else {
            $where = NULL;
        }
        $level = $this->Api_model->getDatas('admin_level', $where);
        // Check if the level data store contains level
        if ( $level )
        {
            // Set the response and exit
            $this->response($level, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
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

    public function kustomer_get()
    {
        // kustomer from a data store e.g. database
        if (array_key_exists('id_kustomer', $this->get())) {
            $where = ['id_kustomer' => $this->get('id_kustomer')];
        } else if (array_key_exists('email', $this->get())) {
            $where = ['email' => $this->get('email')];
        } else {
            $where = NULL;
        }
        $kustomer = $this->Api_model->getDatas('kustomer', $where);
        // Check if the kustomer data store contains kustomer
        if ( $kustomer )
        {
            // Set the response and exit
            $this->response($kustomer, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Kustomer kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Kustomer tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function kustomer_token_get()
    {
        // kustomer from a data store e.g. database
        if (array_key_exists('kustomer_token', $this->get())) {
            $where = ['token' => $this->get('kustomer_token')];
        } else if (array_key_exists('email', $this->get())) {
            $where = ['email' => $this->get('email')];
        } else {
            $where = NULL;
        }
        $kustomer_token = $this->Api_model->getDatas('kustomer_token', $where);
        // Check if the kustomer data store contains kustomer
        if ( $kustomer_token )
        {
            // Set the response and exit
            $this->response($kustomer_token, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Kustomer token kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Kustomer token tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function booking_total_temp_get()
    {
        if (array_key_exists('id_kustomer', $this->get())) {
            $where = ['id_kustomer' => $this->get('id_kustomer')];
        } else {
            $where = NULL;
        }
        $booking_total_temp = $this->Api_model->getDatas('booking_total_temp', $where);
        // Check if the booking_total_temp data store contains booking_total_temp
        if ( $booking_total_temp )
        {
            // Set the response and exit
            $this->response($booking_total_temp, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Booking Total kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Booking Total tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function booking_details_get()
    {
        // booking_details from a data store e.g. database
        if (array_key_exists('id_booking', $this->get())) {
            $where = ['booking_detail.id_booking' => $this->get('id_booking')];
        } else {
            $where = NULL;
        }

        $booking_details = $this->Api_model->getJoinDatas(
            'produk.*', 
            'booking_detail', 
            'produk', 'booking_detail.id_produk = produk.id', 
            $where
        );
        // Check if the booking_details data store contains booking_details
        if ( $booking_details )
        {
            // Set the response and exit
            $this->response($booking_details, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Detail Booking kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Detail Booking tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function sub_menu_get()
    {
        if (array_key_exists('id', $this->get())) {
            $where = ['admin_sub_menu.id' => $this->get('id')];
        } else {
            $where = NULL;
        }
        $id = $this->get('id');
        $sub_menu = $this->Api_model->getJoinDatas(
            'admin_sub_menu.*, admin_menu.menu', // Select
            'admin_sub_menu', // From
            'admin_menu', 'admin_sub_menu.menu_id = admin_menu.id', // Join On 
            $where // Where
        );
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
                    'message' => 'Submenu kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Submenu tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function booking_temp_get()
    {
        $id = $this->get('id');
        $id_kustomer = $this->get('id_kustomer');

        if (array_key_exists('id', $this->get())) {
            $where = ['booking_temp.id' => $id];
        } else if (array_key_exists('id_kustomer', $this->get())) {
            $where = ['booking_temp.id_kustomer' => $id_kustomer];
        } else {
            $where = NULL;
        }

        $booking_temp = $this->Api_model->getThreeJoinDatas(
            'booking_temp.* ,produk.nama AS produk, kustomer.nm_lengkap, kustomer.telepon', // Select
            'booking_temp', // From
            'produk', 'produk.id = booking_temp.id_produk', // Join On
            'kustomer', 'kustomer.id_kustomer = booking_temp.id_kustomer', // Join On
            $where, //Where
            999 // limit
        );
        // Check if the booking_temp data store contains booking_temp
        if ( $booking_temp )
        {
            // Set the response and exit
            $this->response($booking_temp, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Booking temp kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Booking temp tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function produk_gambar_get()
    {
        if (array_key_exists('id', $this->get())) {
            $where = ['id' => $this->get('id')];
        } else if (array_key_exists('produk_id', $this->get()) && array_key_exists('thumbnail', $this->get())) {
            $where = [
                'produk_id' => $this->get('produk_id'),
                'thumbnail' => $this->get('thumbnail')
            ];
        } else if (array_key_exists('id', $this->get()) && array_key_exists('thumbnail', $this->get())) {
            $where = [
                'id' => $this->get('id'),
                'thumbnail' => $this->get('thumbnail')
            ];
        } else {
            $where = NULL;
        }
        $produk_gambar = $this->Api_model->getDatas('produk_gambar', $where);

        // Check if the produk_gambar data store contains produk_gambar
        if ( $produk_gambar )
        {
            // Set the response and exit
            $this->response($produk_gambar, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
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
        if (array_key_exists('level_id', $this->get())) {
            $where = ['admin_access_menu.level_id' => $this->get('level_id')];
        } else {
            $where = NULL;
        }
        $level_id = $this->get('level_id');
        $menus_by_access_menu = $this->Api_model->getJoinDatas(
            'admin_menu.id, menu', // Select 
            'admin_menu', // From
            'admin_access_menu', 'admin_menu.id = admin_access_menu.menu_id', // Join On 
            100, 0, // Limit Offset
            $where, // Where
            'admin_menu.urutan', 'ASC' // Order by
        );
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
        if (array_key_exists('level_id', $this->get())) {
            $where = ['admin_access_menu.level_id' => $this->get('level_id')];
        } else {
            $where = NULL;
        }

        $access_menus = $this->Api_model->getThreeJoinDatas(
            'admin_level.role, admin_menu.menu, admin_access_menu.id', // Select
            'admin_access_menu', // From
            'admin_menu', 'admin_menu.id = admin_access_menu.menu_id', // Join On
            'admin_level', 'admin_level.id = admin_access_menu.level_id', // Join On
            $where //Where
        );
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

    public function produk_get()
    {
        if (array_key_exists('id', $this->get())) {
            $where = [
                'produk.id' => $this->get('id')
            ];
        } else if (array_key_exists('id_kategori', $this->get())) {
            $where = ['produk.id_kategori' => $this->get('id_kategori')];
        } else {
            $where = NULL;
        }

        if (array_key_exists('limit', $this->get()) && array_key_exists('start', $this->get())) {
            $limit = $this->get('limit');
            $start = $this->get('start');
        } else {
            $limit = 9999;
            $start = 0;
        }

        $produk = $this->Api_model->getLeftThreeJoinDatas(
            'produk.*, kategori.nama AS kategori, produk_gambar.gambar', // Select
            'produk', // From
            'kategori', 'kategori.id = produk.id_kategori', // Join On
            'produk_gambar', '(produk_gambar.produk_id = produk.id) && (produk_gambar.thumbnail = 1)', // Join On Left
            $limit, $start, // Limit Offset
            $where // Where
        );

        if ($produk)
        {
            // Set the response and exit
            $this->response($produk, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
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

    public function jumlah_produk_get()
    {
        if (array_key_exists('id_kategori', $this->get())) {
            $where = ['id_kategori' => $this->get('id_kategori')];
        } else {
            $where = NULL;
        }
        $produk = $this->Api_model->getCountData('produk', $where);
        if ($produk)
        {
            // Set the response and exit
            $this->response($produk, 200);
        }
        else
        {
            $this->response( [
                'status' => false,
                'message' => 'Jumlah Produk tidak ditemukan'
            ], 404 );
        }
    }

    public function jumlah_booking_temp_get()
    {
        if (array_key_exists('id_kustomer', $this->get())) {
            if (array_key_exists('id_produk', $this->get())) {
                $where = [
                    'id_kustomer' => $this->get('id_kustomer'),
                    'id_produk' => $this->get('id_produk')
                ];
            } else {
                $where = [
                    'id_kustomer' => $this->get('id_kustomer')
                ];
            }
        } else if (array_key_exists('id_produk', $this->get())) {
            $where = [
                'id_produk' => $this->get('id_produk')
            ];
        } else {
            $where = NULL;
        }
        $booking = $this->Api_model->getCountData('booking_temp', $where);
        if ($booking)
        {
            // Set the response and exit
            $this->response($booking, 200);
        }
        else
        {
            $this->response( [
                'status' => false,
                'message' => 'Jumlah booking tidak ditemukan'
            ], 404 );
        }
    }

    public function kategori_get()
    {
        if (array_key_exists('id', $this->get())) {
            $where = ['id' => $this->get('id')];
        } else {
            $where = NULL;
        }
        $kategori = $this->Api_model->getDatas('kategori', $where);
        if ($kategori)
        {
            // Set the response and exit
            $this->response($kategori, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'kategori kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'kategori tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function booking_get()
    {
        if (array_key_exists('id', $this->get())) {
            $where = ['id' => $this->get('id')];
        } else {
            $where = NULL;
        }
        $booking = $this->Api_model->getDatas('booking', $where);
        // Check if the booking data store contains booking
        if ( $booking )
        {
            // Set the response and exit
            $this->response($booking, 200);
        }
        else
        {
            // Set the response and exit
            if ($where === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'Booking kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'Booking tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function galeri_get()
    {
        // galeri from a data store e.g. database
        $id = $this->get('id');
        $produk_id = $this->get('produk_id');
        $cek = is_null($id) ? $produk_id : $id;
        $where = is_null($id) ? 'produk_id' : 'id';
        $galeri = $this->Api_model->getDatas('produk_gambar', [$where => $cek], $cek);
        // Check if the galeri data store contains galeri
        if ( $galeri )
        {
            // Set the response and exit
            $this->response($galeri, 200);
        }
        else
        {
            // Set the response and exit
            if ($id === NULL) {
                $this->response( [
                    'status' => false,
                    'message' => 'galeri kosong'
                ], 404 );
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'galeri tidak ditemukan'
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

    public function kustomer_post()
    {
        $data = [
            'nm_lengkap' => $this->post('nm_lengkap'),
            'alamat' => $this->post('alamat'),
            'email' => $this->post('email'),
            'telepon' => $this->post('telepon'),
            'password' => $this->post('password'),
            'is_active' => $this->post('is_active'),
            'tgl_dibuat' => $this->post('tgl_dibuat'),
        ];

        if ($this->Api_model->insertData('kustomer', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }
    

    public function produk_post()
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
        
        if ($this->Api_model->insertData('produk', $data) > 0) {
            $this->response([
                'last_id' => $this->db->insert_id(),
                'message' => 'Data berhasil diinput',
                'status' => 200
            ], 200);
        } else {
            $this->response([
                'message' => 'Data gagal diinput',
                'status' => 400
            ], 400);
        }
    }

    public function kustomer_token_post()
    {
        $data = [
            'email' => $this->post('email'),
            'token' => $this->post('kustomer_token'),
            'tgl_dibuat' => time()
        ];
        
        if ($this->Api_model->insertData('kustomer_token', $data) > 0) {
            $this->response([
                'message' => 'Data berhasil diinput',
                'status' => 200
            ], 200);
        } else {
            $this->response([
                'message' => 'Data gagal diinput',
                'status' => 400
            ], 400);
        }
    }

    public function produk_put()
    {
        $data = [
            'id_kategori' => $this->put('id_kategori'),
            'tgl_input' => date("Y-m-d"),
            'nama' => $this->put('nama'),
            'deskripsi' => $this->put('deskripsi'),
            'harga' => $this->put('harga'),
            'stok' => $this->put('stok'),
            'diorder' => $this->put('diorder'),
            'diskon' => $this->put('diskon')
        ];

        
        $where = ['id' => $this->put('id')];
        
        if ($this->Api_model->updateData('produk', $data, $where) != -1 ) {
            $this->response([
                'message' => 'Data berhasil diubah'
            ], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function produk_delete()
    {
        $id = $this->delete('id');

        if ($id === NULL) {
            $this->response(['message' => 'Masukkan id!'], 400);
        } else {
            $delete = $this->Api_model->deleteData('produk', ['id' => $id]);
            if ($delete == -1) {
                $this->response([
                    'message' => 'Data gagal dihapus.',
                    'status' => 500,
                    $this->db->error()
                ], 500);
            }
            else if ($delete > 0) {
                $this->response([
                    'message' => 'Data berhasil dihapus',
                    'status' => 200
                ], 200);
            } else {
                $this->response([
                    'message' => 'Id tidak ditemukan',
                    'status' => 400
                ], 400);
            }
        }

    }

    public function produk_gambar_put()
    {
        $id_lama = $this->put('id');
        $id_baru = $this->put('id_baru');
        $data = [
            'id' => $id_lama
        ];
        
        $where = ['id' => $id_baru];

        if ($this->Api_model->updateData('produk_gambar', $data, $where) > 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function kustomer_put()
    {
        // jika client ingin update verifikasi aktif
        if (array_key_exists('is_active', $this->put()) && array_key_exists('email', $this->put())) {
            $data = ['is_active' => $this->put('is_active')];

            $where = ['email' => $this->put('email')];
        } else {
            $data = [
                'nm_lengkap' => $this->put('nm_lengkap'),
                'alamat' => $this->put('alamat'),
                'email' => $this->put('email'),
                'telepon' => $this->put('telepon'),
                'image' => $this->put('image')
            ];
            
            $where = ['id_kustomer' => $this->put('id_kustomer')];
        }
        
        if ($this->Api_model->updateData('kustomer', $data, $where) > 0 ) {
            $this->response([
                'message' => 'Data berhasil diubah'
            ], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function kustomer_foto_post()
    {
        $foto = $_FILES;
        $gambar_lama = $this->post('gambar_lama');

        if ($gambar_lama === NULL OR empty($foto)) {
            $this->response(['message' => 'Masukkan nama gambar lama atau isi gambar!'], 400);
        } else {
            $config = [
                'upload_path' => './assets/img/api/kustomer/',
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "4000",
                'encrypt_name' => TRUE
            ];
    
            $this->load->library('upload',$config);
            if($this->upload->do_upload('Contents-0'))
            {
                $image = $this->upload->data();
    
                if ($image['is_image'] === TRUE) {
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/img/api/kustomer/'.$image['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= TRUE;
                    $config['quality']= '70%';
                    $config['width']= 200;
                    $config['new_image']= './assets/img/api/kustomer/'.$image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }

                // Kalo gambarnya bukan default maka hapus
                if ($gambar_lama != 'default-photo.png') {
                    $filename = explode(".", $gambar_lama)[0];
                    array_map('unlink', glob(FCPATH."assets/img/api/kustomer/$filename.*"));
                }
    
                $this->response([
                    'status' => 200,
                    'message' => 'Gambar berhasil diubah',
                    'nama-baru' => $image['file_name']
                ], 200);
    
            } else {
                $error = [
                    'message' => $this->upload->display_errors('', '') . ' - (' . $foto['Contents-0']['name'] . ')',
                    'status' => 400
                ];
                $this->response($error, 400);
            }
        }
    }

    public function produk_gambar_post()
    {
        $galeries = $_FILES;
        $produk_id = $this->post('produk_id');
        $thumbnail = $this->post('thumbnail');
        // set cek ke 0 agar kalo file yang diupload besar akan Gagal
        $cek = 0;

        $config = [
            'upload_path' => './assets/img/api/produk/',
            'allowed_types' => "gif|jpg|png|jpeg|mp4|webm|ogg",
            'overwrite' => TRUE,
            'max_size' => "20000",
            'encrypt_name' => TRUE
        ];

        $this->load->library('upload',$config);
        $key = 0;
        foreach ($galeries as $galeri) {
            if($this->upload->do_upload('Contents-'.$key))
            {
                $image = $this->upload->data();

                if ($image['is_image'] === TRUE) {
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/img/api/produk/'.$image['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= TRUE;
                    $config['quality']= '70%';
                    $config['width']= 500;
                    $config['new_image']= './assets/img/api/produk/'.$image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }

                $data = [
                    'produk_id' => $produk_id,
                    'gambar' => $image['file_name'],
                    'thumbnail' => $thumbnail
                ];
                $cek = $this->Api_model->insertData('produk_gambar', $data);
                if (!$cek > 0) {
                    break;
                }

            } else {
                $error = [
                    'message' => $this->upload->display_errors('', '') . ' - (' . $galeri['name'] . ')',
                    'status' => 400
                ];
                $this->response($error, 400);
            }
            $key++;
        }
        if ($cek > 0) {
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

    public function booking_temp_post()
    {
        $data = [
            'id_kustomer' => $this->post('id_kustomer'),
            'id_produk' => $this->post('id_produk'),
            'jumlah' => $this->post('jumlah'),
            'tgl_booking' => date("Y-m-d"),
            'jam_booking' => date('H:i:s')
        ];

        if ($this->Api_model->insertData('booking_temp', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }

    public function booking_total_temp_post()
    {
        $data = [
            'id_kustomer' => $this->post('id_kustomer'),
            'total' => $this->post('total')
        ];

        if ($this->Api_model->insertData('booking_total_temp', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
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
            if ($this->Api_model->deleteData('admin_access_menu', ['id' => $id]) > 0) {
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
            if ($this->Api_model->deleteData('admin_menu', ['id' => $id]) > 0) {
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

    public function booking_total_temp_put()
    {
        $data = [
            'total' => $this->put('total')
        ];
        $where = ['id_kustomer' => $this->put('id_kustomer')];

        if ($this->Api_model->updateData('booking_total_temp', $data, $where) > 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function booking_temp_batch_put()
    {
        $data = $this->put();

        $where = 'id';

        if ($this->Api_model->updateDataBatch('booking_temp', $data, $where) > 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function galeri_delete()
    {
        $id = $this->delete('id');
        $galeri = $this->Api_model->getDatas('produk_gambar', ['id' => $id], $id)[0];
        if ($id === NULL) {
            $this->response(['message' => 'Masukkan id!'], 400);
        } else {
            if ($this->Api_model->deleteData('produk_gambar', ['id' => $id]) > 0) {
                $filename = explode(".", $galeri['gambar'])[0];
                array_map('unlink', glob(FCPATH."assets/img/api/produk/$filename.*"));
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'Id tidak ditemukan'], 400);
            }
        }

    }

    public function sub_menu_post()
    {
        $data = [
            'menu_id' => $this->post('menu_id'),
            'title' => $this->post('title'),
            'url' => $this->post('url'),
            'icon' => $this->post('icon'),
            'is_active' => $this->post('is_active')
        ];

        if ($this->Api_model->insertData('admin_sub_menu', $data) > 0) {
            $this->response(['message' => 'Data berhasil diinput'], 200);
        } else {
            $this->response(['message' => 'Data gagal diinput'], 400);
        }
    }

    public function sub_menu_put()
    {
        $data = [
            'menu_id' => $this->put('menu_id'),
            'title' => $this->put('title'),
            'url' => $this->put('url'),
            'icon' => $this->put('icon'),
            'is_active' => $this->put('is_active')
        ];
        $where = ['id' => $this->put('id')];

        if ($this->Api_model->updateData('admin_sub_menu', $data, $where) <> 0) {
            $this->response(['message' => 'Data berhasil diubah'], 200);
        } else {
            $this->response(['message' => 'Data gagal diubah'], 400);
        }
    }

    public function sub_menu_delete()
    {
        $id = $this->delete('id');

        if ($id === NULL) {
            $this->response(['message' => 'Masukkan id!'], 400);
        } else {
            if ($this->Api_model->deleteData('admin_sub_menu', ['id' => $id]) > 0) {
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'Id tidak ditemukan'], 400);
            }
        }
    }

    public function kustomer_token_delete()
    {
        $email = $this->delete('email');

        if ($email === NULL) {
            $this->response(['message' => 'Masukkan email!'], 400);
        } else {
            if ($this->Api_model->deleteData('kustomer_token', ['email' => $email]) > 0) {
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'email tidak ditemukan'], 400);
            }
        }
    }

    public function kustomer_delete()
    {
        if (array_key_exists('email', $this->delete())) {
            $where = ['email' => $this->delete('email')];
        } else {
            $where = NULL;
        }

        if ($where === NULL) {
            $this->response(['message' => 'Masukkan parameter!'], 400);
        } else {
            if ($this->Api_model->deleteData('kustomer', $where) > 0) {
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'Data tidak ditemukan'], 400);
            }
        }
    }

    public function booking_temp_delete()
    {
        if (array_key_exists('id', $this->delete())) {
            $where = ['id' => $this->delete('id')];
        } else {
            $where = NULL;
        }

        if ($where === NULL) {
            $this->response(['message' => 'Masukkan parameter!'], 400);
        } else {
            if ($this->Api_model->deleteData('booking_temp', $where) > 0) {
                $this->response(['message' => 'Data berhasil dihapus'], 200);
            } else {
                $this->response(['message' => 'Data tidak ditemukan'], 400);
            }
        }
    }
}
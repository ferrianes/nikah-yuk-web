<?php
defined('BASEPATH') or exit('No direct script allowed');

class Menu_model extends CI_Model {

    public function getMenus($id = NULL)
    {
        if ($id === NULL) {
            return $this->db->get('admin_menu')->result_array();
        } else {
            return $this->db->get_where('admin_menu', ['id' => $id])->result_array();
        }
    }
}
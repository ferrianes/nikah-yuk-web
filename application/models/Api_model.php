<?php
defined('BASEPATH') or exit('No direct script allowed');

class Api_model extends CI_Model {

    public function getDatas($table, $where, $id = NULL)
    {
        if ($id === NULL) {
            return $this->db->get($table)->result_array();
        } else {
            return $this->db->get_where($table, [$where => $id])->row_array();
        }
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function deleteData($table, $id)
    {
        $this->db->delete($table, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
}
<?php
defined('BASEPATH') or exit('No direct script allowed');

class Api_model extends CI_Model {

    public function getDatas($table, $where, $id = NULL)
    {
        if ($id === NULL) {
            return $this->db->get($table)->result_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
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

    public function getJoinDatas($select, $from, $join, $on, $where=NULL, $id=NULL, $order=NULL, $by=NULL)
    {
        if ($id === NULL) {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->order_by($order, $by);
            return $this->db->get()->result_array();
        } else {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->where($where);
            $this->db->order_by($order, $by);
            return $this->db->get()->result_array();
        }
    }

    public function getThreeJoinDatas($select, $from, $join, $on, $join2, $on2, $where, $id=NULL)
    {
        if ($id === NULL) {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2);
            return $this->db->get()->result_array();
        } else {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2);
            $this->db->where($where);
            return $this->db->get()->result_array();
        }
    }
}
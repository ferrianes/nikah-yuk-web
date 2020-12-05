<?php
defined('BASEPATH') or exit('No direct script allowed');

class Api_model extends CI_Model {

    public function getDatas($table, $where, $limit = 10, $start = 0)
    {
        if (is_array($where)) {
            return $this->db->get_where($table, $where, $limit, $start)->result_array();
        } else {
            return $this->db->get($table, $limit, $start)->result_array();
        }
    }

    public function getCountData($table, $where = NULL)
    {
        if (is_array($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($table);
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function deleteData($table, $id)
    {
        $this->db->db_debug = false;
        $this->db->delete($table, $id);
        return $this->db->affected_rows();
    }

    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function updateDataBatch($table, $data, $where)
    {
        return $this->db->update_batch($table, $data, $where);
    }

    public function getJoinDatas($select, $from, $join, $on, $limit = 10, $offset = 0, $where=NULL, $order=NULL, $by=NULL)
    {
        if ($where === NULL) {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->order_by($order, $by);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        } else {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->where($where);
            $this->db->order_by($order, $by);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        }
    }

    public function getThreeJoinDatas($select, $from, $join, $on, $join2, $on2, $where = NULL, $limit = 10, $offset = 0)
    {
        if ($where === NULL) {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        } else {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2);
            $this->db->where($where);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        }
    }

    public function getLeftThreeJoinDatas($select, $from, $join, $on, $join2, $on2, $limit = 10, $offset = 0, $where = NULL)
    {
        if ($where === NULL) {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2, 'left');
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        } else {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2, 'left');
            $this->db->where($where);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        }
    }

    public function getLeftFiveJoinDatas($select, $from, $join, $on, $join2, $on2, $join3, $on3, $join4, $on4, $where = NULL, $limit = 10, $offset = 0, $order=NULL, $by=NULL)
    {
        if ($where === NULL) {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2);
            $this->db->join($join3, $on3);
            $this->db->join($join4, $on4);
            $this->db->order_by($order, $by);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        } else {
            $this->db->select($select);
            $this->db->from($from);
            $this->db->join($join, $on);
            $this->db->join($join2, $on2);
            $this->db->join($join3, $on3);
            $this->db->join($join4, $on4);
            $this->db->where($where);
            $this->db->order_by($order, $by);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        }
    }
}
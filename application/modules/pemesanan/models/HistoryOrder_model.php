<?php
class HistoryOrder_model extends CI_Model
{
    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function find($table, $field, $data)
    {
        $this->db->where($field, $data);
        return $this->db->get($table)->row_array();
    }
}
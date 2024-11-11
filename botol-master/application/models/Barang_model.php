<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    public function get_all_barang()
    {
        $query = $this->db->get('databarang');
        return $query->result_array();
    }

    public function get_barang_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('databarang');
        return $query->row_array();
    }

    public function add_barang($data)
    {
        if ($this->db->insert('databarang', $data)) {
            return true;
        } else {
            log_message('error', 'Barang insert error: ' . $this->db->last_query());
            return false;
        }
    }

    public function update_barang($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('databarang', $data);
    }

    public function delete_barang($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('databarang');
    }
}

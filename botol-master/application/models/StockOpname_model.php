<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StockOpname_model extends CI_Model
{
    // Mengambil semua data asset
    public function get_all_assets()
    {
        $query = $this->db->get('assets');
        return $query->result_array();
    }

    // Menambahkan data stock opname
    public function add_stock_opname($data)
    {
        return $this->db->insert('stock_opname', $data);
    }
    // StockOpname_model.php
public function get_all_assets_with_condition()
{
    // Ambil data asset dengan kondisi OK dan Rusak
    $this->db->select('id, nama_asset, merk_kode, qty, ok, rusak');
    return $this->db->get('assets')->result_array();
}

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengajuanBarang_model extends CI_Model
{
    public function get_all_requests()
    {
        $this->db->select('*'); // Ambil semua kolom
        $query = $this->db->get('pengajuan_barang');
        return $query->result_array(); // Kembalikan sebagai array
    }

    public function get_request_by_id($id)
    {
        return $this->db->get_where('pengajuan_barang', ['id' => $id])->row_array();
    }

    public function add_request($data)
    {
        return $this->db->insert('pengajuan_barang', $data);
    }

    public function update_request($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pengajuan_barang', $data);
    }
    

    public function delete_request($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pengajuan_barang');
    }

    public function approve_request($id, $approved_qty)
    {
        // Update status approved dan approved_qty
        $data = [
            'approved' => 1, // Set approved menjadi 1
            'approved_qty' => $approved_qty // Set approved_qty sesuai input
        ];

        // Lakukan update ke tabel pengajuan_barang
        $this->db->where('id', $id);
        return $this->db->update('pengajuan_barang', $data);
    }
    // Di model PengajuanBarang_model

    public function count_all() {
        return $this->db->count_all('pengajuan_barang');
    }
    
    public function get_requests($currentIndex = 0, $perPage = 10)
    {
        $this->db->limit($perPage, $currentIndex);
        return $this->db->get('pengajuan_barang')->result_array(); // Ganti 'pengajuan_barang' dengan nama tabel yang sesuai
    }

    // Metode untuk menghitung total item
    public function get_total_items()
    {
        return $this->db->count_all('pengajuan_barang'); // Ganti 'pengajuan_barang' dengan nama tabel yang sesuai
    }
    public function add_item($data) {
        // Menyimpan detail item pengajuan barang ke dalam tabel yang sesuai
        return $this->db->insert('detail_pengajuan_barang', $data); // Gantilah dengan nama tabel yang sesuai
    }
    

}

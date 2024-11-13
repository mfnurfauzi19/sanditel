<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcode_model extends CI_Model
{
    public function get_asset_by_barcode($barcode)
    {
        // Mengambil data aset berdasarkan barcode
        $this->db->where('barcode', $barcode);
        $query = $this->db->get('assets');
        return $query->row_array();
    }

    public function update_status_by_barcode($barcode, $new_status, $updated_at)
{
    // Memperbarui status aset berdasarkan barcode dan timestamp updated_at
    $this->db->set('status', $new_status);
    $this->db->set('updated_at', $updated_at); // Mengupdate timestamp
    $this->db->where('barcode', $barcode);
    return $this->db->update('assets'); // Mengupdate data di tabel assets
}

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asset_model extends CI_Model
{
    // Fungsi untuk menambahkan aset ke dalam tabel
    public function add_asset($data)
    {
        if ($this->db->insert('assets', $data)) {
            return true; // Berhasil
        } else {
            log_message('error', 'Gagal menambahkan asset: ' . $this->db->last_query());
            return false; // Gagal
        }
    }

    // Fungsi untuk mengambil semua data aset
    public function get_all_assets()
    {
        return $this->db->get('assets')->result_array(); // Mengambil semua data dari tabel
    }

    // Fungsi untuk mengambil aset berdasarkan merk kode
    public function get_asset_by_merk_kode($merk_kode)
    {
        $merk_kode = trim($merk_kode);  // Trim di PHP, pastikan input bersih
        $this->db->where('merk_kode', $merk_kode); // Menghindari penggunaan TRIM di SQL
        $query = $this->db->get('assets');
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        
        return null;
    }

    // Fungsi untuk mengambil aset berdasarkan ID
    public function get_asset_by_id($id)
    {
        return $this->db->get_where('assets', ['id' => $id])->row_array();
    }

    // Fungsi untuk memperbarui aset
    public function update_asset($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('assets', $data)) {
            return $this->db->affected_rows() > 0; // Pastikan ada perubahan data
        } else {
            log_message('error', 'Gagal memperbarui asset: ' . $this->db->last_query());
            return false; // Gagal
        }
    }

    // Fungsi untuk memperbarui barcode pada aset
    public function update_barcode($id, $barcode_text)
    {
        $data = array(
            'barcode' => $barcode_text
        );
        return $this->db->update('assets', $data, array('id' => $id));
    }

    // Fungsi untuk memperbarui status barcode sudah digenerate
    public function update_barcode_status($id, $status)
    {
        $this->db->update('assets', ['barcode_generated' => $status], ['id' => $id]);
    }

    // Fungsi untuk menghapus aset
    public function delete_asset($id)
    {
        if ($this->db->delete('assets', ['id' => $id])) {
            return true; // Berhasil
        } else {
            log_message('error', 'Gagal menghapus asset: ' . $this->db->last_query());
            return false; // Gagal
        }
    }

    // Fungsi untuk mengurangi stok sementara
    public function reduce_stock($id, $amount)
    {
        // Pastikan stok yang akan dikurangi lebih besar dari 0
        $this->db->where('id', $id);
        $this->db->where('ok >=', $amount); // Cek apakah stok cukup
        $this->db->set('ok', 'ok - ' . (int)$amount, false); // Mengurangi stok
        
        if ($this->db->update('assets')) {
            return true; // Berhasil mengurangi stok
        } else {
            log_message('error', 'Gagal mengurangi stok asset: ' . $this->db->last_query());
            return false; // Gagal mengurangi stok
        }
    }

    // Fungsi untuk menambahkan atau memperbarui asset berdasarkan ID
    public function update_asset_id($old_id, $new_id)
    {
        // Mengubah ID asset
        $this->db->set('id', $new_id);
        $this->db->where('id', $old_id);
        return $this->db->update('assets'); // Menyesuaikan nama tabel jika diperlukan
    }
}

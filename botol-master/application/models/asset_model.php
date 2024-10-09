<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asset_model extends CI_Model
{
    // Fungsi untuk menambahkan aset ke dalam tabel
    public function add_asset($data)
    {
        return $this->db->insert('assets', $data); // 'assets' adalah nama tabel di database
    }

    // Fungsi untuk mengambil data aset (jika diperlukan di masa depan)
    public function get_assets()
    {
        return $this->db->get('assets')->result_array();
    }
}

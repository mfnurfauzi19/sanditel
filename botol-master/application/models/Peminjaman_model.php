<?php defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {
    
    // Mengambil data peminjaman beserta detail asset dan pengguna
    public function get_peminjaman_with_assets() {
        $this->db->select('peminjaman.*, assets.nama_asset, assets.ok');
        
        // Menghitung sisa stok dengan memperhitungkan peminjaman yang sedang berlangsung
        $this->db->select('(assets.ok - IFNULL((SELECT SUM(p2.jumlah_pinjam) 
                            FROM peminjaman p2 
                            WHERE p2.assets_id = peminjaman.assets_id 
                            AND p2.status_pengembalian = 0), 0)) AS sisa_stok');
        
        $this->db->from('peminjaman');
        $this->db->join('assets', 'peminjaman.assets_id = assets.id');
        
        return $this->db->get()->result_array();
    }
    
    
    // Mengecek ketersediaan stok dengan memperhitungkan peminjaman yang belum dikembalikan
    public function is_qty_available($assets_id, $qty_pinjam) {
        $this->db->select('ok - IFNULL((SELECT SUM(jumlah_pinjam) 
                        FROM peminjaman 
                        WHERE assets_id = assets.id 
                        AND status_pengembalian = 0), 0) AS sisa_ok');
        $this->db->from('assets');
        $this->db->where('id', $assets_id);
        
        $result = $this->db->get()->row_array();
        
        return ($qty_pinjam <= $result['sisa_ok']);
    }

    // Mengambil semua barang dari tabel assets
    public function get_all_barang() {
        return $this->db->get('assets')->result_array();
    }

    // Menambahkan peminjaman baru ke tabel peminjaman
    public function add_peminjaman($data) {
        if ($this->db->insert('peminjaman', $data)) {
            // Pengurangan stok bisa dilakukan di controller setelah pengecekan stok
            return true;
        }
        log_message('error', 'Gagal menambahkan peminjaman: ' . $this->db->last_query());
        return false;
    }

    // Memperbarui peminjaman berdasarkan ID
    public function update_peminjaman($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('peminjaman', $data);
    }

    // Mengambil data peminjaman berdasarkan ID
    public function get_peminjaman_by_id($id) {
        return $this->db->get_where('peminjaman', ['id' => $id])->row_array();
    }

    // Menghapus peminjaman berdasarkan ID
    public function delete_peminjaman($id) {
        // Ambil data peminjaman berdasarkan ID
        $peminjaman = $this->get_peminjaman_by_id($id);
    
        // Pastikan data peminjaman ditemukan dan hapus data tersebut
        if ($peminjaman && $this->db->delete('peminjaman', ['id' => $id])) {
            // Tidak ada update stok yang dilakukan, hanya menghapus data peminjaman
            return true;
        }
    
        return false; // Jika peminjaman tidak ditemukan atau gagal menghapus
    }
    
    // Memperbarui stok berdasarkan jumlah peminjaman
    // private function update_stock($assets_id, $qty) {
    //     $this->db->set('qty', 'qty + ' . (int)$qty, FALSE);
    //     $this->db->where('id', $assets_id);
    //     $this->db->update('assets');
    // }

    public function get_all_peminjaman() {
        // Mengambil semua data peminjaman dan menghitung sisa stok
        $this->db->select('
            peminjaman.id,
            peminjaman.jumlah_pinjam,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            peminjaman.peminjam,
            peminjaman.departemen,
            assets.nama_asset,
            assets.ok - IFNULL(
                (SELECT SUM(jumlah_pinjam) FROM peminjaman WHERE assets_id = assets.id),
                0
            ) AS sisa_stok
        ');
        $this->db->from('peminjaman');
        $this->db->join('assets', 'peminjaman.assets_id = assets.id', 'left');
        return $this->db->get()->result_array();
    }
    
    
    
    public function get_all_barang_with_sisa_stok() {
        $this->db->select('assets.id, assets.nama_asset, assets.ok, (assets.ok - IFNULL(SUM(peminjaman.jumlah_pinjam), 0)) AS sisa_stok');
        $this->db->from('assets');
        $this->db->join('peminjaman', 'peminjaman.assets_id = assets.id AND peminjaman.status_pengembalian = 0', 'left');
        $this->db->group_by('assets.id');
        return $this->db->get()->result_array();
    }
    
    
}

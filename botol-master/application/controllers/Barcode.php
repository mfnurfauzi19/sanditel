<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model atau library jika diperlukan
    }

    public function scan()
    {
        // Siapkan data untuk tampilan
        $data['title'] = 'Scan Barcode'; // Tambahkan judul
        $data['contents'] = 'Silakan pindai barcode Anda di bawah ini.'; // Tambahkan konten
        $data['content_view'] = 'barcode/scan'; // Tambahkan tampilan konten yang ingin ditampilkan
    
        // Muat tampilan pemindaian barcode
        $this->load->view('templates/dashboard', $data); // Muat dashboard dengan data
    }
    

    public function process()
    {
        // Proses data barcode yang diterima dari AJAX
        $barcode = $this->input->post('barcode');

        // Contoh logika untuk memproses barcode
        if ($barcode) {
            // Lakukan sesuatu dengan data barcode, seperti menyimpannya di database
            $response = [
                'status' => 'success',
                'message' => 'Barcode berhasil diproses.',
                'barcode' => $barcode
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal memproses barcode.'
            ];
        }

        // Mengembalikan respon JSON
        echo json_encode($response);
    }
}

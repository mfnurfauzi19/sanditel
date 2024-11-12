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
        // Ambil barcode dari POST data dan hilangkan spasi ekstra
        $barcode = trim($this->input->post('barcode'));
    
        // Pastikan barcode tidak kosong
        if (empty($barcode)) {
            $response = [
                'status' => 'error',
                'message' => 'Barcode tidak boleh kosong.'
            ];
            echo json_encode($response);
            return;
        }
    
        // Cari data aset berdasarkan barcode
        $this->db->where('barcode', $barcode);
        $asset = $this->db->get('assets')->row_array();
    
        // Jika data aset ditemukan
        if ($asset) {
            $response = [
                'status' => 'success',
                'message' => 'Data ditemukan.',
                'asset' => [
                    'nama_asset' => $asset['nama_asset'],
                    'merk_kode' => $asset['merk_kode'],
                    'status' => $asset['status'],
                    'qty' => $asset['qty'],
                    'barcode' => $asset['barcode']
                ]
            ];
        } else {
            // Jika data tidak ditemukan
            $response = [
                'status' => 'error',
                'message' => 'Aset tidak ditemukan.'
            ];
        }
    
        // Kirimkan respons dalam format JSON
        echo json_encode($response);
    }
    
    }
    

        


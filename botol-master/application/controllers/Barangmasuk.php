<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Barang Masuk";
        $data['barangmasuk'] = $this->admin->getBarangMasuk();
        $this->template->load('templates/dashboard', 'barang_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
    
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Masuk";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');
    
            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_masuk', 'id_barang_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_masuk'] = $kode . $number;
    
            $this->template->load('templates/dashboard', 'barang_masuk/add', $data);
        } else {
            $input = $this->input->post(null, true);
    
            // Proses upload file
            $config['upload_path'] = './uploads/barang_masuk/'; // Direktori tempat file disimpan
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|docx'; // Jenis file yang diizinkan
            $config['max_size'] = 2048; // Ukuran maksimal file dalam KB (misal 2MB)
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('file_upload')) {
                // Jika upload berhasil
                $fileData = $this->upload->data();
                $file_name = $fileData['file_name']; // Mendapatkan nama file yang di-upload
                $input['bukti_pengajuan'] = $file_name; // Simpan nama file di database
    
                // Insert data ke database
                $insert = $this->admin->insert('barang_masuk', $input);
    
                if ($insert) {
                    set_pesan('Data berhasil disimpan.');
                    redirect('barangmasuk');
                } else {
                    set_pesan('Opps ada kesalahan!');
                    redirect('barangmasuk/add');
                }
            } else {
                // Jika upload gagal
                $error = $this->upload->display_errors();
                set_pesan($error, false);
                redirect('barangmasuk/add');
            }
        }
    }
    


    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_masuk', 'id_barang_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangmasuk');
    }
}

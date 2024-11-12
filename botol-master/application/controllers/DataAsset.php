<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataAsset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Asset_model');
        $this->load->library('form_validation');
        $this->load->library('BarcodeGeneratorHTML');
        if (!$this->session->userdata('login_session')) {
            // Jika belum login, redirect ke halaman login
            redirect('auth');
        }
    }

    public function data()
{
    // Ambil semua data aset
    $data['dataasset'] = $this->Asset_model->get_all_assets();
    $data['title'] = "Data Asset";

    // Cek peminjaman yang akan habis dalam 2 hari ke depan
    $this->db->where('status_pengembalian', 0);  // Belum dikembalikan
    $this->db->where('tanggal_kembali <=', date('Y-m-d', strtotime('+5 days')));  // Tanggal pengembalian dalam 2 hari
    $this->db->where('tanggal_kembali >', date('Y-m-d'));  // Jangan cek untuk barang yang sudah lewat
    $query = $this->db->get('peminjaman');

    // Jika ada peminjaman yang hampir habis, kirimkan data ke view
    $data['peringatan'] = $query->num_rows() > 0 ? true : false;

    // Muat halaman data asset
    $data['contents'] = $this->load->view('data_asset/data', $data, true);
    $this->load->view('templates/dashboard', $data);
}

    
    public function add()
    {
        $data['title'] = "Tambah Asset";
        $this->set_validation_rules();
        
        if ($this->form_validation->run() == false) {
            $data['contents'] = $this->load->view('data_asset/add', $data, true);
            $this->load->view('templates/dashboard', $data);
        } else {
            $this->process_asset();
        }
    }
public function edit($id)
{
    // Mengecek akses user
    $this->check_access('admin');
    
    // Mengambil data asset berdasarkan ID
    $data['asset'] = $this->Asset_model->get_asset_by_id($id);
    
    // Jika asset tidak ditemukan, tampilkan 404
    if (!$data['asset']) {
        show_404();
    }

    // Menyiapkan data untuk tampilan
    $data['title'] = 'Edit Asset';
    $data['contents'] = $this->load->view('data_asset/edit', $data, true);

    // Menampilkan halaman dengan template dashboard
    $this->load->view('templates/dashboard', $data);
}


public function update($id)
{
    $this->form_validation->set_rules('nama_asset', 'Nama Asset', 'required');
    $this->form_validation->set_rules('merk_kode', 'Merk/Type', 'required');
    $this->form_validation->set_rules('kategori', 'Kategori', 'required');
    $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
    $this->form_validation->set_rules('status', 'Status', 'required|integer');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('pesan', validation_errors());
        redirect('data_asset/edit/' . $id);
    } else {
        $data = array(
            'nama_asset' => $this->input->post('nama_asset'),
            'merk_kode' => $this->input->post('merk_kode'),
            'kategori' => $this->input->post('kategori'),
            'qty' => $this->input->post('qty'),
            'status' => $this->input->post('status'), // Status yang digunakan sekarang
        );

        if ($this->Asset_model->update_asset($id, $data)) {
            $this->session->set_flashdata('pesan', 'Asset berhasil diperbarui');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal memperbarui asset');
        }
        redirect('data_asset');
    }
}


    
        public function delete($id)
        {
            // Panggil model untuk menghapus data asset berdasarkan ID
            if ($this->Asset_model->delete_asset($id)) {
                // Jika berhasil, beri notifikasi dan redirect
                $this->session->set_flashdata('message', 'Data asset berhasil dihapus');
            } else {
                // Jika gagal, beri notifikasi
                $this->session->set_flashdata('message', 'Gagal menghapus data asset');
            }
            
            // Redirect kembali ke halaman utama
            redirect('data_asset');
        }


    
    private function renumber_ids()
    {
        $assets = $this->Asset_model->get_all_assets();
        
        foreach ($assets as $index => $asset) {
            $new_id = $index + 1;
            if ($asset['id'] != $new_id) {
                $this->Asset_model->update_asset_id($asset['id'], $new_id);
            }
        }
    }

    private function set_validation_rules()
    {
        $this->form_validation->set_rules('nama_asset', 'Nama Asset', 'required');
        $this->form_validation->set_rules('merk_kode', 'Merk/Type', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
        $this->form_validation->set_rules('status', 'Status', 'required|integer');
    }

    private function process_asset($id = null)
    {
        $qty = $this->input->post('qty');
        $status = $this->input->post('status');

        // Validasi status (sekarang hanya status, tidak ada ok dan rusak)
        if (!$this->validate_asset($qty, $status)) {
            $redirect_url = $id ? 'data_asset/edit/' . $id : 'data_asset/add';
            redirect($redirect_url);
        } else {
            // Menyiapkan data aset
            $asset_data = [
                'nama_asset' => $this->input->post('nama_asset'),
                'merk_kode' => $this->input->post('merk_kode'),
                'kategori' => $this->input->post('kategori'),
                'qty' => $qty,
                'status' => $status,
            ];

            // Menyimpan atau mengupdate asset berdasarkan ID
            if ($id) {
                $update = $this->Asset_model->update_asset($id, $asset_data);
                $message = $update ? 'Asset berhasil diupdate.' : 'Gagal mengupdate asset. Silakan coba lagi.';
            } else {
                $insert = $this->Asset_model->add_asset($asset_data);
                $message = $insert ? 'Asset berhasil ditambahkan.' : 'Gagal menambahkan asset. Silakan coba lagi.';
            }

            // Menampilkan pesan ke sesi
            $this->session->set_flashdata('message', $message);
            redirect('data_asset');
        }
    }

    // Validasi input, sekarang hanya status yang diperiksa
    private function validate_asset($qty, $status)
    {
        // Validasi status jika diperlukan
        if (empty($status)) {
            $this->session->set_flashdata('message', 'Status aset tidak boleh kosong.');
            return false;
        }

        return true;
    }

    private function check_access($role)
    {
        if (!$this->session->userdata('login_session')) {
            redirect('login');
        }

        if ($this->session->userdata('login_session')['role'] !== $role) {
            $this->session->set_flashdata('pesan', 'Anda tidak memiliki akses untuk tindakan ini.');
            redirect('data_asset');
        }
    }


    public function get_asset_info() {
        $assetId = $this->input->get('assetId');  // Ambil assetId dari parameter GET
        log_message('debug', 'Asset ID: ' . $assetId);  // Debugging log

        // Periksa apakah assetId diterima
        if (!$assetId) {
            echo json_encode(['error' => 'Asset ID is missing']);
            return;
        }

        // Ambil data asset dari database berdasarkan assetId
        $asset = $this->db->get_where('assets', ['id' => $assetId])->row_array();

        // Debugging: Cek apakah data asset ditemukan
        log_message('debug', 'Asset: ' . print_r($asset, true));

        if ($asset) {
            echo json_encode(['merk_kode' => $asset['merk_kode']]);  // Kirim merk_kode ke client
        } else {
            echo json_encode(['error' => 'Asset not found']);
        }
    }

    public function save_barcode() {
        $assetId = $this->input->post('assetId');
        $barcode = $this->input->post('barcode');
        
        // Validasi input
        if ($assetId && $barcode) {
            // Update barcode di tabel assets
            $this->db->where('id', $assetId);
            $this->db->update('assets', ['barcode' => $barcode]);
    
            // Kembalikan response dengan token CSRF yang baru
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'success',
                'csrfHash' => $this->security->get_csrf_hash()
            ]));
        } else {
            // Kembalikan error jika data tidak lengkap
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Data tidak valid!'
            ]));
        }
    }

    public function index_kategori() {
        $data['title'] = ' Kategori Barang';  // Menambahkan title
        // Mengambil daftar kategori dari model Asset_model
        $data['kategori'] = $this->Asset_model->get_categories();
        
        // Menambahkan jumlah barang per kategori
        foreach ($data['kategori'] as &$kat) {
            // Mengambil jumlah barang berdasarkan kategori menggunakan fungsi dari model
            $kat['jumlah_barang'] = $this->Asset_model->get_count_by_category($kat['kategori']);
        }
    
        // Memuat konten kategori dan mengirim data kategori ke view
        $data['contents'] = $this->load->view('data_asset/kategori', $data, true);
    
        // Memuat tampilan utama (dashboard) dengan data kategori
        $this->load->view('templates/dashboard', $data);
    }
    
    
    
    public function detail($kategori) {
        $data['title'] = ' Detail Kategori Barang';  // Menambahkan title
        // Mendekodekan nama kategori
        $kategori = urldecode($kategori);
        
        // Mengambil daftar aset berdasarkan kategori
        $this->load->model('Asset_model');
        
        // Menangani pencarian jika ada input
        $search = $this->input->get('search');
        if ($search) {
            $data['assets'] = $this->Asset_model->get_assets_by_category_and_search($kategori, $search);
        } else {
            $data['assets'] = $this->Asset_model->get_assets_by_category($kategori);
        }
    
        // Menyimpan data kategori dan jumlah aset
        $data['kategori'] = $kategori;
        $data['jumlah_field'] = count($data['assets']);
        $data['contents'] = $this->load->view('data_asset/detail_kategori', $data, true);

    
        // Menampilkan view detail kategori
        $this->load->view('templates/dashboard', $data);

    }

    public function submit_form() {
        $kategori = $this->input->post('kategori');
        
        // Menangani data item berdasarkan kategori
        $itemData = [];
        $i = 1;
        while ($this->input->post('item' . $i)) {
            $itemData[] = $this->input->post('item' . $i);
            $i++;
        }
    
        // Proses data yang sudah diterima (misalnya simpan ke database)
        foreach ($itemData as $item) {
            // Simpan setiap item ke database, tergantung pada kebutuhan Anda
        }
    
        // Redirect atau tampilkan pesan sukses
        $this->session->set_flashdata('pesan', 'Data berhasil disubmit.');
        redirect('dataasset');
    }
    public function tambah_by_kategori() {
        // Ambil data kategori dari database atau model
        $data['kategori'] = $this->Dataasset_model->get_categories_with_count();  // Pastikan ada method get_kategori() di model Anda
        
        // Kirim data ke view
        $this->load->view('data_asset/kategori', $data);
    }
    
    
    
    
    

}

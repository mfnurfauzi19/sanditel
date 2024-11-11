<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Peminjaman_model');
        $this->load->model('Asset_model');
        $this->load->library('form_validation');
        if (!$this->session->userdata('login_session')) {
            // Jika belum login, redirect ke halaman login
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = "Daftar Peminjaman Asset";
        $data['peminjaman'] = $this->Peminjaman_model->get_all_peminjaman(); // Memanggil semua data peminjaman dari model
    
        // Debug log untuk memeriksa data peminjaman yang dimuat
        log_message('debug', 'Data Peminjaman di Controller (index): ' . print_r($data['peminjaman'], true));
    
        // Memuat tampilan daftar peminjaman
        $data['contents'] = $this->load->view('peminjaman/index', $data, true);
        $this->load->view('templates/dashboard', $data);
    }
    
    
    
    
    
    public function create() {
        $data['title'] = "Tambah Peminjaman Asset";
        $data['barang'] = $this->Peminjaman_model->get_all_barang_with_sisa_stok();

        if ($this->input->post()) {
            $this->set_validation_rules();
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Validasi gagal. Silakan coba lagi.');
            } else {
                $this->process_peminjaman();
            }
        }

        $data['contents'] = $this->load->view('peminjaman/create', $data, true);
        $this->load->view('templates/dashboard', $data);
    }

    private function process_peminjaman() {
        $data = [
            'assets_id' => $this->input->post('barang_id'),
            'peminjam' => $this->input->post('peminjam'),
            'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
            'tanggal_kembali' => $this->input->post('tanggal_kembali'),
            'jumlah_pinjam' => $this->input->post('jumlah_pinjam'),
            'departemen' => $this->input->post('departemen'),
            'status_pengembalian' => 0
        ];

        if (!$this->Peminjaman_model->is_qty_available($data['assets_id'], $data['jumlah_pinjam'])) {
            $this->session->set_flashdata('message', 'Jumlah yang ingin dipinjam melebihi stok yang tersedia.');
            redirect('peminjaman/create');
            return;
        }

        if ($this->Peminjaman_model->add_peminjaman($data)) {
            // $this->Asset_model->update_stock($data['assets_id'], -$data['jumlah_pinjam']);
            $this->session->set_flashdata('message', 'Peminjaman berhasil ditambahkan.');
            redirect('peminjaman');
        } else {
            $this->session->set_flashdata('message', 'Gagal menambahkan peminjaman.');
            redirect('peminjaman/create');
        }
    }

    private function set_validation_rules() {
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required');
        $this->form_validation->set_rules('jumlah_pinjam', 'Jumlah Pinjam', 'required|integer|greater_than[0]');
    }

    public function edit($id) {
        $data['title'] = "Edit Peminjaman";
        $data['peminjaman'] = $this->Peminjaman_model->get_peminjaman_by_id($id);
        $data['barang'] = $this->Peminjaman_model->get_all_barang_with_sisa_stok();

        if (empty($data['peminjaman'])) {
            show_404();
        }

        $this->set_validation_rules();

        if ($this->form_validation->run() == false) {
            $data['contents'] = $this->load->view('peminjaman/edit', $data, true);
            $this->load->view('templates/dashboard', $data);
        } else {
            $this->update_peminjaman($id);
        }
    }

    private function update_peminjaman($id) {
        $peminjaman_data = [
            'assets_id' => $this->input->post('barang_id'),
            'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
            'tanggal_kembali' => $this->input->post('tanggal_kembali'),
            'jumlah_pinjam' => $this->input->post('jumlah_pinjam'),
        ];

        if ($this->Peminjaman_model->update_peminjaman($id, $peminjaman_data)) {
            $this->session->set_flashdata('message', 'Peminjaman berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui peminjaman. Silakan coba lagi.');
        }
        redirect('peminjaman');
    }

    public function delete($id) {
        $peminjaman = $this->Peminjaman_model->get_peminjaman_by_id($id);
    
        if ($peminjaman) {
            // Tidak perlu memperbarui qty di sini
            $this->Peminjaman_model->delete_peminjaman($id);
            $this->session->set_flashdata('message', 'Peminjaman berhasil dihapus.');
        } else {
            $this->session->set_flashdata('message', 'Gagal menghapus peminjaman.');
        }
        redirect('peminjaman');
    }
    
    
    
}

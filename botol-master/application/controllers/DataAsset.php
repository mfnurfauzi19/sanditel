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
        $data['dataasset'] = $this->Asset_model->get_all_assets();
        $data['title'] = "Data Asset";
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
        $this->check_access('gudang');
        $data['asset'] = $this->Asset_model->get_asset_by_id($id);
        if (!$data['asset']) show_404();

        $data['title'] = 'Edit Asset';
        $data['contents'] = $this->load->view('data_asset/edit', $data, true);
        $this->load->view('templates/dashboard', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('nama_asset', 'Nama Asset', 'required');
        $this->form_validation->set_rules('merk_kode', 'Merk/Type', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
        $this->form_validation->set_rules('ok', 'Jumlah OK', 'required|integer');
        $this->form_validation->set_rules('rusak', 'Jumlah Rusak', 'required|integer');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('data_asset/edit/' . $id);
        } else {
            $data = array(
                'nama_asset' => $this->input->post('nama_asset'),
                'merk_kode' => $this->input->post('merk_kode'),
                'qty' => $this->input->post('qty'),
                'ok' => $this->input->post('ok'),
                'rusak' => $this->input->post('rusak'),
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
        $this->check_access('admin');
        
        if ($this->Asset_model->delete_asset($id)) {
            $this->renumber_ids();
            $this->session->set_flashdata('pesan', 'Data asset berhasil dihapus.');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus data asset.');
        }
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
        $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
        $this->form_validation->set_rules('ok', 'Jumlah OK', 'required|integer');
        $this->form_validation->set_rules('rusak', 'Jumlah Rusak', 'required|integer');
    }

    private function process_asset($id = null)
    {
        $qty = $this->input->post('qty');
        $ok = $this->input->post('ok');
        $rusak = $this->input->post('rusak');

        if (!$this->validate_asset($qty, $ok, $rusak)) {
            $redirect_url = $id ? 'data_asset/edit/' . $id : 'data_asset/add';
            redirect($redirect_url);
        } else {
            $asset_data = [
                'nama_asset' => $this->input->post('nama_asset'),
                'merk_kode' => $this->input->post('merk_kode'),
                'qty' => $qty,
                'ok' => $ok,
                'rusak' => $rusak,
            ];

            if ($id) {
                $update = $this->Asset_model->update_asset($id, $asset_data);
                $message = $update ? 'Asset berhasil diupdate.' : 'Gagal mengupdate asset. Silakan coba lagi.';
            } else {
                $insert = $this->Asset_model->add_asset($asset_data);
                $message = $insert ? 'Asset berhasil ditambahkan.' : 'Gagal menambahkan asset. Silakan coba lagi.';
            }

            $this->session->set_flashdata('message', $message);
            redirect('data_asset');
        }
    }

    private function validate_asset($qty, $ok, $rusak)
    {
        if ($ok + $rusak > $qty) {
            $this->session->set_flashdata('message', 'Jumlah OK dan Rusak tidak boleh melebihi Qty.');
            return false;
        } elseif ($ok + $rusak != $qty) {
            $this->session->set_flashdata('message', 'Jumlah OK dan Rusak harus sama dengan Qty.');
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
    
    
    

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dataBarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['databarang'] = $this->Barang_model->get_all_barang();
        $data['title'] = "Data Barang";
        $data['contents'] = $this->load->view('data_barang/index', $data, true);
        $this->load->view('templates/dashboard', $data);
    }

    public function create()
    {
        $data['title'] = "Tambah Barang";
        $this->set_validation_rules();

        if ($this->form_validation->run() == false) {
            $data['contents'] = $this->load->view('data_barang/create', $data, true);
            $this->load->view('templates/dashboard', $data);
        } else {
            $this->process_barang();
        }
    }

    public function edit($id)
    {
        $data['barang'] = $this->Barang_model->get_barang_by_id($id);
        if (!$data['barang']) show_404();

        $data['title'] = 'Edit Barang';
        $data['contents'] = $this->load->view('data_barang/edit', $data, true);
        $this->load->view('templates/dashboard', $data);
    }

    public function update($id)
    {
        $data['barang'] = $this->Barang_model->get_barang_by_id($id);
        if (!$data['barang']) show_404();

        $this->set_validation_rules();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Barang';
            $data['contents'] = $this->load->view('data_barang/edit', $data, true);
            $this->load->view('templates/dashboard', $data);
        } else {
            $this->process_barang($id);
        }
    }

    public function delete($id)
    {
        $this->Barang_model->delete_barang($id);
        $this->session->set_flashdata('pesan', 'Data barang berhasil dihapus.');
        redirect('data_barang');
    }

    private function set_validation_rules()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('merk_kode', 'Merk/Type', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
        $this->form_validation->set_rules('harga', 'Harga', 'required|decimal');
    }

    private function process_barang($id = null)
    {
        $qty = $this->input->post('qty');
        $harga = $this->input->post('harga');

        $barang_data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'merk_kode' => $this->input->post('merk_kode'),
            'qty' => $qty,
            'harga' => $harga,
        ];

        if ($id) {
            $update = $this->Barang_model->update_barang($id, $barang_data);
            $message = $update ? 'Barang berhasil diupdate.' : 'Gagal mengupdate barang. Silakan coba lagi.';
        } else {
            $insert = $this->Barang_model->add_barang($barang_data);
            if ($insert) {
                $message = 'Barang berhasil ditambahkan.';
            } else {
                $message = 'Gagal menambahkan barang. Silakan coba lagi.';
                log_message('error', 'Barang failed to insert: ' . print_r($barang_data, true));
            }
        }

        $this->session->set_flashdata('message', $message);
        redirect('data_barang');
    }
}

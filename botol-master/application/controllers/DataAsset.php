<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dataAsset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model untuk berinteraksi dengan database
        $this->load->model('Asset_model');
        // Load form validation library
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Menampilkan halaman form input aset
        $data['title'] = 'Tambah Aset';
        $this->load->view('templates/header', $data);
        $this->load->view('data_asset/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        // Validasi form input
        $this->form_validation->set_rules('nama_asset', 'Nama Asset', 'required');
        $this->form_validation->set_rules('merk_kode', 'Merk/Kode', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
        $this->form_validation->set_rules('status', 'Status', 'required');

        // Jika validasi gagal
        if ($this->form_validation->run() == false) {
            $this->index(); // Tampilkan form kembali
        } else {
            // Jika validasi berhasil, ambil data dari input form
            $data = [
                'nama_asset' => $this->input->post('nama_asset'),
                'merk_kode' => $this->input->post('merk_kode'),
                'qty' => $this->input->post('qty'),
                'status' => $this->input->post('status'),
            ];

            // Simpan data ke database
            $insert = $this->Asset_model->add_asset($data);

            // Jika berhasil menyimpan, redirect dengan pesan sukses
            if ($insert) {
                $this->session->set_flashdata('message', 'Asset berhasil ditambahkan.');
                redirect('dataasset');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan asset.');
                redirect('dataasset');
            }
        }
    }
}

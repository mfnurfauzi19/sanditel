<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StockOpname extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StockOpname_model');
    }

    // Menampilkan halaman form stock opname
    public function index()
    {
        $data['title'] = 'Stock Opname';
        $data['assets'] = $this->StockOpname_model->get_all_assets_with_condition();
        $data['contents'] = $this->load->view('stock_opname/index', $data, true);

        
        $this->load->view('templates/dashboard', $data);
    }

    // Menyimpan data stock opname
    public function save()
    {
        $opname_data = array(
            'asset_id' => $this->input->post('asset_id'),
            'quantity' => $this->input->post('quantity'),
            'remarks' => $this->input->post('remarks')
        );

        if ($this->StockOpname_model->add_stock_opname($opname_data)) {
            $this->session->set_flashdata('pesan', 'Stock opname berhasil disimpan.');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal menyimpan stock opname.');
        }

        redirect('stock_opname');
    }
}

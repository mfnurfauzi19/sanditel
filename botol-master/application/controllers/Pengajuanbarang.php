<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengajuanBarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengajuanBarang_model');
        $this->load->library('form_validation');
        $this->load->library('session'); // Pastikan library session dimuat
        $this->load->library('pagination'); // Pastikan library pagination dimuat
        if (!$this->session->userdata('login_session')) {
            // Jika belum login, redirect ke halaman login
            redirect('auth');
        }
    }

    public function index($currentIndex = 0)
    {
        // Konfigurasi pagination
        $config['base_url'] = site_url('pengajuan_barang/index');
        $config['total_rows'] = $this->PengajuanBarang_model->get_total_items();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;

        // Styling pagination (opsional)
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        // Inisialisasi pagination
        $this->pagination->initialize($config);

        // Data untuk tampilan
        $data['title'] = "Pengajuan Barang";
        $data['requests'] = $this->PengajuanBarang_model->get_requests($currentIndex, $config['per_page']);

        // Tambahkan variabel untuk paginasi
        $data['currentIndex'] = $currentIndex;
        $data['itemsPerPage'] = $config['per_page'];
        $data['totalItems'] = $config['total_rows'];

        // Memuat tampilan
        $data['contents'] = $this->load->view('pengajuan_barang/index', $data, true);
        $this->load->view('templates/dashboard', $data);
    }



    

public function add()
{
    $data['title'] = "Tambah Pengajuan Barang";
    $this->set_validation_rules();

    if ($this->form_validation->run() == false) {
        $data['contents'] = $this->load->view('pengajuan_barang/add', $data, true);
        $this->load->view('templates/dashboard', $data);
    } else {
        // Ubah ini agar menggunakan method process_request() untuk insert data
        $this->process_request();
    }
}

public function edit($id)
{
    $data['request'] = $this->PengajuanBarang_model->get_request_by_id($id);
    if (!$data['request']) show_404();

    $data['title'] = "Edit Pengajuan Barang";
    $this->set_validation_rules();

    // Tambahkan variabel untuk status approved
    $data['is_approved'] = ($data['request']['approved'] == 2); // Jika status adalah 'approved'

    if ($this->form_validation->run() == false) {
        $data['contents'] = $this->load->view('pengajuan_barang/edit', $data, true);
        $this->load->view('templates/dashboard', $data);
    } else {
        $this->process_request($id);
    }
}



    public function delete($id)
    {
        $this->PengajuanBarang_model->delete_request($id);
        $this->session->set_flashdata('pesan', 'Data pengajuan barang berhasil dihapus.');
        redirect('pengajuan_barang');
    }

    public function approve($id)
    {
        // Mengambil data pengajuan berdasarkan ID
        $request = $this->PengajuanBarang_model->get_request_by_id($id);
        
        // Jika tidak ditemukan, tampilkan halaman 404
        if (!$request) show_404();

        // Menyusun data untuk tampilan
        $data['title'] = "Approve Pengajuan Barang";
        $data['request'] = $request;

        // Menyusun konten dengan tampilan approve
        $data['contents'] = $this->load->view('pengajuan_barang/approve', $data, true);
        $this->load->view('templates/dashboard', $data);
    }

    public function process_approval($id)
{
    // Mengambil data dari form
    $approval_status = $this->input->post('approval_status');
    $approved_qty = $this->input->post('approved_qty');
    
    // Mengambil status saat ini dari pengajuan
    $current_request = $this->PengajuanBarang_model->get_request_by_id($id);
    
    // Memastikan approved_qty tidak melebihi qty yang diajukan
    if ($approved_qty > $current_request['qty']) {
        $this->session->set_flashdata('pesan', 'Jumlah yang disetujui tidak boleh melebihi jumlah yang diajukan.');
        redirect('pengajuan_barang/approve/' . $id);
        return; // Menghentikan eksekusi jika ada kesalahan
    }

    // Menentukan nilai status berdasarkan pilihan
    if ($approval_status === 'approve') {
        $status = 2; // Diterima
    } elseif ($approval_status === 'tolak') {
        $status = 0; // Ditolak
    } elseif ($approval_status === 'pending') {
        $status = 1; // Pending
    } else {
        // Jika status tidak valid, kembalikan error atau atur default
        $this->session->set_flashdata('pesan', 'Status tidak valid.');
        redirect('pengajuan_barang');
        return; // Menghentikan eksekusi jika status tidak valid
    }

    // Menyiapkan data untuk update
    $data = [
        'approved' => $status, // Menyimpan status
        'approved_qty' => ($status === 2) ? $approved_qty : NULL // Hanya simpan qty jika diterima
    ];

    // Tambahkan logika untuk memastikan hanya status pending yang dapat diubah
    if ($current_request['approved'] == 1) { // Jika status saat ini adalah Pending
        // Panggil fungsi model untuk update pengajuan
        $this->PengajuanBarang_model->update_request($id, $data);
        
        // Set flash message dan redirect ke halaman pengajuan barang
        $this->session->set_flashdata('pesan', 'Status pengajuan berhasil diperbarui.');
        redirect('pengajuan_barang');
    } else {
        // Jika status bukan Pending, tidak bisa diubah lagi
        $this->session->set_flashdata('pesan', 'Pengajuan ini tidak dapat diubah lagi.');
        redirect('pengajuan_barang');
    }
}

    

    private function set_validation_rules()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_pengajuan', 'No Pengajuan', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('merk_kode', 'Merk/Kode', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
    }

    public function process_request()
    {
        // Set validation rules
        $this->set_validation_rules();
    
        // Validate form input
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Pengajuan Barang";
            $data['contents'] = $this->load->view('pengajuan_barang/add', $data, true);
            $this->load->view('templates/dashboard', $data);
        } else {
            // Collect data from the form
            $request_data = [
                'tanggal' => $this->input->post('tanggal'),
                'no_pengajuan' => $this->input->post('no_pengajuan'),
                'approved' => 1, // Status pending
                'approved_qty' => NULL // No quantity approved yet
            ];
    
            // Check if cart is available
            $cart = $this->session->userdata('cart');
            
            if (!empty($cart)) {
                // Insert the main request data
                if ($this->PengajuanBarang_model->add_request($request_data)) {
                    $pengajuan_id = $this->db->insert_id(); // Get the newly inserted request ID
                    
                    // Insert each item in the cart
                    foreach ($cart as $item) {
                        $item_data = [
                            'pengajuan_id' => $pengajuan_id,
                            'nama_barang' => $item['nama_barang'],
                            'merk_kode' => $item['merk_kode'],
                            'qty' => $item['qty'],
                            'jenis' => $item['jenis'],
                        ];
                        $this->PengajuanBarang_model->add_item($item_data);
                    }
    
                    // Clear the cart
                    $this->session->unset_userdata('cart');
    
                    // Set a success message
                    $this->session->set_flashdata('pesan', 'Pengajuan barang berhasil ditambahkan.');
                } else {
                    $this->session->set_flashdata('pesan', 'Gagal menyimpan pengajuan barang. Silakan coba lagi.');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Tidak ada barang yang ditambahkan.');
            }
    
            // Redirect back to the list of requests
            redirect('pengajuan_barang');
        }
    }
    
    
    
    private function check_access()
    {
        if (!$this->session->userdata('login_session')) {
            redirect('login');
        }

        // Mengizinkan hanya admin untuk mengakses proses approval
        if ($this->session->userdata('login_session')['role'] !== 'admin' && $this->router->fetch_method() == 'approve') {
            $this->session->set_flashdata('pesan', 'Anda tidak memiliki akses untuk tindakan ini.');
            redirect('pengajuan_barang');
        }
    }
    public function update_request($id)
{
    $this->set_validation_rules();
    
    if ($this->form_validation->run() == false) {
        $data['request'] = $this->PengajuanBarang_model->get_request_by_id($id);
        $data['title'] = "Edit Pengajuan Barang";
        $data['contents'] = $this->load->view('pengajuan_barang/edit', $data, true);
        $this->load->view('templates/dashboard', $data);
    } else {
        // Mengumpulkan data input
        $request_data = [
            'tanggal' => $this->input->post('tanggal'),
            'no_pengajuan' => $this->input->post('no_pengajuan'),
            'nama_barang' => $this->input->post('nama_barang'),
            'merk_kode' => $this->input->post('merk_kode'),
            'qty' => $this->input->post('qty'),
            'jenis' => $this->input->post('jenis'),
            // Jangan ubah status jika sudah diproses
            // 'approved' => ... (jangan sertakan jika tidak perlu mengubah status)
        ];

        // Update data ke database
        $this->PengajuanBarang_model->update_request($id, $request_data);
        $this->session->set_flashdata('pesan', 'Pengajuan barang berhasil diperbarui.');
        redirect('pengajuan_barang');
    }
}



public function add_to_cart()
{
    // Ambil data dari form
    $data = array(
        'nama_barang' => $this->input->post('nama_barang'),
        'merk_kode' => $this->input->post('merk_kode'),
        'qty' => $this->input->post('qty'),
        'jenis' => $this->input->post('jenis'),
    );

    // Validasi input, pastikan tidak ada yang kosong
    if (empty($data['nama_barang']) || empty($data['merk_kode']) || empty($data['qty']) || empty($data['jenis'])) {
        $this->session->set_flashdata('pesan', 'Semua kolom harus diisi.');
        redirect('pengajuan_barang/add');  // Pastikan rute ini sesuai
        return;
    }

    // Ambil cart dari session
    $cart = $this->session->userdata('cart');

    // Jika cart tidak ada, buat array baru
    if (!$cart) {
        $cart = array();
    }

    // Cek apakah item yang sama sudah ada di cart (berdasarkan nama_barang atau merk_kode)
    $item_exists = false;
    foreach ($cart as $item) {
        if ($item['nama_barang'] === $data['nama_barang'] && $item['merk_kode'] === $data['merk_kode']) {
            $item_exists = true;
            break;
        }
    }

    if ($item_exists) {
        $this->session->set_flashdata('pesan', 'Item sudah ada dalam keranjang.');
    } else {
        // Tambahkan item ke cart
        $cart[] = $data;
        // Simpan kembali ke session
        $this->session->set_userdata('cart', $cart);
        $this->session->set_flashdata('pesan', 'Item berhasil ditambahkan ke keranjang.');
    }

    // Redirect kembali ke halaman form pengajuan barang
    redirect('pengajuan_barang/add');  // Pastikan ini adalah halaman yang benar
}


public function remove($index)
{
    // Ambil cart dari session
    $cart = $this->session->userdata('cart');

    // Hapus item dari cart
    if (isset($cart[$index])) {
        unset($cart[$index]);

        // Reindex array
        $cart = array_values($cart);

        // Simpan kembali ke session
        $this->session->set_userdata('cart', $cart);
    }

    // Redirect kembali ke form
    redirect('pengajuan_barang/add');
}
}
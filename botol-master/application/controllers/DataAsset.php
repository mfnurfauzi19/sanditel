    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class dataAsset extends CI_Controller
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
            // Pastikan ID yang diterima adalah valid
            $this->form_validation->set_rules('nama_asset', 'Nama Asset', 'required');
            $this->form_validation->set_rules('merk_kode', 'Merk/Type', 'required');
            $this->form_validation->set_rules('qty', 'Qty', 'required|integer');
            $this->form_validation->set_rules('ok', 'Jumlah OK', 'required|integer');
            $this->form_validation->set_rules('rusak', 'Jumlah Rusak', 'required|integer');
        
            if ($this->form_validation->run() === FALSE) {
                // Jika validasi gagal
                $this->session->set_flashdata('pesan', validation_errors());
                redirect('data_asset/edit/' . $id);
            } else {
                // Jika validasi berhasil
                $data = array(
                    'nama_asset' => $this->input->post('nama_asset'),
                    'merk_kode' => $this->input->post('merk_kode'),
                    'qty' => $this->input->post('qty'),
                    'ok' => $this->input->post('ok'),
                    'rusak' => $this->input->post('rusak'),
                );
        
                if ($this->Asset_model->update_asset($id, $data)) {
                    // Jika berhasil memperbarui data
                    $this->session->set_flashdata('pesan', 'Asset berhasil diperbarui');
                } else {
                    // Jika gagal
                    $this->session->set_flashdata('pesan', 'Gagal memperbarui asset');
                }
                redirect('data_asset');
            }
        }
        
        
        public function delete($id)
        {
            $this->check_access('gudang');
            
            // Step 1: Delete the asset
            if ($this->Asset_model->delete_asset($id)) {
                // Step 2: Renumber IDs
                $this->renumber_ids();
        
                $this->session->set_flashdata('pesan', 'Data asset berhasil dihapus.');
            } else {
                $this->session->set_flashdata('pesan', 'Gagal menghapus data asset.');
            }
            redirect('data_asset');
        }
        
        private function renumber_ids()
        {
            // Step 3: Fetch all assets
            $assets = $this->Asset_model->get_all_assets();
            
            // Step 4: Update the IDs sequentially
            foreach ($assets as $index => $asset) {
                $new_id = $index + 1; // Start from 1
                if ($asset['id'] != $new_id) { // Update only if there's a change
                    $this->Asset_model->update_asset_id($asset['id'], $new_id);
                }
            }
        }
        

        private function set_validation_rules()
        {
            $this->form_validation->set_rules('nama_asset', 'Nama Asset', 'required');
            $this->form_validation->set_rules('merk_type', 'Merk/Type', 'required');
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
                    'merk_kode' => $this->input->post('merk_type'),
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

            if ($this->session->userdata('login_session')['role'] === $role) {
                $this->session->set_flashdata('pesan', 'Anda tidak memiliki akses untuk tindakan ini.');
                redirect('data_asset');
            }
        }

        public function generate_barcode($merk_kode)
        {
            $merk_kode = urldecode($merk_kode); // Decode jika menggunakan encode sebelumnya
            $asset = $this->Asset_model->get_asset_by_merk_kode($merk_kode);
            
            if ($asset) {
                $nama_asset = $asset['nama_asset'];
                $nama_asset = urlencode($nama_asset); // Pastikan nama_asset di-encode
                $randomNumber = $this->generateRandomNumber(10);
                $barcodeText = $nama_asset . ' ' . $randomNumber;
        
                $generator = new BarcodeGeneratorHTML();
                $data['barcode'] = $generator->getBarcode($barcodeText);
                $this->load->view('data_asset/barcode_view', $data);
            } else {
                echo "Aset tidak ditemukan.";
            }
        }
        
        

        private function generateRandomNumber($length)
        {
            $min = 0;
            $max = (int)pow(10, $length) - 1;

            return str_pad(rand($min, $max), $length, '0', STR_PAD_LEFT);
        }
    }

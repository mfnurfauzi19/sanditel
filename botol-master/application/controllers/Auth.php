<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Admin_model', 'admin');
    }
    // Contoh di Controller Login
public function login()
{
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
        // tampilkan form login lagi jika validasi gagal
        $this->load->view('auth/login');
    } else {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Query untuk memverifikasi login
        $user = $this->User_model->check_user_login($username, $password);

        if ($user) {
            // Simpan data user ke dalam session
            $session_data = [
                'user_id'   => $user->id,
                'username'  => $user->username,
                'logged_in' => true,
            ];
            $this->session->set_userdata($session_data);

            // Redirect ke dashboard atau halaman lain
            redirect('dashboard');
        } else {
            // jika login gagal, tampilkan pesan error
            $this->session->set_flashdata('message', 'Username atau password salah.');
            redirect('login');
        }
    }
}


    private function _has_login()
    {
        if ($this->session->has_userdata('login_session')) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_has_login();
    
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Aplikasi';
            $this->template->load('templates/auth', 'auth/login', $data);
        } else {
            $input = $this->input->post(null, true);
    
            $cek_username = $this->auth->cek_username($input['username']);
            if ($cek_username > 0) {
                $password = $this->auth->get_password($input['username']);
                if (password_verify($input['password'], $password)) {
                    $user_db = $this->auth->userdata($input['username']);
                    if ($user_db['is_active'] != 1) {
                        set_pesan('Akun anda belum aktif/dinonaktifkan. Silahkan hubungi admin.', false);
                        redirect('login');
                    } else {
                        $userdata = [
                            'user'  => $user_db['id_user'],
                            'role'  => $user_db['role'], // Simpan role pengguna di sini
                            'username' => $user_db['username'], // Simpan username di sini
                            'timestamp' => time()
                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard');
                    }
                } else {
                    set_pesan('Password salah', false);
                    redirect('auth');
                }
            } else {
                set_pesan('Username belum terdaftar', false);
                redirect('auth');
            }
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('login_session');

        set_pesan('Anda telah berhasil logout');
        redirect('auth');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Buat Akun';
            $this->template->load('templates/auth', 'auth/register', $data);
        } else {
            $input = $this->input->post(null, true);
            unset($input['password2']);
            $input['password']      = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['role']          = 'gudang'; // Ganti sesuai kebutuhan
            $input['foto']          = 'user.png'; // Ganti sesuai kebutuhan
            $input['is_active']     = 0; // Set akun baru tidak aktif
            $input['created_at']    = time();

            $query = $this->admin->insert('user', $input);
            if ($query) {
                set_pesan('Daftar berhasil. Selanjutnya silahkan hubungi admin untuk mengaktifkan akun anda.');
                redirect('login');
            } else {
                set_pesan('Gagal menyimpan ke database', false);
                redirect('register');
            }
        }
    }
}

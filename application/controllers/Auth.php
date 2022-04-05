<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        login();
    }
    private function _validationLogin()
    {
        // validasi login
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'username harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim', [
            'required' => 'password harus diisi'
        ]);
    }
    private function _validationRegister()
    {
        // validasi register
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[user.username]|min_length[3]', [
            'is_unique' => 'username sudah digunakan',
            'min_length' => 'minimal harus 5 huruf'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]', [
            'min_length' => 'password minimal 3 huruf'
        ]);
        $this->form_validation->set_rules('name', 'nama', 'required', [
            'required' => 'nama harus diisi'
        ]);
        $this->form_validation->set_rules('phone', 'nomor Hp', 'required|numeric|max_length[13]|min_length[11]', [
            'numeric' => 'nomor harus berupa angka',
            'max_length' => 'maksimal 15 digit angka',
            'min_length' => 'maksimal 11 digit angka'
        ]);
        $this->form_validation->set_rules('address', 'alamat', 'required');
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }
    private function _login()
    {
        $this->_validationLogin();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('Auth/Login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // ambil satu baris data user
            $user = $this->db->get_where('user', ['username' => $username])->row_array();
            // jika user ada
            if ($user) {
                // jika user sudah aktivasi
                if ($user['is_actived'] == 1) {
                    // cek password
                    if (password_verify($password, $user['password'])) {
                        // jika sama
                        $data = [
                            'user_id' => $user['user_id'],
                            'username' => $user['username'],
                            'level' => $user['level'],
                            'is_actived' => $user['is_actived'],
                            'on_off' => $user['on_off'],
                        ];
                        $this->session->set_userdata($data);
                        $log = [
                            'user_id' => $user['user_id'],
                            'time_login' => time(),
                            'time_logout' => null
                        ];
                        $this->db->insert('log_activity', $log);
                        $x = $user['user_id'];
                        $online = 1;
                        $this->db->set('on_off', $online);
                        $this->db->where('user_id', $x);
                        $this->db->update('user');
                        if ($user['level'] == 2) {
                            redirect('Sale');
                        } else {
                            redirect('Dashboard');
                        }
                    } else {
                        // jika tidak sama
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-warning" role="alert">
                                username atau password anda salah!
                            </div>'
                        );
                        redirect('Auth');
                    }
                } else {
                    // jika user belum aktivasi
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-warning" role="alert">
                            akun ini belum diaktifkan, silahkan <b class="text-white">klik tombol minta aktivasi</b> untuk diaktifkan!
                        </div>'
                    );
                    redirect('Auth');
                }
            } else {
                //jika user tidak ada
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        akun ini belum terdaftar!
                    </div>'
                );
                redirect('Auth');
            }
        }
    }
    public function index()
    {
        $this->db->query('DELETE FROM report');
        $this->_login();
    }
    private function _regis()
    {
        $this->load->library('session');
        $this->_validationRegister();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register Page';
            $this->load->view('Auth/Register', $data);
        } else {
            $data = [
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'address' => $this->input->post('address', true),
                'image' => 'default.png',
                'phone' => $this->input->post('phone'),
                'is_actived' => 0,
                'date_created' => time(),
                'level' => 2,
                'on_off' => 0,
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-primary" role="alert">
                    berhasil mendaftar!, klik tombol "minta aktivasi" untuk mengaktifkan
                </div>'
            );
            redirect('Auth');
        }
    }
    public function register()
    {
        $this->_regis();
    }
    private function _logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-primary" role="alert">
                terima kasih!
            </div>'
        );
        redirect('Auth');
    }
    public function logout()
    {
        $this->_logout();
    }
    public function message()
    {
        $data = $this->session->userdata('username') . ' meminta pengaktifan akun';
        echo $data;
    }
}

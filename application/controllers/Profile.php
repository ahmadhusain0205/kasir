<?php
class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logout();
    }
    public function index()
    {
        $this->db->query('DELETE FROM report');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Profile', $data);
    }
    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Edit', $data);
    }
    public function edit_process()
    {

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $address = $this->input->post('address');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $username = $this->input->post('username');
        // cek jika ada gambar baru
        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/profile/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $this->db->set('name', $name);
        $this->db->set('username', $username);
        $this->db->set('address', $address);
        $this->db->set('phone', $phone);
        $this->db->where('username', $username);
        $this->db->update('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-primary btn-sm my-auto" role="alert">
                berhasil mengubah profile!
            </div>'
        );
        redirect('Profile');
    }
    public function edit_password()
    {
        $this->form_validation->set_rules('password', 'sandi baru', 'required|trim');
        $this->form_validation->set_rules('password1', 'sandi baru', 'required|trim|matches[password]', [
            'matches' => 'sandi baru harus sama dengan konfirmasi sandi'
        ]);
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        if ($this->form_validation->run() == false) {
            $this->template->load('Template', 'Edit_password', $data);
        } else {
            $id = $this->input->post('user_id');
            $where = ['user_id' => $id];
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->db->set('password', $password);
            $this->db->where($where);
            $this->db->update('user');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-primary btn-sm my-auto" role="alert">
                berhasil mengubah sandi!
            </div>'
            );
            redirect('Profile');
        }
    }
}

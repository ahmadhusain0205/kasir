<?php
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logout();
        if ($this->session->userdata('level') == 2) {
            redirect('Block');
        }
    }
    public function index()
    {
        $this->db->query('DELETE FROM report');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $where = 'level = 2';
        $data['member'] = $this->M_master->get_user('user', $where);
        $this->template->load('Template', 'User/Data', $data);
    }
    public function actived($id)
    {
        $where = $id;
        $is_actived = 1;
        $this->db->set('is_actived', $is_actived);
        $this->db->where('user_id', $where);
        $this->db->update('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil diaktifkan!
            </div>'
        );
        redirect('User');
    }

    public function nonactived($id)
    {
        $where = $id;
        $is_actived = 0;
        $this->db->set('is_actived', $is_actived);
        $this->db->where('user_id', $where);
        $this->db->update('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil dinonaktifkan!
            </div>'
        );
        redirect('user');
    }
    public function add()
    {
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[user.username]|min_length[3]', [
            'is_unique' => 'username sudah digunakan',
            'required' => 'username harus diisi',
            'min_length' => 'minimal harus 5 huruf'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]', [
            'min_length' => 'password minimal 3 huruf',
            'required' => 'password harus diisi'
        ]);
        $this->form_validation->set_rules('name', 'Nama', 'required', [
            'required' => 'nama harus diisi'
        ]);
        $this->form_validation->set_rules('address', 'Alamat', 'required', [
            'required' => 'alamat harus diisi'
        ]);
        $this->form_validation->set_rules('phone', 'Nomor Hp', 'required|numeric|max_length[13]|min_length[11]', [
            'required' => 'nomor hp harus diisi',
            'numeric' => 'nomor harus berupa angka',
            'max_length' => 'maksimal 15 digit angka',
            'min_length' => 'maksimal 11 digit angka'
        ]);
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $this->template->load('Template', 'User/Add', $data);
        } else {
            $data = [
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'name' => $this->input->post('name', true),
                'phone' => $this->input->post('phone', true),
                'address' => $this->input->post('address', true),
                'is_actived' => 0,
                'date_created' => time(),
                'level' => 2,
                'image' => 'default.png'
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menambahkan anggota!
            </div>'
            );
            redirect('User');
        }
    }
    public function delete($id)
    {
        $where = array('user_id' => $id);
        $this->db->where($where);
        $this->db->delete('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menghapus anggota!
            </div>'
        );
        redirect('User');
    }
    public function edit($id)
    {
        $data['level'] = $this->db->get('level')->result();
        $where = array('user_id' => $id);
        $data['member'] = $this->db->get_where('user', $where)->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'User/Edit', $data);
    }
    public function edit_process()
    {
        $where = array('user_id' => $this->input->post('user_id'));
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('phone', $this->input->post('phone'));
        $this->db->set('address', $this->input->post('address'));
        $this->db->set('level', $this->input->post('level'));
        $this->db->where($where);
        $this->db->update('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil mengubah data anggota!
            </div>'
        );
        redirect('User');
    }
}

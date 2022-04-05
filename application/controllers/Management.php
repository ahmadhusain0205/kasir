<?php
class Management extends CI_Controller
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
        $data['anggota'] = $this->db->get('user')->result();
        $this->template->load('Template', 'Management/Data', $data);
    }
    public function admin($id)
    {
        $where = $id;
        $level = 1;
        $this->db->set('level', $level);
        $this->db->where('user_id', $where);
        $this->db->update('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menjadi admin!
            </div>'
        );
        redirect('Management');
    }

    public function user($id)
    {
        $where = $id;
        $level = 2;
        $this->db->set('level', $level);
        $this->db->where('user_id', $where);
        $this->db->update('user');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menjadi kasir!
            </div>'
        );
        redirect('Management');
    }
}

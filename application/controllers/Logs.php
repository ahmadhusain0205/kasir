<?php
class Logs extends CI_Controller
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
        $data['log'] = $this->db->query('select u.name, lv.status, l.time_login, l.time_logout from log_activity l join user u on l.user_id=u.user_id join level lv on u.level=lv.level_id order by l.time_login desc')->result();
        $this->template->load('Template', 'Logs', $data);
    }
    public function print()
    {
        $data['print'] = $this->db->query('select l.time_login, l.time_logout, u.name from log_activity l join user u on l.user_id=u.user_id')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Print', $data);
    }
    public function delete_all()
    {
        $this->db->query('delete from log_activity');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-xs" role="alert">
                berhasil menghapus semua data log!
            </div>'
        );
        redirect('Logs');
    }
}

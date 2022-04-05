<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logout();
        $this->load->model('M_admin');
        if ($this->session->userdata('level') == 2) {
            redirect('Block');
        }
    }
    public function index()
    {
        $this->db->query('DELETE FROM report');
        $data['count_item'] = $this->db->get('items')->num_rows();
        $data['count_supplier'] = $this->db->get('supplier')->num_rows();
        $data['count_in'] = $this->db->query('select sum(qty) as qty_in from stock where type = "in"')->result();
        $data['count_out'] = $this->db->query('select sum(qty) as qty_out from stock where type = "out"')->result();
        $data['profit'] = $this->db->query('select sum(profit) as profit from transaction_done where created = CURRENT_DATE()')->result();
        $data['count_user'] = $this->db->get_where('user', 'level = 2')->num_rows();
        $data['modal'] = $this->db->query('select sum(price*stock_id) as md from items')->result();

        // Line Chart
        // $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        // $data['cbm'] = [];
        // $data['cbk'] = [];

        // foreach ($bln as $b) {
        //     $data['cbm'][] = $this->M_admin->chartBarangMasuk($b);
        //     $data['cbk'][] = $this->M_admin->chartBarangKeluar($b);
        // }
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Dashboard', $data);
    }
}

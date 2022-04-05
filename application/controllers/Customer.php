<?php
class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logout();
        $this->load->model('M_customer');
        if ($this->session->userdata('level') == 2) {
            redirect('Block');
        }
    }
    public function index()
    {
        $this->db->query('DELETE FROM report');
        $data['row'] = $this->M_customer->get()->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Customer/Data', $data);
    }
    public function add()
    {
        $customer = new stdClass();
        $customer->customer_id = null;
        $customer->name = null;
        $customer->address = null;
        $customer->phone = null;
        $data = [
            'page' => 'tambah',
            'row' => $customer
        ];
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Customer/Form', $data);
    }
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['tambah'])) {
            $this->M_customer->add($post);
        } else if (isset($_POST['ubah'])) {
            $this->M_customer->edit($post);
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil memproses kostumer!
            </div>'
        );
        redirect('Customer');
    }
    public function edit($id)
    {
        $query = $this->M_customer->get($id);
        if ($query->num_rows() > 0) {
            $supplier = $query->row();
            $data = [
                'page' => 'ubah',
                'row' => $supplier
            ];
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $this->template->load('Template', 'Customer/Form', $data);
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning btn-sm my-auto" role="alert">
                data tidak ditemukan!
            </div>'
            );
            redirect('Customer');
        }
    }
    public function delete($id)
    {
        $where = array('customer_id' => $id);
        $this->db->where($where);
        $this->db->delete('customer');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menghapus pemasok!
            </div>'
        );
        redirect('Customer');
    }
}

<?php
class Supplier extends CI_Controller
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
        $data['row'] = $this->M_master->get()->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Supplier/Data', $data);
    }
    public function delete($id)
    {
        $where = array('supplier_id' => $id);
        $this->db->where($where);
        $this->db->delete('supplier');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                    berhasil menghapus pemasok!
                </div>'
        );
        redirect('Supplier');
    }
    public function add()
    {
        $supplier = new stdClass();
        $supplier->supplier_id = null;
        $supplier->name = null;
        $supplier->phone = null;
        $supplier->address = null;
        $supplier->description = null;
        $supplier->created = null;
        $supplier->updated = null;
        $data = [
            'page' => 'tambah',
            'row' => $supplier
        ];
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Supplier/Form', $data);
    }
    public function edit($id)
    {
        $query = $this->M_master->get($id);
        if ($query->num_rows() > 0) {
            $supplier = $query->row();
            $data = [
                'page' => 'ubah',
                'row' => $supplier
            ];
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $this->template->load('Template', 'Supplier/Form', $data);
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning btn-sm my-auto" role="alert">
                data tidak ditemukan!
            </div>'
            );
            redirect('Supplier');
        }
    }
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['tambah'])) {
            $this->M_master->add($post);
        } else if (isset($_POST['ubah'])) {
            $this->M_master->edit($post);
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil memproses pemasok!
            </div>'
        );
        redirect('Supplier');
    }
}

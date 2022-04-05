<?php
class Categories extends CI_Controller
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
        $data['categori'] = $this->db->get('categories')->result();
        $this->template->load('Template', 'Categori/Data', $data);
    }
    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Categori/Add', $data);
    }
    private function _validation()
    {
        $this->form_validation->set_rules('code', 'kode', 'required|alpha');
        $this->form_validation->set_rules('categori', 'kategori', 'required|alpha');
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
        $this->form_validation->set_message('alpha', '%s harus berupa huruf');
    }
    public function add_process()
    {
        $this->_validation();
        if ($this->form_validation->run() == true) {
            $data = [
                'code' => $this->input->post('code'),
                'categori' => $this->input->post('categori')
            ];
            $this->db->insert('categories', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success btn-sm my-auto" role="alert">
                    berhasil menambahkan kategori barang!
                </div>'
            );
            redirect('Categories');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger btn-sm my-auto" role="alert">
                    gagal menambahkan kategori barang!
                </div>'
            );
            redirect('Categories/add');
        }
    }
    public function edit($id)
    {
        $where = array('code' => $id);
        $data['categori'] = $this->db->get_where('categories', $where)->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Categori/Edit', $data);
    }
    public function edit_process()
    {
        $where = array('code' => $this->input->post('code'));
        $data = [
            'categori' => $this->input->post('categori')
        ];
        $this->db->where($where);
        $this->db->update('categories', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil mengubah kategori barang!
            </div>'
        );
        redirect('Categories');
    }
    public function delete($id)
    {
        $where = array('code' => $id);
        $this->db->where($where);
        $this->db->delete('categories');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menghapus kategori barang!
            </div>'
        );
        redirect('Categories');
    }
}

<?php
class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logout();
        $this->load->model('M_stock');
        if ($this->session->userdata('level') == 2) {
            redirect('Block');
        }
    }
    // stock in
    public function in_data()
    {
        $this->db->query('DELETE FROM report');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['stok'] = $this->db->query('select s.stock_id, s.invoice, u.name as u_name, su.supplier_id, i.name, s.code, s.type, s.detail, s.qty, s.date, s.created, su.name as su_name from stock s join items i on s.code=i.code join supplier su on s.supplier_id=su.supplier_id join user u on s.user_id=u.user_id where s.type = "in" order by stock_id desc');
        $this->template->load('Template', 'Transaction/In/Data', $data);
    }
    public function in_add()
    {
        $data['item'] = $this->db->query('select i.code as barcode, i.stock_id, i.name, i.price, i.purchase, c.categori from items i join categories c on i.categori_code=c.code order by stock_id desc');
        $data['supplier'] = $this->db->get('supplier');
        $data['member'] = $this->db->get('user');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Transaction/In/Form', $data);
    }
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add_process'])) {
            $this->M_stock->add($post);
            $this->M_stock->update_stock_item($post);
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil memproses stok!
            </div>'
        );
        redirect('Stock/in_data');
    }
    public function delete()
    {
        $stock_id = $this->uri->segment(3);
        $id = ['stock_id' => $this->uri->segment(3)];
        $code = $this->uri->segment(4);
        $qty = $this->db->get_where('stock', $id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_code' => $code
        ];
        $this->M_stock->update_stock_out($data);
        $this->M_stock->delete($stock_id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil memproses stok!
            </div>'
        );
        redirect('Stock/in_data');
    }


    // stock out
    public function out_data()
    {
        $this->db->query('DELETE FROM report');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['stok'] = $this->db->query('select s.stock_id, (select name from user where user_id=s.user_id) as u_name, s.invoice, i.name, s.code, s.type, s.detail, s.qty, s.date, s.created from stock s join items i on s.code=i.code where s.type = "out" order by s.invoice desc');
        $this->template->load('Template', 'Transaction/Out/Data', $data);
    }
    public function out_add()
    {
        $data['item'] = $this->db->query('select i.code as barcode, i.stock_id, i.name, i.price, i.purchase, c.categori from items i join categories c on i.categori_code=c.code');
        $data['supplier'] = $this->db->get('supplier');
        $data['member'] = $this->db->get('user');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Transaction/Out/Form', $data);
    }
    public function process2()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add_process_out'])) {
            $this->M_stock->add_out($post);
            $this->M_stock->update_stock_item_out($post);
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil memproses stok!
            </div>'
        );
        redirect('Stock/out_data');
    }
    public function delete_out()
    {
        $stock_id = $this->uri->segment(3);
        $id = ['stock_id' => $this->uri->segment(3)];
        $code = $this->uri->segment(4);
        $qty = $this->db->get_where('stock', $id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_code' => $code
        ];
        $this->M_stock->update_stock_out2($data);
        $this->M_stock->delete($stock_id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil memproses stok!
            </div>'
        );
        redirect('Stock/out_data');
    }
}

<?php 
class Cashier extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        logout();
        $this->load->model('M_sale');
    }
    public function index(){
        $this->db->query('DELETE FROM report');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tes'] = $this->db->query('SELECT t.code, t.invoice, t.sale_id, t.qty, i.name as nama_barang, i.price, t.sub_total, t.cash from tes t JOIN items i ON t.code=i.code ORDER BY created desc')->result();
        $data['kembalian'] = $this->db->query('SELECT kembalian FROM tes GROUP BY invoice DESC')->result();
        $data['total'] = $this->db->query('SELECT sum(sub_total) as total FROM tes')->result();
        $this->load->view('Cashier', $data);
    }
    public function tes(){
        $where = $this->input->post('add');
        if($this->input->post('qty') == null){
            $qty = 1;
        } else {
            $qty = $this->input->post('qty');
        }
        $code = $this->db->query('select code, price, name from items where code like "' . $where . '" or code like "'.$where.'%" or code like "%' . $where . '" or name like "' . $where .'" or name like "' . $where .'%" or name like "%' . $where . '"')->result();
        $exist = $this->db->query('SELECT t.code, i.name FROM tes t JOIN items i ON t.code=i.code WHERE i.name IN (SELECT name FROM items WHERE name = "'.$where.'") OR t.code = "'.$where.'" or name like "' . $where . '" or name like "' . $where . '%" or name like "%' . $where . '"')->result();
        foreach($exist as $e){
            $code_e = $e->code;
            $code_en = $e->name;
        }
        foreach ($code as $c) {
            $code_c = $c->code;
            $code_n = $c->name;
        }
        $invoice = $this->M_sale->invoice_no();
        // var_dump($code_en.' + '.$code_n);
        if(($code_c == $code_e) or ($code_n == $code_en)){
            $this->db->query("UPDATE tes SET qty = qty + ".$qty." WHERE code = '".$where."'");
            $this->db->query("UPDATE tes JOIN items ON tes.code=items.code  SET sub_total = qty * price WHERE tes.code = '" . $where . "'");
            redirect('Cashier');
        } else if($code){
            foreach($code as $i){
                $data = [
                    'invoice' => $invoice,
                    'code' => $i->code,
                    'qty' => $qty,
                    'customer_id' => 1,
                    'sub_total' => $qty*$i->price,
                    'user_id'  => $this->session->userdata('user_id')
                ];
                $this->db->insert('tes', $data);
                redirect('Cashier');
                    
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger btn-xs" role="alert">
                barang tidak ada!
            </div>'
            );
            redirect('Cashier');
        }
    }
    public function delete($id)
    {
        $where = array('sale_id' => $id);
        $this->db->where($where);
        $this->db->delete('tes');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-xs" role="alert">
                berhasil menghapus pesanan!
            </div>'
        );
        redirect('Cashier');
    }
    public function kembalian(){
        $invoice = $this->M_sale->invoice_no();
        $total = (int)$this->input->post('total');
        $cash = (int)$this->input->post('cash');
        $kembalian = $cash-$total;
        $this->db->set('cash', $cash);
        $this->db->set('kembalian', $kembalian);
        $this->db->where('invoice', $invoice);
        $this->db->update('tes');
        redirect('Cashier');
        // var_dump($kembalian);
    }
    public function edit($id)
    {
        $where = array('user_id' => $id);
        $data['tes'] = $this->db->get_where('tes', $where)->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Edit_cashier', $data);
    }
    public function edit_process($id){
        $where = array('sale_id' => $id);
        $data = [
            'qty' => $this->input->post('qty')
        ];
        $this->db->where($where);
        $this->db->update('tes', $data);
        redirect('Cashier');

    }
}

<?php
class M_stock extends CI_Model
{
    // master
    public function invoice_no()
    {
        $sql = "SELECT (MID(invoice, 9, 4)) AS invoice_no FROM transaction_done WHERE MID(invoice, 3, 6) = DATE_FORMAT(CURDATE(), '%y%m%d') ORDER BY invoice DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "WA" . date('ymd') . $no;
        return $invoice;
    }
    public function delete($stock_id)
    {
        $this->db->where('stock_id', $stock_id);
        $this->db->delete('stock');
    }
    // stock in
    public function add($post)
    {
        $data = [
            'code' => $this->input->post('item_code'),
            'type' => 'in',
            'invoice' => $this->invoice_no(),
            'detail' => $this->input->post('detail'),
            'supplier_id' => $this->input->post('supplier_id') == '' ? null : $this->input->post('supplier_id'),
            'qty' => $this->input->post('qty'),
            'date' => $this->input->post('date'),
            'user_id' => $this->session->userdata('user_id')
        ];
        $this->db->insert('stock', $data);
    }
    public function update_stock_item($post)
    {
        $qty = $this->input->post('qty');
        $code = $this->input->post('item_code');
        $sql = 'UPDATE items SET stock_id = stock_id + ' . $qty . ' WHERE code = "' . $code . '"';
        $this->db->query($sql);
    }
    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $code = $data['item_code'];
        $sql = 'UPDATE items SET stock_id = stock_id - ' . $qty . ' WHERE code = "' . $code . '"';
        $this->db->query($sql);
    }
    // stok out
    public function add_out($post)
    {
        $invoice = $this->invoice_no();
        $data = [
            'code' => $this->input->post('item_code'),
            'invoice' => $invoice,
            'type' => 'out',
            'detail' => $this->input->post('detail'),
            'supplier_id' => $this->input->post('supplier_id') ? null : $this->input->post('supplier_id'),
            'qty' => $this->input->post('qty'),
            'date' => $this->input->post('date'),
            'user_id' => $this->session->userdata('user_id')
        ];
        $this->db->insert('stock', $data);
    }
    public function update_stock_item_out($post)
    {
        $qty = $this->input->post('qty');
        $code = $this->input->post('item_code');
        $sql = 'UPDATE items SET stock_id = stock_id - ' . $qty . ' WHERE code = "' . $code . '"';
        $this->db->query($sql);
    }
    public function update_stock_out2($data)
    {
        $qty = $data['qty'];
        $code = $data['item_code'];
        $sql = 'UPDATE items SET stock_id = stock_id + ' . $qty . ' WHERE code = "' . $code . '"';
        $this->db->query($sql);
    }
}

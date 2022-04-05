<?php
class M_sale extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT (MID(invoice, 9, 4)) AS invoice_no FROM transaction_done WHERE MID(invoice, 3, 6) = DATE_FORMAT(CURDATE(), '%y%m%d') ORDER BY invoice DESC LIMIT 1";
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
    // NT2112060002
}

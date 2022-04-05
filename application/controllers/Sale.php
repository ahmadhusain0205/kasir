<?php

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class Sale extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logout();
        $this->load->model('M_sale');
    }
    public function index()
    {
        $this->db->query('DELETE FROM report');
        $data['customer'] = $this->db->get('customer')->result();
        $data['invoice'] = $this->M_sale->invoice_no();
        $data['item'] = $this->db->query('select i.code as barcode, i.stock_id, i.name, i.price, i.purchase, c.categori, i.stock_id as qty from items i join categories c on i.categori_code=c.code');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaction'] = $this->db->query('SELECT t.code, t.changes, t.discount, t.invoice, t.sale_id, t.qty, i.name as nama_barang, i.purchase, t.sub_total, t.payment from transaction t JOIN items i ON t.code=i.code ORDER BY created desc')->result();
        $data['transaction1'] = $this->db->query('SELECT t.code, t.changes, t.discount, t.invoice, t.sale_id, t.qty, i.name as nama_barang, i.purchase, t.sub_total, t.payment from transaction t JOIN items i ON t.code=i.code ORDER BY created desc limit 1')->result();
        $data['changes'] = $this->db->query('SELECT changes FROM transaction GROUP BY invoice DESC')->result();
        $data['payment'] = $this->db->query('SELECT payment FROM transaction GROUP BY invoice DESC')->result();
        $data['total'] = $this->db->query('SELECT sum(sub_total) as total FROM transaction')->result();
        $this->template->load('Template', 'Transaction/Sale/Form', $data);
    }
    public function insert()
    {
        $where = $this->input->post('add');
        $kosong = $this->db->query('select name, stock_id from items where code like "' . $where . '" or code like "' . $where . '%" or code like "%' . $where . '" or name like "' . $where . '" or name like "' . $where . '%" or name like "%' . $where . '"')->row_array();
        if ($kosong['stock_id'] != 0) {
            if ($this->input->post('qty') == null) {
                $qty = 1;
            } else {
                $qty = $this->input->post('qty');
            }
            $code = $this->db->query('select code, price, purchase, name from items where code = "' . $where . '" or code like "' . $where . '" or code like "' . $where . '%" or code like "%' . $where . '" or name like "' . $where . '" or name like "' . $where . '%" or name like "%' . $where . '"')->row_array();
            $exist = $this->db->query('SELECT t.code, i.name FROM transaction t JOIN items i ON t.code=i.code WHERE i.name IN (SELECT name FROM items WHERE name = "' . $where . '") or t.code = "' . $where . '" or t.code like "' . $where . '%" or t.code like "%' . $where . '" or name like "' . $where . '" or name like "' . $where . '%" or name like "%' . $where . '"')->row_array();
            $code_e = $exist['code'];
            $code_en = $exist['name'];
            $code_c = $code['code'];
            $code_n = $code['name'];
            $invoice = $this->M_sale->invoice_no();
            if ($code_n == $code_en) {
                $this->db->query("UPDATE transaction SET qty = qty + " . $qty . " WHERE code = '" . $where . "'");
                $this->db->query("UPDATE transaction JOIN items ON transaction.code=items.code  SET transaction.sub_total = transaction.qty * items.purchase WHERE transaction.code = '" . $where . "'");
                redirect('Sale');
            } else if ($code_c == $code_e) {
                $this->db->query("UPDATE transaction SET qty = qty + " . $qty . " WHERE code = '" . $where . "'");
                $this->db->query("UPDATE transaction JOIN items ON transaction.code=items.code  SET transaction.sub_total = transaction.qty * items.purchase WHERE transaction.code = '" . $where . "'");
                redirect('Sale');
            } else if ($code && $where == null) {
                redirect('Sale');
            } else if (isset($code)) {
                $data = [
                    'invoice' => $invoice,
                    'code' => $code['code'],
                    'qty' => $qty,
                    'customer_id' => 1,
                    'sub_total' => $qty * $code['purchase'],
                    'sub_purchase' => $qty * $code['price'],
                    'profit' => (($qty * $code['purchase']) - ($qty * $code['price'])),
                    'user_id'  => $this->session->userdata('user_id')
                ];
                $this->db->insert('transaction', $data);
                redirect('Sale');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger btn-sm my-auto" role="alert">
                        barang tidak ada!
                    </div>'
                );
                redirect('Sale');
            }
        } else if ($kosong['name'] == null) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger btn-sm my-auto" role="alert">
                        barang tidak ada!
                    </div>'
            );
            redirect('Sale');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning btn-sm my-auto" role="alert">
                stok barang kosong!
            </div>'
            );
            redirect('Sale');
        }
    }
    public function delete($id)
    {
        $where = array('sale_id' => $id);
        $this->db->where($where);
        $this->db->delete('transaction');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menghapus pesanan!
            </div>'
        );
        redirect('Sale');
    }
    public function changes($id)
    {
        $invoice = $this->M_sale->invoice_no();
        $total = (int)$this->input->post('total');
        $payment = (int)$this->input->post('payment');
        $changes = $payment - $total;
        $x = $this->db->query('select * from transaction')->result();
        foreach ($x as $xx) {
            $harga = $this->db->query('select purchase, price from items where code = ' . $xx->code)->row_array();
            $d = $this->db->query('select discount from transaction where code = ' . $xx->code)->row_array();
            if ($d['discount'] == null) {
                $m = 0;
            } else {
                $m = $d['discount'];
            }
            $data = [
                'code' => $xx->code,
                'type' => 'out',
                'invoice' => $invoice,
                'detail' => 'terjual',
                'supplier_id' => '',
                'qty' => $xx->qty,
                'date' => $xx->created,
                'discount' => $m,
                'purchase' => $harga['purchase'],
                'price' => $harga['price'],
                'user_id'  => $this->session->userdata('user_id')
            ];
            $this->db->insert('stock', $data);
        }
        if ($changes < 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning btn-sm my-auto" role="alert">
               uang kurang!
            </div>'
            );
            redirect('Sale');
        } else {
            $x = $this->db->query('select qty, code from transaction where invoice = "' . $id . '"')->result();
            foreach ($x as $xz) {
                $sql = 'UPDATE items SET stock_id = stock_id - ' . $xz->qty . ' WHERE code = "' . $xz->code . '"';
                $this->db->query($sql);
            }
            $this->db->set('payment', $payment);
            $this->db->set('changes', $changes);
            $this->db->where('invoice', $invoice);
            $this->db->update('transaction');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success btn-sm my-auto" role="alert">
               berhasil terjual!
            </div>'
            );
            redirect('Sale');
        }
        // var_dump($id);
    }
    public function edit_process($sale_id)
    {
        $where = array('sale_id' => $sale_id);
        $data = [
            'qty' => $this->input->post('qty'),
            'discount' => $this->input->post('discount')
        ];
        $this->db->where($where);
        $this->db->update('transaction', $data);
        $getcode = $this->db->query('select code, discount from transaction where sale_id = ' . $sale_id)->row_array();
        $getprice = $this->db->query('select price, purchase from items where code = "' . $getcode['code'] . '"')->row_array();
        // diskon
        $discount = (int)$getcode['discount'];
        // harga beli
        $price = (int)$getprice['price'];
        // harga jual
        $purchase = (int)$getprice['purchase'];
        $ubah = ($data['qty'] * $purchase);
        // $diskon = ($ubah * $discount) / 100;
        $grand_total = $ubah - $discount;
        $purchase1 = $data['qty'] * $price;
        $profit1 = $grand_total - $purchase1;
        $this->db->set('sub_total', $grand_total);
        $this->db->set('sub_purchase', $purchase1);
        $this->db->set('profit', $profit1);
        $this->db->where('sale_id', $sale_id);
        $this->db->update('transaction');
        redirect('Sale');
        // var_dump($ubah);
    }
    public function next($id)
    {
        $sale_id = $this->input->post('sale_id');
        // cetak
        // function buatBaris1Kolom($kolom1)
        // {
        //     $lebar_kolom_1 = 33;

        //     $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);

        //     $kolom1Array = explode("\n", $kolom1);

        //     $jmlBarisTerbanyak = count($kolom1Array);

        //     $hasilBaris = array();

        //     for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

        //         $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");

        //         $hasilBaris[] = $hasilKolom1;
        //     }

        //     return implode($hasilBaris) . "\n";
        // }

        // function buatBaris3Kolom($kolom1, $kolom2, $kolom3)
        // {
        //     $lebar_kolom_1 = 11;
        //     $lebar_kolom_2 = 11;
        //     $lebar_kolom_3 = 11;

        //     $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
        //     $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
        //     $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);

        //     $kolom1Array = explode("\n", $kolom1);
        //     $kolom2Array = explode("\n", $kolom2);
        //     $kolom3Array = explode("\n", $kolom3);

        //     $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));

        //     $hasilBaris = array();

        //     for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

        //         $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
        //         $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_LEFT);
        //         $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);

        //         $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
        //     }

        //     return implode($hasilBaris) . "\n";
        // }
        // $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $cetak = $this->db->query('SELECT * FROM transaction WHERE invoice = "' . $id . '"')->row_array();
        // $profile = CapabilityProfile::load("simple");
        // $connector = new WindowsPrintConnector("MS Publisher Color Printer 1");
        // $printer = new Printer($connector, $profile);


        // $printer->initialize();
        // $printer->text(buatBaris1Kolom("              WAmart                         Wahyu Abadi                   Salaman, Magelang"));
        // $printer->text(buatBaris1Kolom("Invoice : " . $cetak['invoice'] . "         Kasir   : " . $user['name'] . "             Tanggal : " . date('Y-m-d, h:i:A', time())));
        // $printer->text(buatBaris1Kolom("--------------------------------"));
        // $sql = $this->db->query('SELECT i.name, t.discount, t.qty, i.purchase, t.payment, t.changes, t.sub_total FROM transaction t JOIN items i ON t.code=i.code WHERE invoice = "' . $id . '"')->result();
        // $total = 0;
        // foreach ($sql as $s) {
        //     $printer->text(buatBaris1Kolom($s->name . ' jml' . $s->qty . ' x hrg' . number_format($s->purchase) . ' - dis Rp. ' . $s->discount . ' = ' . number_format($s->sub_total)));
        //     $total += $s->sub_total;
        // }
        // $printer->text(buatBaris1Kolom("--------------------------------"));
        // $printer->text(buatBaris1Kolom("Pembayaran  : " . number_format($s->payment) . "          Total       : " . number_format($total, 0) . "         Kembalian   : " . number_format($s->changes)));
        // $printer->text("\n");
        // $printer->text(buatBaris1Kolom("Terima kasih atas kunjungan anda"));
        // $printer->text(buatBaris1Kolom("barang yang sudah di beli tidak        dapat di kembalikan"));
        // $printer->feed(2);
        // $printer->cut();
        // $printer->close();
        // selesaikan
        $x = $this->db->query('select invoice, sum(sub_total) as sub_total, sum(sub_purchase) as sub_purchase, sum(profit) as profit from transaction where invoice = "' . $id . '"')->result();
        foreach ($x as $xx) {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'invoice' => $xx->invoice,
                'sub_total' => $xx->sub_total,
                'sub_purchase' => $xx->sub_purchase,
                'profit' => $xx->profit
            ];
            $this->db->insert('transaction_done', $data);
        }
        $this->db->query('delete from transaction where invoice = "' . $id . '"');
        redirect('Sale');
    }
}

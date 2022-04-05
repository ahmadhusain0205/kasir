<?php
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Report extends CI_Controller
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
        $data['report'] = $this->db->query('select t.id, t.created, u.name, t.user_id, t.invoice, t.sub_total as sub_jual, t.sub_purchase as sub_beli, t.profit from transaction_done t join user u on t.user_id=u.user_id order by t.invoice desc')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Report/Data', $data);
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $this->db->where($where);
        $this->db->delete('transaction_done');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menghapus laporan!
            </div>'
        );
        redirect('Report/full');
    }
    public function full()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        // $data['cetak'] = $this->db->query('select s.stock_id, (select name from user where user_id=s.user_id) as u_name, s.invoice, i.name, s.code, s.type, s.detail, s.qty, i.price, i.purchase, s.date, s.created, (select i.purchase*s.qty from items i where i.code = s.code) as sub_total_jual, (select (purchase-price)*qty from items where code=s.code) as keuntungan, (select sum(s.qty*(select i.purchase from items i where i.code = s.code)) from stock as s where s.date between "' . $dari . '" and "' . $sampai . '") as total_jual, (select sum(((select purchase from items where code = s.code)-(select price from items where code = s.code))*s.qty) from stock s where s.date between "' . $dari . '" and "' . $sampai . '") total_keuntungan from stock s join items i on s.code=i.code where s.type="out" and s.detail = "terjual" and s.date between "' . $dari . '" and "' . $sampai . '" order by s.invoice desc')->result();
        $data['cetak'] = $this->db->get('report')->result();
        $data['total_jual'] = $this->db->query('select sum(sub_total_jual) as jual_total from report')->row_array();
        $data['total_keuntungan'] = $this->db->query('select sum(keuntungan) as keuntungan_total from report')->row_array();
        $cetak = $this->db->query('select s.stock_id, (select name from user where user_id=s.user_id) as u_name, s.invoice, i.name, s.type, s.detail, s.qty, s.price, s.discount, s.purchase, s.date, s.created, ((s.purchase*s.qty)-(s.discount)) as sub_total_jual, ((s.purchase*s.qty)-(s.price*s.qty)) as keuntungan from stock s join items i on s.code=i.code where s.type="out" and s.detail = "terjual" and s.date between "' . $dari . '" and "' . $sampai . '" order by s.invoice desc')->result();
        $this->form_validation->set_rules('dari', 'dari', 'required');
        $this->form_validation->set_rules('sampai', 'sampai', 'required');
        if ($this->form_validation->run() == false) {
            $this->template->load('Template', 'Report/Full', $data);
        } else {
            $sql = $this->db->get('report')->result();
            if (empty($sql)) {
                foreach ($cetak as $c) {
                    $report = [
                        'cek' => 1,
                        'date' => $c->date,
                        'invoice' => $c->invoice,
                        'u_name' => $c->u_name,
                        'i_name' => $c->name,
                        'qty' => $c->qty,
                        'beli' => $c->price,
                        'jual' => $c->purchase,
                        'sub_total_jual' => $c->sub_total_jual,
                        'keuntungan' => $c->keuntungan - $c->discount,
                        'discount' => $c->discount
                    ];
                    $this->db->insert('report', $report);
                }
                $this->template->load('Template', 'Report/Full', $data);
            } else {
                $ceking  = $this->db->query('select cek from report order by cek desc limit 1')->row_array();
                $this->db->query('DELETE FROM report');
                foreach ($cetak as $c) {
                    $datar = [
                        'cek' => $ceking['cek'] + 1,
                        'date' => $c->date,
                        'invoice' => $c->invoice,
                        'u_name' => $c->u_name,
                        'i_name' => $c->name,
                        'qty' => $c->qty,
                        'beli' => $c->price,
                        'jual' => $c->purchase,
                        'sub_total_jual' => $c->sub_total_jual,
                        'keuntungan' => $c->keuntungan - $c->discount,
                        'discount' => $c->discount
                    ];
                    $this->db->insert('report', $datar);
                }
                $this->template->load('Template', 'Report/Full', $data);
            }
        }
    }
    public function unduh()
    {
        $unduh = $this->db->get('report')->result();
        if (empty($unduh)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger btn-sm my-auto" role="alert">
                data kosong!
                </div>'
            );
            redirect('Report/full');
        } else {
            $data['unduh'] = $this->db->query('select r.date, r.invoice, r.u_name, r.qty, r.beli, r.jual, r.sub_total_jual, r.keuntungan, (select i.code from items i where i.name = r.i_name) as barcode, r.i_name as name from report r')->result();
            $this->load->view('Report/Unduh', $data);
        }
    }
    public function print()
    {
        $data['print'] = $this->db->query('select r.date, r.invoice, r.u_name, r.qty, r.beli, r.jual, r.sub_total_jual, r.keuntungan, (select i.code from items i where i.name = r.i_name) as barcode, r.i_name as name from report r')->result();
        // $data['print'] = $this->db->get('report')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Report/Print', $data);
    }
    public function refresh()
    {
        $this->db->query('DELETE FROM report');
        redirect('Report/full');
    }
}

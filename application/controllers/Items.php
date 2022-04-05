<?php
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Items extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_items');
        logout();
        if ($this->session->userdata('level') == 2) {
            redirect('Block');
        }
    }
    public function index()
    {
        $data['modal'] = $this->db->query('select sum(price*stock_id) as md from items')->result();
        $this->db->query('DELETE FROM report');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // kurang join stok
        $data['item'] = $this->db->query('select i.code, i.stock_id, i.name, i.price, i.purchase, (select categori from categories where code=i.categori_code) as categori from items i')->result();
        $this->template->load('Template', 'Item/Data', $data);
    }
    public function add()
    {
        $this->form_validation->set_rules('code', 'kode barang', 'required|is_unique[items.code]', [
            'is_unique' => 'kode barang sudah digunakan'
        ]);
        $this->form_validation->set_rules('name', 'nama', 'required|is_unique[items.name]', [
            'is_unique' => 'nama barang sudah ada'
        ]);
        $this->form_validation->set_rules('price', 'harga jual', 'required');
        $this->form_validation->set_rules('purchase', 'harga beli', 'required');
        $this->form_validation->set_rules('categori_code', 'kategori', 'required', [
            'required' => 'pilih kategori barang terlebih dahulu'
        ]);
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
        $code = $this->input->post('code');
        if ($this->form_validation->run() == true) {
            $data = [
                'code' => $code,
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'purchase' => $this->input->post('purchase'),
                'categori_code' => $this->input->post('categori_code'),
                'stock_id' => $this->input->post('stock_id'),
            ];
            $this->db->insert('items', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success btn-sm my-auto" role="alert">
                    berhasil menambahkan barang!
                </div>'
            );
            redirect('Items');
        } else {
            $data['categori'] = $this->db->get('categories')->result();
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $this->template->load('Template', 'Item/Add', $data);
        }
    }
    public function edit($id)
    {
        // kurang join stok
        $data['item'] = $this->db->query('select i.code, i.stock_id, i.name, i.price, i.purchase, c.categori from items i join categories c on i.categori_code=c.code where i.code = "' . $id . '"')->row_array();
        $data['categori'] = $this->db->get('categories')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->template->load('Template', 'Item/Edit', $data);
    }
    public function edit_process()
    {
        $this->form_validation->set_rules('code', 'code', 'required');
        if ($this->form_validation->run() == true) {
            $where = array('code' => $this->input->post('code'));
            $data = [
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'purchase' => $this->input->post('purchase'),
                'stock_id' => $this->input->post('stock_id')
            ];
            $this->db->where($where);
            $this->db->update('items', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil mengubah barang!
            </div>'
            );
            redirect('Items');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger btn-sm my-auto" role="alert">
                    gagal mengubah barang!
                </div>'
            );
            redirect('Items/edit/' . $this->input->post('code'));
        }
    }
    public function delete($id)
    {
        $where = array('code' => $id);
        $this->db->where($where);
        $this->db->delete('items');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success btn-sm my-auto" role="alert">
                berhasil menghapus barang!
            </div>'
        );
        redirect('Items');
    }
    public function barcode($id)
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // kurang join stok
        $data['barcode'] = $this->db->query('select i.code as barcode, i.stock_id, i.name, i.price, i.purchase, c.categori from items i join categories c on i.categori_code=c.code where i.code = "' . $id . '"')->row();
        $this->template->load('Template', 'Item/Barcode', $data);
    }
    public function print()
    {
        $data['print'] = $this->db->query('select code, name from items')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Item/Print', $data);
    }
    public function print_barcode($id)
    {
        $data['print'] = $this->db->query('select code, name from items where code = "' . $id . '"')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Item/Print', $data);
    }
    public function import()
    {
        $config['upload_path'] = './uploads/excel/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'barang' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('import')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/excel/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $data = [
                            'code' => $row->getCellAtIndex(0),
                            'name' => $row->getCellAtIndex(2),
                            'price' => $row->getCellAtIndex(3),
                            'purchase' => $row->getCellAtIndex(4),
                            'categori_code' => $row->getCellAtIndex(1),
                            'stock_id' => $row->getCellAtIndex(5)
                        ];
                        $this->M_items->import($data);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/excel/' . $file['file_name']);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success btn-sm my-auto" role="alert">
                        berhasil mengunggah data barang!
                    </div>'
                );
                redirect('Items');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger btn-sm my-auto" role="alert">
                    gagal mengunggah data barang!
                </div>'
            );
            redirect('Items');
        }
    }
    public function template()
    {
        $this->load->view('Item/Template');
    }
    public function export()
    {
        $data['item'] = $this->db->query('select i.code, i.stock_id, i.name, i.price, i.purchase, c.categori from items i join categories c on i.categori_code=c.code')->result();
        $this->load->view('Item/Excel', $data);
    }
}

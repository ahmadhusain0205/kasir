<?php 
class M_customer extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('customer');
        if ($id != null) {
            $this->db->where('customer_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address']
        ];
        $this->db->insert('customer', $params);
    }
    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address']
        ];
        $this->db->where('customer_id', $post['customer_id']);
        $this->db->update('customer', $params);
    }
}
?>
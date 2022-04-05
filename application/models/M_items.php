<?php
class M_items extends CI_Model
{
  public function import($data)
  {
    $jumlah = count($data);
    if ($jumlah > 0) {
      $this->db->insert('items', $data);
    }
  }
}

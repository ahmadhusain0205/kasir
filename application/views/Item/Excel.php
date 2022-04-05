<?php
header("Content-type:application/octet-stream/");
header("Content-Disposition:attachment;filename=databarang.xls");
header("Pragma:no-cache");
header("Expires:0");
?>
<table>
  <thead>
    <tr>
      <th>Kode barang</th>
      <th>Kategori barang</th>
      <th>Nama barang</th>
      <th>Harga beli</th>
      <th>Harga jual</th>
      <th>Stok barang</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    foreach ($item as $i) : ?>
      <tr>
        <td><?= $i->code; ?></td>
        <td><?= $i->categori; ?></td>
        <td><?= $i->name; ?></td>
        <td><?= $i->price; ?></td>
        <td><?= $i->purchase; ?></td>
        <td><?= $i->stock_id; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<!-- <?php
      header("Content-type:application/octet-stream/");
      header("Content-Disposition:attachment;filename=databarang.xls");
      header("Pragma:no-cache");
      header("Expires:0");
      ?> -->
<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Invoice</th>
      <th>Penjual</th>
      <th>Barcode</th>
      <th>Barang</th>
      <th>Qty</th>
      <th>Harga beli</th>
      <th>Harga jual</th>
      <th>Total jual</th>
      <th>Keuntungan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    foreach ($unduh as $i) : ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $i->date; ?></td>
        <td><?= $i->invoice; ?></td>
        <td><?= $i->u_name; ?></td>
        <td><?= $i->barcode; ?></td>
        <td><?= $i->name; ?></td>
        <td><?= $i->qty; ?></td>
        <td><?= $i->beli; ?></td>
        <td><?= $i->jual; ?></td>
        <td><?= $i->sub_total_jual; ?></td>
        <td><?= $i->keuntungan; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tfooter>
    <tr>
      <td colspan="9" class="text-center"><b>total keuntungan</b></td>
      <td>
        <?php
        $query = $this->db->query('select sum(re.sub_total_jual) as pr from report re')->result();
        foreach ($query as $q) {
          echo $q->pr;
        }
        ?>
      </td>
      <td>
        <?php
        $query = $this->db->query('select sum(re.keuntungan) as k from report re')->result();
        foreach ($query as $q) {
          echo $q->k;
        }
        ?>
      </td>
    </tr>
  </tfooter>
</table>
<?php
header("Content-type:application/octet-stream/");
header("Content-Disposition:attachment;filename=templatebarang.xls");
header("Pragma:no-cache");
header("Expires:0");
?>
<table border="1">
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
</table>
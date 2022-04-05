<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar laporan penjualan barang</h3>
            <!-- <div class="float-right">
                <a href="<?= site_url('Report/print'); ?>" class="btn btn-success" target="_BLANK">
                    <i class="fas fa-print"></i> cetak laporan
                </a>
            </div> -->
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead>
                    <tr class="text-center">
                        <th width="2%">no</th>
                        <th>kasir</th>
                        <th>tanggal</th>
                        <th>invoice</th>
                        <th>pembelian</th>
                        <th>penjualan</th>
                        <th>keuntungan</th>
                        <!-- <th>aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($report as $r) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td><?= $r->name; ?></td>
                            <td><a class="float-right"><?= $r->created; ?></a></td>
                            <td><?= $r->invoice; ?></td>
                            <td>Rp. <a class="float-right"><?= number_format($r->sub_beli); ?></a></td>
                            <td>Rp. <a class="float-right"><?= number_format($r->sub_jual); ?></a></td>
                            <td>Rp. <a class="float-right"><?= number_format($r->profit); ?></a></td>
                            <!-- <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_report<?= $r->id; ?>">
                                    <i class="fas fa-trash"></i> hapus
                                </button>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- modal delete -->
<?php foreach ($report as $r) : ?>
    <div class="modal fade" id="delete_report<?= $r->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Hapus data
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                    <a href="<?= site_url('Report/delete/') . $r->id; ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
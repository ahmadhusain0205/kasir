<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar barang</h3>
            <div class="float-right">
                <a class="btn btn-success">
                    <i class="fas fa-download"></i> Modal
                    <?php foreach($modal as $m) : ?>
                        Rp. <?= number_format($m->md);?>
                    <?php endforeach;?>
                </a>
                <a href="<?= site_url('Items/template'); ?>" class="btn btn-info">
                    <i class="fas fa-download"></i> unduh template
                </a>
                <a href="<?= site_url('Items/add'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> tambah
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <div class="float-left">
                <a href="<?= site_url('Items/print'); ?>" class="btn btn-success btn-sm" target="_BLANK">
                    <i class="fas fa-print"></i> cetak semua barcode
                </a>
                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#import_excel">
                    <i class="fas fa-upload"></i> unggah data
                </button>
                <a href="<?= site_url('Items/export'); ?>" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-download"></i> unduh data
                </a>
            </div>
            <table class="table table-striped table-bordered" id="print">
                <thead>
                    <tr class="text-center">
                        <th width="2%">no</th>
                        <th>kode</th>
                        <th>kategori</th>
                        <th>nama</th>
                        <th>harga beli</th>
                        <th>harga jual</th>
                        <th>qty</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($item as $i) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td>
                                <?= $i->code; ?>
                                <a href="<?= site_url('Items/barcode/') . $i->code; ?>" class="float-right btn btn-xs btn-danger">
                                    <i class="fas fa-info"></i> detail
                                </a>
                            </td>
                            <td>
                                <?= $i->categori; ?>
                            </td>
                            <td><?= $i->name; ?></td>
                            <td><a class="float-left">Rp</a><a class="float-right"><?= number_format($i->price); ?></a></td>
                            <td><a class="float-left">Rp</a><a class="float-right"><?= number_format($i->purchase); ?></a></td>
                            <td><a class="float-right"><?= $i->stock_id;  ?></a></td>
                            <td class="text-center">
                                <a href="<?= site_url('Items/print_barcode/') . $i->code; ?>" type="button" class="btn btn-info btn-xs" target="_BLANK"><i class="fas fa-barcode"></i> cetak barcode</a>
                                <a href="<?= site_url('Items/edit/') . $i->code; ?>" type="button" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> ubah</a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_item<?= $i->code; ?>">
                                    <i class="fas fa-trash"></i> hapus
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- modal delete -->
<?php foreach ($item as $i) : ?>
    <div class="modal fade" id="delete_item<?= $i->code; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Hapus data
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data <?= $i->name; ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                    <a href="<?= site_url('Items/delete/') . $i->code; ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal import excel -->
<div class="modal fade" id="import_excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">unggah file excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Items/import'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="import">Pilih data excel</label>
                    <input type="file" class="form-control-file" name="import" accept=".xlsx,.xls" id="import">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
                <button type="submit" class="btn btn-primary">upload</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
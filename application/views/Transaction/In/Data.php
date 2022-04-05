<section class="content ml-3 pt-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar stok masuk</h3>
            <div class="float-right">
                <a href="<?= site_url('Stock/in_add'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> tambah
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead>
                    <tr class="text-center">
                        <th width="2%">no</th>
                        <th>pemroses</th>
                        <th>invoice</th>
                        <th>kode barang</th>
                        <th>nama barang</th>
                        <th>tipe stok</th>
                        <th>detail</th>
                        <th>pemasok</th>
                        <th>jumlah stok masuk</th>
                        <th>waktu stok masuk</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($stok->result() as $s) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td><?= $s->u_name; ?></td>
                            <td><?= $s->invoice; ?></td>
                            <td><?= $s->code; ?></td>
                            <td><?= $s->name; ?></td>
                            <td><?= $s->type; ?></td>
                            <td><?= $s->detail; ?></td>
                            <td>
                                <?php
                                if ($s->supplier_id == null) {
                                    echo '';
                                } else {
                                    echo $s->su_name;
                                }
                                ?>
                            </td>
                            <td><a class="float-right"><?= $s->qty; ?></a></td>
                            <td><a class="float-right"><?= $s->created; ?></a></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_stok_in<?= $s->stock_id; ?>">
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
<?php foreach ($stok->result() as $s) : ?>
    <div class="modal fade" id="delete_stok_in<?= $s->stock_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Hapus data
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus barang <?= $s->name; ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                    <a href="<?= site_url('Stock/delete/') . $s->stock_id . '/' . $s->code; ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
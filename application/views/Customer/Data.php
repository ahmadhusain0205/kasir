<section class="content pl-3 pt-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar kostumer</h3>
            <div class="float-right">
                <a href="<?= site_url('Customer/add'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> tambah
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead>
                    <tr class="text-center">
                        <th width="2%">no</th>
                        <th>nama</th>
                        <th>no hp</th>
                        <th>alamat</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($row as $r) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td><?= $r->name; ?></td>
                            <td><a class="float-right"><?= $r->phone; ?></a></td>
                            <td><?= $r->address; ?></td>
                            <td class="text-center">
                                <a href="<?= site_url('Customer/edit/') . $r->customer_id; ?>" type="button" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> ubah</a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_customer<?= $r->customer_id; ?>">
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
<?php foreach ($row as $r) : ?>
    <div class="modal fade" id="delete_customer<?= $r->customer_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Hapus data
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data <b><?= $r->name; ?></b> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                    <a href="<?= site_url('Customer/delete/') . $r->customer_id; ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
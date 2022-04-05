<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar kategori barang</h3>
            <div class="float-right">
                <a href="<?= site_url('Categories/add'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> tambah
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead>
                    <tr class="text-center">
                        <th width="2%">no</th>
                        <th>kode</th>
                        <th>kategori</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($categori as $c) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td><?= $c->code; ?></td>
                            <td><?= $c->categori; ?></td>
                            <td class="text-center">
                                <?php
                                $x = $this->db->query('select c.code from categories c where not exists (select i.categori_code from items i where c.code=i.categori_code) and c.code = "' . $c->code . '"')->result();
                                if ($x == false) {
                                ?>
                                    <a href="<?= site_url('Categories/edit/') . $c->code; ?>" type="button" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> ubah</a>
                                    <button type="button" class="btn btn-dark btn-xs">
                                        <i class="fas fa-ban"></i> disable
                                    </button>
                                <?php } else { ?>
                                    <a href="<?= site_url('Categories/edit/') . $c->code; ?>" type="button" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> ubah</a>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_categori<?= $c->code; ?>">
                                        <i class="fas fa-trash"></i> hapus
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- modal delete -->
<?php foreach ($categori as $c) : ?>
    <div class="modal fade" id="delete_categori<?= $c->code; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Hapus data
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data <b><?= $c->categori; ?></b> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                    <a href="<?= site_url('Categories/delete/') . $c->code; ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
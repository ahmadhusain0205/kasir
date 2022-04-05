<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar aktifitas pengguna</h3>
            <div class="float-right">
                <a href="<?= site_url('Logs/print'); ?>" class="btn btn-success" target="_BLANK">
                    <i class="fas fa-print"></i> cetak data aktifitas log
                </a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_all">
                    <i class="fas fa-trash"></i> hapus semua data
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead>
                    <tr class="text-center">
                        <th size="1%">no</th>
                        <th>nama</th>
                        <th>level</th>
                        <th>waktu masuk</th>
                        <th>waktu keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($log as $l) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td><?= $l->name; ?></td>
                            <td><?= $l->status; ?></td>
                            <td><a class="float-right"><?= date('D, d-M-Y H:i:s', $l->time_login); ?></a></td>
                            <td><?php if ($l->time_logout == null) {
                                    echo 'masih bekerja';
                                } else {
                                    echo '<a class="float-right">' . date('D, d-M-Y H:i:s', $l->time_logout) . '</a>';
                                } ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- modal hapus semua data -->
<div class="modal fade" id="delete_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                Hapus data
            </div>
            <div class="modal-body">
                Yakin ingin menghapus semua data log ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                <a href="<?= site_url('Logs/delete_all'); ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
            </div>
        </div>
    </div>
</div>
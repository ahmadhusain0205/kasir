<section class="content pl-3 pt-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar administrator</h3>
            <div class="float-right">
                <a href="<?= site_url('Admin/add'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> tambah
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead>
                    <tr class="text-center">
                        <th width="2%">no</th>
                        <th>status</th>
                        <th>username</th>
                        <th>nama</th>
                        <th>alamat</th>
                        <th>no hp</th>
                        <th>foto</th>
                        <th>aktifasi</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($admin as $a) :
                    ?>
                        <tr>
                            <td><a class="float-right"><?= $no++; ?></a></td>
                            <td>
                                <?php
                                if ($a->on_off == 1) {
                                    echo '<i class="fas fa-circle my-auto" style="color:#32CD32;"></i> online';
                                } else {
                                    echo '<i class="fas fa-circle my-auto" style="color:grey;"></i> offline';
                                }
                                ?>
                            </td>
                            <td>
                                <?= $a->username; ?>
                            </td>
                            <td><?= $a->name; ?></td>
                            <td><?= $a->address; ?></td>
                            <td><a class="float-right"><?= $a->phone; ?></a></td>
                            <td>
                                <img src="<?= base_url('assets/img/profile/') . $a->image; ?>" style="width: 30px; height:30px; border-radius:5px;">
                            </td>
                            <td>
                                <?php if ($a->is_actived == 1) {
                                    echo '<a type="button" class="btn btn-success btn-xs">aktif</a>';
                                } else {
                                    echo '<a type="button" class="btn btn-secondary btn-xs">belum aktif</a>';
                                };
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if (($a->on_off == 1) && ($a->is_actived == 1)) {
                                    echo '
                                    <a readonly type="button" class="btn btn-dark btn-xs"><i class="fas fa-ban"></i> disable</a>
                                    ';
                                } else {
                                    if ($a->is_actived == 0) {
                                        echo '
                                    <a href="';
                                        echo site_url('Admin/actived/') . $a->user_id;
                                        echo '" type="button" class="btn btn-success btn-xs"><i class="fas fa-toggle-on"></i> aktifkan</a>
                                    ';
                                    } else {
                                        echo '
                                    <a href="';
                                        echo site_url('Admin/nonactived/') . $a->user_id;
                                        echo '" type="button" class="btn btn-secondary btn-xs"><i class="fas fa-toggle-off"></i> matikan</a>
                                    ';
                                    }
                                }
                                ?>
                                <?php
                                if ($user['user_id'] == $a->user_id) {
                                    echo '<button type="button" class="btn btn-dark btn-xs" data-toggle="modal" data-target="#delete_admin<?= $a->user_id; ?>">
                                        <i class="fas fa-ban"></i> disable
                                    </button>';
                                } else {
                                ?>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_admin<?= $a->user_id; ?>">
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
<?php foreach ($admin as $a) : ?>
    <div class="modal fade" id="delete_admin<?= $a->user_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Hapus data
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data <b><?= $a->name; ?></b> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                    <a href="<?= site_url('Admin/delete/') . $a->user_id; ?>" type="button" class="btn btn-danger float-right ml-3"><i class="fas fa-check"></i> ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
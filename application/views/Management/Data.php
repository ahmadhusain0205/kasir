<section class="content pl-3 pt-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">daftar administrator</h3>
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
                        <th>management level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($anggota as $a) :
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
                            <td class="text-center">
                                <?php
                                if ($a->level == 2) {
                                    echo '
                                    <a href="';
                                    echo site_url('Management/admin/') . $a->user_id;
                                    echo '" type="button" class="btn btn-success btn-xs"><i class="fas fa-level-up-alt"></i> ubah level menjadi admin</a>
                                    ';
                                } else {
                                    echo '
                                    <a href="';
                                    echo site_url('Management/user/') . $a->user_id;
                                    echo '" type="button" class="btn btn-secondary btn-xs"><i class="fas fa-level-down-alt"></i> ubah level menjadi kasir</a>
                                    ';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
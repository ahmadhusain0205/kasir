<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form ubah data</h3>
            <div class="float-right">
                <a href="<?= site_url('Admin'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <form action="<?= site_url('Admin/edit_process'); ?>" method="POST">
                <?php foreach ($admin as $a) : ?>
                    <div class="form-group">
                        <label for="username">username<span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" name="user_id" value="<?= $a->user_id; ?>">
                        <input type="text" class="form-control" name="username" value="<?= $a->username; ?>" readonly>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="name">nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?= $a->name; ?>" placeholder="nama*" required>
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="phone">nomor hp<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="<?= $a->phone; ?>" placeholder="nomor hp*" required>
                        <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="address">alamat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="address" placeholder="alamat*" value="<?= $a->address; ?>" required>
                        <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="level">level<span class="text-danger">*</span></label>
                        <select name="level" class="form-control" required>
                            <?php foreach ($admin as $u) : ?>
                                <option value="<?= $u->level; ?>">
                                    <?php
                                    if ($u->level == 1) {
                                        echo 'administrator';
                                    } else {
                                        echo 'kasir';
                                    }
                                    ?>
                                </option>
                            <?php
                            endforeach;
                            foreach ($level as $l) :
                            ?>
                                <option value="<?= $l->level_id; ?>"><?= $l->status; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('unit', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> simpan</button>
                <?php endforeach; ?>
            </form>
        </div>
    </div>

</section>
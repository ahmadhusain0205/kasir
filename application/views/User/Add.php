<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form tambah data</h3>
            <div class="float-right">
                <a href="<?= site_url('User'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <?= form_open_multipart('User/add'); ?>
            <div class="form-group">
                <label for="username">username<span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="user_id" value="<?= set_value('user_id'); ?>">
                <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="username*" value="<?= set_value('username'); ?>" autofocus>
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="password">password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" placeholder="password*">
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="name">nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?= set_value('name'); ?>" placeholder="nama*">
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="phone">nomor hp<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="phone" value="<?= set_value('phone'); ?>" placeholder="nomor hp*">
                <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="address">alamat<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="alamat*" value="<?= set_value('address'); ?>">
                <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary float-right ml-3"><i class="fas fa-plus"></i> tambah</button>
            <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> reset</button>
            <?= form_close(); ?>
        </div>
    </div>

</section>
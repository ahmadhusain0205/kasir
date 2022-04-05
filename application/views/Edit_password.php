<section class="content pt-3 pb-3">

    <a type="button" href="<?= site_url('Profile'); ?>" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> kembali</a>
    <br><br>
    <div class="card">
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <?= form_open_multipart('Profile/edit_password') ?>
            <div class="form-group">
                <label for="password">Sandi baru</label>
                <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
                <input type="password" class="form-control" name="password" placeholder="sandi baru*" required>
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="password1">Konfirmasi sandi baru</label>
                <input type="password" class="form-control" name="password1" id="password1" placeholder="konfirmasi sandi*" required>
                <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-paper-plane"></i> simpan</button>
            <?= form_close() ?>
        </div>
    </div>

</section>
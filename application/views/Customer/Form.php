<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form <?= $page; ?> data</h3>
            <div class="float-right">
                <a href="<?= site_url('Customer'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <?= form_open_multipart('Customer/process'); ?>
            <div class="form-group">
                <label for="name">nama<span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="customer_id" value="<?= $row->customer_id; ?>">
                <input type="text" class="form-control" name="name" value="<?= $row->name; ?>" placeholder="nama*" required autofocus>
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="address">alamat<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="alamat*" value="<?= $row->address; ?>" required>
                <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="phone">nomor hp<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="phone" value="<?= $row->phone; ?>" placeholder="nomor hp*" required>
                <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" name="<?= $page; ?>" class="btn btn-primary float-right ml-3"><i class="fas fa-save"></i> simpan</button>
            <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> reset</button>
            <?= form_close(); ?>
        </div>
    </div>

</section>
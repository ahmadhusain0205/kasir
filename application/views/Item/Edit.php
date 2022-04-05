<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form ubah data</h3>
            <div class="float-right">
                <a href="<?= site_url('Items'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <?= form_open_multipart('Items/edit_process'); ?>
            <input type="hidden" class="form-control" name="code" value="<?= $item['code']; ?>" placeholder="nama*" required>
            <div class="form-group">
                <label for="name">nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?= $item['name']; ?>" placeholder="nama*" required>
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="price">harga beli<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="price" value="<?= $item['price']; ?>" placeholder="harga jual*" required>
                <?= form_error('price', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="purchase">harga jual<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="purchase" value="<?= $item['purchase']; ?>" placeholder="harga*" required>
                <?= form_error('purchase', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="stock_id">stok<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="stock_id" value="<?= $item['stock_id']; ?>" placeholder="stok*" required>
                <?= form_error('stock_id', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary float-right ml-3"><i class="fas fa-save"></i> simpan</button>
            <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> reset</button>
            <?= form_close(); ?>
        </div>
    </div>

</section>
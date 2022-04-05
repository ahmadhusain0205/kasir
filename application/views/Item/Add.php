<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form tambah data</h3>
            <div class="float-right">
                <a href="<?= site_url('Items'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <?= form_open_multipart('Items/add'); ?>
            <div class="form-group">
                <label for="code">kode barang<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="code" value="<?= set_value('code'); ?>" placeholder="kode barang*" autofocus>
                <?= form_error('code', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="categori">kategori barang<span class="text-danger">*</span></label>
                <select name="categori_code" class="form-control">
                    <option value="">-- pilih --</option>
                    <?php foreach ($categori as $c) : ?>
                        <option value="<?= $c->code; ?>"><?= $c->categori; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('categori_code', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="name">nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?= set_value('name'); ?>" placeholder="nama*">
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="price">harga beli<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="price" placeholder="harga beli*" value="<?= set_value('price'); ?>">
                <?= form_error('price', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="purchase">harga jual<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="purchase" placeholder="harga jual*" value="<?= set_value('purchase'); ?>">
                <?= form_error('purchase', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="stock_id">stok barang<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="stock_id" placeholder="stok barang*" value="<?= set_value('stock_id'); ?>">
                <?= form_error('stock_id', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary float-right ml-3"><i class="fas fa-plus"></i> tambah</button>
            <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> reset</button>
            <?= form_close(); ?>
        </div>
    </div>

</section>
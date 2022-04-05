<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form tambah data</h3>
            <div class="float-right">
                <a href="<?= site_url('Categories'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <form action="<?= site_url('Categories/add_process'); ?>" method="POST">
                <div class="form-group">
                    <label for="code">kode<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" value="<?= set_value('code'); ?>" placeholder="code*" autofocus>
                    <?= form_error('code', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="categori">kategori<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="categori" value="<?= set_value('categori'); ?>" placeholder="categori*" required>
                    <?= form_error('categori', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary float-right ml-3"><i class="fas fa-plus"></i> tambah</button>
                <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> reset</button>
            </form>
        </div>
    </div>

</section>
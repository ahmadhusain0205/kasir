<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">barcode generator</h3>
            <div class="float-right">
                <a href="<?= site_url('Items'); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col my-auto">
                    <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    echo $generator->getBarcode($barcode->barcode, $generator::TYPE_CODE_128);
                    echo $barcode->barcode;
                    ?>
                </div>
                <div class="col-4 my-auto">
                    <div class="card shadow-mb-4">
                        <div class="card-body">
                            <h3 class="text-center">detail produk</h3>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">nama produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" name="name" value="<?= ': ' . $barcode->name; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="categori" class="col-sm-4 col-form-label">kategori</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" name="categori" value="<?= ': ' . $barcode->categori; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-4 col-form-label">harga satuan</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" name="price" value="<?= ': Rp.' . number_format($barcode->price, 2, ',', '.'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>